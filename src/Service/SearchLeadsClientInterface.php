<?php

declare(strict_types=1);

namespace App\Service;

interface SearchLeadsClientInterface
{
    public function searchLeads(string $country, string $placeName, string $state, array $keywords): array;
}