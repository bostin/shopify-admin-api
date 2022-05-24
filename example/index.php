<?php

require '../vendor/autoload.php';

use BoShopify\Clients\Rest;
use BoShopify\Clients\Graphql;
use BoShopify\Config;


$config = new Config([
    'domain' => 'bostin.myshopify.com',
    'access_token' => 'aaaa',
]);

$rest = new Rest($config);
$graphql = new Graphql($config);


var_dump($rest->product->list(['limit' => 2]));


$query = <<<'GL'
{
    products(first: 2, reverse: true) {
        edges {
            cursor
            node {
                id
                title
                handle
            }
        }
    }
}
GL;

$data = [
    'query' => $query,
];
var_dump($graphql->query($data));
