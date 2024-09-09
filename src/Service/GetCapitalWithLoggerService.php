<?php

namespace App\Service;

use Psr\Log\LoggerInterface;

class GetCapitalWithLoggerService implements GetCapitalServiceInterface
{
    public function __construct(private GetCapitalServiceInterface $inner, private LoggerInterface $logger)
    {
    }

    public function getCapital(string $country): string
    {
        $this->logger->info(sprintf('Request for %s started %d', $country, time()));

        $result = $this->inner->getCapital($country);

        $this->logger->info(sprintf('Request for %s finished %d', $country, time()));

        return $result;
    }
}
