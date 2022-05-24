<?php

namespace BoShopify\Clients\Rest;

class SmartCollection extends BaseClient
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
        return $this->request('get', 'smart_collections', query: $query);
    }

    public function get(string|int $smart_collection_id, array|string $fields = null)
    {
        $query = [];
        $query['fields'] = $this->flat($fields);
        return $this->request('get', 'smart_collections/' . $smart_collection_id, query: $query);
    }

    public function count(array $query = [])
    {
        return $this->request('get', 'smart_collections/count', query: $query);
    }
}