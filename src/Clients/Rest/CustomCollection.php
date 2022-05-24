<?php

namespace BoShopify\Clients\Rest;

class CustomCollection extends BaseClient
{
    public function list(array $query = [])
    {
        if (isset($query['limit'])) {
            $query['limit'] = $this->limit($query['limit']);
        }
        $fields = ['fields', 'ids'];
        foreach ($fields as $field) {
            $query[$field] = $this->flat($query[$field]);
        }
        return $this->request('get', 'custom_collections', query: $query);
    }

    public function get(string|int $custom_collection_id, array|string $fields = null)
    {
        $query = [];
        $query['fields'] = $this->flat($fields);
        return $this->request('get', 'custom_collections/' . $custom_collection_id, query: $query);
    }

    public function count(array $query = [])
    {
        return $this->request('get', 'custom_collections/count', query: $query);
    }
}