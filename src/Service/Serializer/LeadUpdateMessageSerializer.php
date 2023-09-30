<?php

declare(strict_types=1);

namespace App\Service\Serializer;

use App\Message\LeadUpdateMessage;
use Symfony\Component\Messenger\Envelope;
use Symfony\Component\Messenger\Transport\Serialization\SerializerInterface;

final class LeadUpdateMessageSerializer implements SerializerInterface
{
    public function decode(array $encodedEnvelope): Envelope
    {
        $body = $encodedEnvelope['body'];
        $data = json_decode($body, true);
        $message = new LeadUpdateMessage($data['leadId'], $data['contactEmails'], $data['website']);

        return new Envelope($message);
    }

    public function encode(Envelope $envelope): array
    {
        throw new \RuntimeException('Transport & serializer not meant for sending messages');
    }
}