<?php

namespace App\System\Oxford\v2\Builders;

use App\System\Oxford\v2\Entity\Entry;
use Illuminate\Support\Facades\Log;

class EntriesBuilder
{
    private $data;

    public function __construct($data)
    {
        $this->data = $data;
    }

    /**
     * @return Entry[]
     */
    public function build() : array
    {
        $entries = [];

        foreach (data_get($this->data, 'results', []) as $item) {
            try {
                $entries[] = $this->buildEntry($item);
            } catch (\InvalidArgumentException $e) {
                Log::error(sprintf('EntriesResponseBuilder: %s', $e->getMessage()));
            }
        }

        return $entries;
    }

    /**
     * @param $response
     *
     * @return Entry
     */
    private function buildEntry($response)
    {
        $entry = new Entry();

        foreach (data_get($response, 'lexicalEntries', []) as $lexicalEntry) {
            foreach (data_get($lexicalEntry, 'entries', []) as $item) {

                foreach (data_get($item, 'senses', []) as $sence) {
                    foreach (data_get($sence, 'definitions', []) as $definition) {
                        $entry->addDefinition($definition);
                    }
                }

                foreach (data_get($item, 'pronunciations', []) as $pronunciation) {
                    $entry->addPronunciation(data_get($pronunciation, 'audioFile'));
                }
            }
        }

        return $entry;
    }
}
