<?php

namespace BoShopify\Clients\Rest;

class Collect extends BaseClient
{
    public function list(array $query = [])
    {
        if (isset($query['limit'])) {
            $query['limit'] = $this->limit($query['limit']);
        }
        $fields = ['fields'];
        foreach ($fields as $field) {
            if (!isset($query[$field])) {
                continue;
            }
            $query[$field] = $this->flat($query[$field]);
        }
        return $this->request('get', 'collects', query: $query);
    }

    public function get(string|int $collect_id, array|string $fields = null)
    {
        $query = [];
        $query['fields'] = $this->flat($fields);
        return $this->request('get', 'collects/' . $collect_id, query: $query);
    }

    public function count()
    {
        return $this->request('get', 'collects/count');
    }
}
