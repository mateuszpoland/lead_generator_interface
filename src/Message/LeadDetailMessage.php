<?php

declare(strict_types=1);

namespace App\Message;
use JetBrains\PhpStorm\ArrayShape;
use JsonSerializable;

final class LeadDetailMessage implements JsonSerializable
{
    public function __construct(
        public readonly int $leadId,
        public readonly string $websiteUrl,
    ) {}

    #[ArrayShape(['leadId' => "int", 'websiteUrl' => "string"])]
    public function jsonSerialize(): array
    {
        return [
            'leadId' => $this->leadId,
            'websiteUrl' => $this->websiteUrl,
        ];
    }
}