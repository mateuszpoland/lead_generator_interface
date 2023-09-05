<?php

namespace App\Message;

class LeadDetailMessage
{
    public function __construct(
        public readonly int $leadId,
        public readonly string $website,
    ) {}
}