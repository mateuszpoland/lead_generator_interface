<?php

declare(strict_types=1);

namespace App\Message;

class LeadUpdateMessage
{
    public function __construct(
        public string $contactEmail,
        public readonly string $website,
    ) {}
}