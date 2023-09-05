<?php

declare(strict_types=1);

namespace App\Handler;

use Symfony\Component\Messenger\Attribute\AsMessageHandler;

#[AsMessageHandler]
final class LeadUpdateDetailsMessageHandler
{
    public function __invoke(): void
    {
    }
}