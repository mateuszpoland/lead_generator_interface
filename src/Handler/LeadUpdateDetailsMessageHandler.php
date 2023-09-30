<?php

declare(strict_types=1);

namespace App\Handler;

use App\Entity\Lead;
use App\Message\LeadUpdateMessage;
use Doctrine\ORM\EntityManagerInterface;
use Psr\Log\LoggerInterface;
use Symfony\Component\Messenger\Attribute\AsMessageHandler;

#[AsMessageHandler]
final class LeadUpdateDetailsMessageHandler
{
    public function __construct(private LoggerInterface $logger, private EntityManagerInterface $entityManager)
    {}

    public function __invoke(LeadUpdateMessage $message): void
    {
        $this->logger->info('LeadUpdateMessageHandler invoked');
        /** @var Lead|null $lead */
        $lead = $this->entityManager->getRepository(Lead::class)->find($message->leadId);
        if(!$lead) {
            $this->logger->info(sprintf('Lead with id %d not found', $message->leadId));
            return;
        }

        $emails = implode(',', $message->contactEmails);
        $lead->setEmails($emails);
        $lead->setWebsite($message->website);
        $this->entityManager->flush();

        $this->logger->info(sprintf('Processed message. Contact emails: %s, website url: %s', $emails, $message->website));
    }
}