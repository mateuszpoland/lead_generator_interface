<?php

declare(strict_types=1);

namespace App\Message;

final class LeadUpdateMessage
{
    public function __construct(
        public readonly int $leadId,
        public readonly array $contactEmails,
        public readonly ?string $website = null,
    ) {}
}