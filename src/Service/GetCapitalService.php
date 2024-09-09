<?php

namespace App\Service;

class GetCapitalService implements GetCapitalServiceInterface
{
    private const API_URL = 'https://restcountries.com/v3.1/name/%s';

    public function getCapital(string $country): string
    {
        $url = sprintf(self::API_URL, $country);

        $response = file_get_contents($url);
        $capital = json_decode($response, true)[0]['capital'][0];

        return $capital;
    }
}
