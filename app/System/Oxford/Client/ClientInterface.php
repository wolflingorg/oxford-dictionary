<?php

namespace App\System\Oxford\Client;

interface ClientInterface
{
    /**
     * @param  string  $url
     *
     * @return array
     * @throws ClientException
     */
    public function get(string $url);
}
