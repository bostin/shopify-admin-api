<?php

namespace BoShopify\Clients;

use BoShopify\Config;
use GuzzleHttp\Client as HttpClient;

abstract class Client
{
    protected readonly Config $config;
    protected readonly HttpClient $client;

    public function __construct(Config $config)
    {
        $this->config = $config;
        $this->init();
    }

    protected function init(): void
    {
        $this->resolveHttpClient();
    }

    protected function resolveHttpClient(): void
    {
        $this->client = new HttpClient([
            'base_uri' => 'https://' . $this->config->get('domain') . '/',
        ]);
    }
}