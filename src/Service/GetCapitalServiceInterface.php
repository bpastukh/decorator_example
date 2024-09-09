<?php

namespace App\Service;

interface GetCapitalServiceInterface
{
    public function getCapital(string $country): string;
}
