<?php

namespace BoShopify\Clients\Rest;

class Order extends BaseClient
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
        return $this->request('get', 'orders', query: $query);
    }

    public function get(string|int $order_id, array|string $fields = null)
    {
        $query = [];
        $query['fields'] = $this->flat($fields);
        return $this->request('get', 'orders/' . $order_id, query: $query);
    }

    public function count(array $query = [])
    {
        return $this->request('get', 'orders/count', query: $query);
    }
}
