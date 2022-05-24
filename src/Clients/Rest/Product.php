<?php

namespace BoShopify\Clients\Rest;

class Product extends BaseClient
{
    public function list(array $query = [])
    {
        if (isset($query['limit'])) {
            $query['limit'] = $this->limit($query['limit']);
        }

        $fields = ['fields','handle', 'ids', 'presentment_currencies', 'status'];
        foreach ($fields as $field) {
            if (!isset($query[$field])) {
                continue;
            }
            $query[$field] = $this->flat($query[$field]);
        }

        return $this->request('get', 'products', query: $query);
    }

    public function get(string|int $id, array|string $fields = null)
    {
        $query = [];
        $query['fields'] = $this->flat($fields);
        return $this->request('get', 'product/' . $id, query: $query);
    }

    public function count(array $query = [])
    {
        return $this->request('get', 'products/count', query: $query);
    }
}
