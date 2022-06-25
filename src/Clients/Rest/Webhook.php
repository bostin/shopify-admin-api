<?php

namespace BoShopify\Clients\Rest;

class Webhook extends BaseClient
{
    public function list($query = [])
    {
        return $this->request('GET', 'webhooks', $query);
    }

    public function create(string $topic, string $address, string $format = 'json')
    {
        $params = [
            'topic' => $topic,
            'address' => $address,
            'format'  => $format,
        ];
        return $this->request('POST', 'webhooks', $params);
    }
}
