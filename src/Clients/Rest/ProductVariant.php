<?php

namespace BoShopify\Clients\Rest;

class ProductVariant extends BaseClient
{
    public function list(
        string|int   $product_id,
        array|string $fields = null,
        int          $limit = 50,
        array|string $presentment_currencies = null,
        string|int   $since_id = null
    )
    {
        $query = [];
        $query['fields'] = $this->flat($fields);
        $query['limit'] = $this->limit($limit);
        $query['presentment_currencies'] = $this->flat($presentment_currencies);
        $query['since_id'] = $since_id;
        return $this->request('get', 'products/' . $product_id . '/variants', query: $query);
    }

    public function get(string|int $variant_id, array|string $fields = null)
    {
        $query = [];
        $query['fields'] = $this->flat($fields);
        return $this->request('get', 'variants/' . $variant_id, query: $query);
    }

    public function count(string|int $product_id)
    {
        return $this->request('get', 'products/' . $product_id . '/variants/count');
    }
}