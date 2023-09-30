<?php

declare(strict_types=1);

namespace App\Command;

use App\Message\LeadSearchMessage;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Messenger\MessageBusInterface;

#[AsCommand(
    name: 'app:generate-leads',
    description: 'A command to generate leads based on predefined file structure',
)]
final class GenerateLeadsCommand extends Command
{
    //bin/console app:generate-leads leads_test.csv
    protected function configure(): void
    {
        $this->addArgument('filename', InputArgument::REQUIRED, 'The filename to process.');
    }

    public function __construct(private MessageBusInterface $messageBus, string $name = null)
    {
        parent::__construct($name);
    }

    public function execute(InputInterface $input, OutputInterface $output): int
    {
        $output->writeln('Generating leads...');
        $filename = $input->getArgument('filename');
        $filePath = "var/tmp/{$filename}";

        if (!file_exists($filePath)) {
            $output->writeln("File not found: {$filePath}");
            return Command::FAILURE;
        }

        $handle = fopen($filePath, 'rb');
        while (($data = fgetcsv($handle, 1000, ',')) !== false) {
            [$country, $placeName, $state] = $data;
            $country = trim($country);
            $placeName = trim($placeName);
            $state = trim($state);
            $output->write(sprintf('Searching for leads in %s, %s, region: %s', $country, $placeName, $state));
            $this->messageBus->dispatch(new LeadSearchMessage($country, $placeName, $state));
        }

        fclose($handle);

        return Command::SUCCESS;
    }
}