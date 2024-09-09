<?php

namespace App\Service;

use Symfony\Contracts\Cache\CacheInterface;
use Symfony\Contracts\Cache\ItemInterface;

class GetCapitalWithCacheService implements GetCapitalServiceInterface
{
    private const KEY_PREFIX = 'country_';

    public function __construct(private GetCapitalServiceInterface $inner, private CacheInterface $cache)
    {
    }

    public function getCapital(string $country): string
    {
        $key = self::KEY_PREFIX . $country;

        $value = $this->cache->get($key, function (ItemInterface $item) use ($country): string {
            $item->expiresAfter(3600);

            return $this->inner->getCapital($country);
        });

        return $value;
    }
}
