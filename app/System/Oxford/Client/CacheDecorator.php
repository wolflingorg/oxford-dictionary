<?php

namespace App\System\Oxford\Client;

use Illuminate\Support\Facades\Cache;

class CacheDecorator implements ClientInterface
{
    /**
     * @var ClientInterface
     */
    private $client;

    public function __construct(ClientInterface $client)
    {
        $this->client = $client;
    }

    /**
     * @inheritdoc
     */
    public function get(string $url)
    {
        return Cache::remember(md5($url), 60, function () use ($url) {
            return $this->client->get($url);
        });
    }
}
