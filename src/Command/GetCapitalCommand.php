<?php

namespace App\Command;

use App\Service\GetCapitalServiceInterface;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

#[AsCommand(
    name: 'get-capital',
    description: 'Add a short description for your command',
)]
class GetCapitalCommand extends Command
{
    public function __construct(
        private GetCapitalServiceInterface $service,
    )
    {
        parent::__construct();
    }

    protected function configure(): void
    {
        $this
            ->addArgument('country', InputArgument::REQUIRED, 'Country name')
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $country = $input->getArgument('country');

        $capital = $this->service->getCapital($country);

        $output->writeln(sprintf('The capital of %s is %s', $country, $capital));

        return Command::SUCCESS;
    }
}
