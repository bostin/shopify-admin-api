<?php

namespace BoShopify\Clients\Rest;

class Collection extends BaseClient
{
    public function get(string|int $collection_id, array|string $fields = null)
    {
        $query = [];
        $query['fields'] = $this->flat($fields);
        return $this->request('get', 'collections/' . $collection_id, query: $query);
    }

    public function products(
        string|int $collection_id,
        int        $limit = 250,
    )
    {
        $query = [];
        $query['limit'] = $this->limit($limit);
        return $this->request('get', 'collections/' . $collection_id . '/products', query: $query);
    }
}