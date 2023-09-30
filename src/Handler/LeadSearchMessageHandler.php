<?php

declare(strict_types=1);

namespace App\Handler;

use App\Entity\Lead;
use App\Message\LeadDetailMessage;
use App\Message\LeadSearchMessage;
use App\Service\SearchLeadsClientInterface;
use Doctrine\DBAL\Exception;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ManagerRegistry;
use Doctrine\Persistence\ObjectManager;
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
        private LoggerInterface $logger,
        private ManagerRegistry $doctrine,
    )
    {
    }

    public function __invoke(LeadSearchMessage $message): void
    {
        $leads = $this->searchLeadsClient->searchLeads($message->country, $message->placeName, $message->state, ['gym']);
        $processedLeads = [];
        foreach ($leads as $lead) {
            $em = $this->doctrine->getManager('default');
            $em->getConnection()->beginTransaction();
            try {
                $lead = new Lead(
                    $message->country,
                    $message->placeName,
                    $lead['source_keyword'],
                    $lead['business_name'],
                    $lead['business_address'],
                    $lead['business_phone'],
                    (string)$lead['business_rating'],
                    $lead['contact_email'] ?? null,
                    $lead['website'] ?? null,
                    $lead['contact_person'] ?? null,
                    $lead['website_summary'] ?? null,
                );
                $em->persist($lead);
                $em->flush();
                $em->getConnection()->commit();
                $processedLeads[] = $lead;
            } catch (\Doctrine\DBAL\Exception $e) {

                $this->logger->error('Error creating lead: ' . $e->getMessage());
                $em->getConnection()->rollBack();
                $this->doctrine->resetManager('default');

                continue;
            }
        }

        foreach ($processedLeads as $lead) {
            if($lead->getWebsite()) {
                $this->logger->info('Dispatching LeadDetailMessage for lead with id: ' . $lead->getId());
                $this->messageBus->dispatch(new LeadDetailMessage($lead->getId(), $lead->getWebsite()));
            }
        }
    }
}