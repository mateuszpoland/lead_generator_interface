<?php

declare(strict_types=1);

namespace App\Message;

final class LeadSearchMessage
{
    public function __construct(
        public readonly string $country,
        public readonly string $placeName,
    ) {}
}