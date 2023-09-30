<?php

declare(strict_types=1);

namespace App\Service\Http;

use App\Service\SearchLeadsClientInterface;
use Psr\Log\LoggerInterface;
use Symfony\Component\HttpClient\CachingHttpClient;
use Symfony\Contracts\HttpClient\HttpClientInterface;
use Symfony\Contracts\HttpClient\ResponseInterface;

class SearchLeadsHttpClient implements SearchLeadsClientInterface
{
    public function __construct(
        private HttpClientInterface $leadSearchClient,
        private LoggerInterface $logger
    ) {
    }

    public function searchLeads(string $country, string $placeName, string $state, array $keywords): array
    {
        $encodedKeywords = array_map('urlencode', $keywords);
        $query = 'keywords=' . implode('&keyword=', $encodedKeywords);
        $url = sprintf('%s/%s(%s)?%s', urlencode($country), urlencode($placeName), urlencode($state), $query);

        $response = $this->leadSearchClient->request('GET', $url);

        return $this->handleResponse($response);
    }

    private function handleResponse(ResponseInterface $response): array
    {
        $statusCode = $response->getStatusCode();
        if ($statusCode !== 200) {
            throw new \RuntimeException(sprintf('Failed to fetch leads. HTTP status code: %s', $statusCode));
        }

        return $response->toArray();
    }
}