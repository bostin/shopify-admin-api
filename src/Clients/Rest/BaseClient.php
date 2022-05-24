<?php

namespace BoShopify\Clients\Rest;

use BoShopify\Clients\Rest;

abstract class BaseClient
{
    public function __construct(protected readonly Rest $client) {}

    public function request(string $method, string $path, array|string $data = null, array $query = [])
    {
        return $this->client->request($method, $path, $data, $query);
    }

    /**
     * @param array|string|null $items
     * @param string $separated
     * @return string|null
     */
    protected function flat(array|string $items = null, string $separated = ','): ?string
    {
        if (is_array($items)) {
            return implode($separated, $items);
        }
        return $items;
    }

    /**
     * @param int $limit
     * @return int
     */
    protected function limit(int $limit = 250): int
    {
        return min(250, max(1, $limit));
    }
}