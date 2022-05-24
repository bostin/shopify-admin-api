<?php

namespace BoShopify\Clients;

class Graphql extends Client
{
    public function query(array|string $data)
    {
        $headers = [];

        $headers['X-Shopify-Access-Token'] = $this->config->get('access_token');
        if (is_array($data)) {
            $headers['Content-Type'] = 'application/json';
            $data = json_encode($data);
        } else {
            $headers['Content-Type'] = 'application/graphql';
        }

        $options = [];
        $options['body'] = $data;
        $options['headers'] = $headers;

        $uri = 'admin/api/'. $this->config->get('version', 'unstable') .'/graphql.json';
        $response = $this->client->post($uri, $options);
        return json_decode((string) $response->getBody(), true);
    }
}
