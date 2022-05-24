<?php

namespace BoShopify\Clients;

use BoShopify\Clients\Rest\Collect;
use BoShopify\Clients\Rest\Collection;
use BoShopify\Clients\Rest\CustomCollection;
use BoShopify\Clients\Rest\Order;
use BoShopify\Clients\Rest\Product;
use BoShopify\Clients\Rest\ProductImage;
use BoShopify\Clients\Rest\ProductVariant;
use BoShopify\Clients\Rest\Shop;
use BoShopify\Clients\Rest\SmartCollection;
use BoShopify\Exceptions\RestClientNotFoundException;

/**
 * @property-read Collect $collect
 * @property-read Collection $collection
 * @property-read CustomCollection $customCollection
 * @property-read Order $order
 * @property-read Product $product
 * @property-read ProductImage $productImage
 * @property-read ProductVariant $productVariant
 * @property-read Shop $shop
 * @property-read SmartCollection $smartCollection
 */
class Rest extends Client
{
    protected array $magics = [];

    public function __get(string $name)
    {
        $name = ucfirst($name);
        if (!$this->magics[$name]) {
            $class = __NAMESPACE__ . '\\Rest\\' . $name;
            if (!class_exists($class)) {
                throw new RestClientNotFoundException('Not found rest client for: ' . $name);
            }
            $this->magics[$name] = new $class($this);
        }
        return $this->magics[$name];
    }

    protected function getUri(string $path): string
    {
        $path = trim($path, '/');
        $version = $this->config->get('api_version', 'stable');
        return sprintf('admin/api/%s/%s.json', $version, $path);
    }

    public function request(string $method, string $path, array|string $data = null, array $query = [])
    {
        $headers = [];
        $headers['X-Shopify-Access-Token'] = $this->config->get('access_token');
        if (in_array(strtolower($method), ['post', 'put', 'patch'], true)) {
            if (is_array($data)) {
                $headers['Content-Type'] = 'application/json';
                $data = json_encode($data);
            }
        } else {
            $data = null;
        }

        $options = [];
        $options['headers'] = $headers;
        $options['query'] = $query;
        $options['body'] = $data;
        $uri = $this->getUri($path);
        return $this->client->request($method, $uri, $options);
    }
}