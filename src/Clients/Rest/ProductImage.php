<?php

namespace BoShopify\Clients\Rest;

class ProductImage extends BaseClient
{
    public function list(string|int $product_id, array|string $fields = null, string|int $since_id = null)
    {
        $query = [];
        $query['since_id'] = $since_id;
        $query['fields'] = $this->flat($fields);
        return $this->request('get', 'product/' . $product_id . '/images', query: $query);
    }

    public function get(string|int $product_id, string|int $image_id, array|string $fields = null)
    {
        $query = [];
        $query['fields'] = $this->flat($fields);
        return $this->request('get', 'product/' . $product_id . '/images/' . $image_id, query: $query);
    }

    public function count(string|int $product_id)
    {
        return $this->request('get', 'product/' . $product_id . '/images/count');
    }
}