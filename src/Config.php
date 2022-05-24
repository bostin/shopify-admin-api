<?php

namespace BoShopify;

use Illuminate\Support\Arr;

class Config
{
    protected array $item = [];

    protected array $default = [];

    public function __construct(array $data = [])
    {
        $this->item = [...$this->default, ...$data];
    }

    public function get(string $key, $default = null): mixed
    {
        return Arr::get($this->item, $key, $default);
    }

    public function has(string $key): bool
    {
        return Arr::has($this->item, $key);
    }
}