<?php

namespace BoShopify\Clients\Rest;

class Shop extends BaseClient
{
    public function get(array|string $fields = null)
    {
        $query = [];
        $query['fields'] = $this->flat($fields);
        return $this->request('get', 'shop', query: $query);
    }
}