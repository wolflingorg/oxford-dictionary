<?php

namespace App\System\Oxford\v2;

use App\System\Oxford\Client\ClientException;
use App\System\Oxford\Client\ClientInterface;
use App\System\Oxford\v2\Builders\EntriesBuilder;
use App\System\Oxford\v2\Entity\Entry;

class Dictionary
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
     * @param  string  $lang
     * @param  string  $word
     *
     * @return Entry[]
     * @throws DictionaryException
     */
    public function entries(string $lang, string $word) : array
    {
        try {
            $data = $this->client->get(sprintf(
                'entries/%s/%s?fields=definitions%%2Cexamples%%2Cpronunciations&strictMatch=false',
                $lang,
                $word
            ));
        } catch (ClientException $e) {
            switch ($e->getCode()) {
                case 404:
                    $data = null;
                    break;
                default:
                    throw new DictionaryException('Something went wrong');
            }

        }

        return (new EntriesBuilder($data))->build();
    }
}
