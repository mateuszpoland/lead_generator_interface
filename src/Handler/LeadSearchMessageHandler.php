<?php

declare(strict_types=1);

namespace App\Handler;

use App\Entity\Lead\Lead;
use App\Message\LeadDetailMessage;
use App\Message\LeadSearchMessage;
use App\Service\SearchLeadsClientInterface;
use Doctrine\ORM\EntityManagerInterface;
use Psr\Log\LoggerInterface;
use Symfony\Component\Messenger\Attribute\AsMessageHandler;
use Symfony\Component\Messenger\MessageBusInterface;
use Symfony\Contracts\HttpClient\HttpClientInterface;

#[AsMessageHandler]
final class LeadSearchMessageHandler
{
    public function __construct(
        private MessageBusInterface $messageBus,
        private SearchLeadsClientInterface $searchLeadsClient,
        private EntityManagerInterface $entityManager,
    )
    {

    }

    public function __invoke(LeadSearchMessage $message): void
    {
        $leads = $this->searchLeadsClient->searchLeads($message->country, $message->placeName, ['foundation repair', 'plumbers']);

        foreach ($leads as $lead) {
            dump($lead);
            $lead = new Lead(
                $message->country,
                $message->placeName,
                $lead['source_keyword'],
                $lead['business_name'],
                $lead['business_address'],
                $lead['business_phone'],
                $lead['business_rating'],
                $lead['contact_email'] ?? null,
                $lead['website'] ?? null,
                $lead['contact_person'] ?? null,
                $lead['website_summary'] ?? null,
            );

            $this->entityManager->persist($lead);
            $this->entityManager->flush();

            if($lead->getWebsite()) {
                $this->messageBus->dispatch(new LeadDetailMessage($lead->getId(), $lead->getWebsite()));
            }
        }
    }
}