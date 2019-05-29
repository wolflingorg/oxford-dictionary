<?php

namespace Tests\Unit;

use App\System\Oxford\Client\ClientException;
use App\System\Oxford\Client\ClientInterface;
use App\System\Oxford\v2\Dictionary;
use App\System\Oxford\v2\DictionaryException;
use App\System\Oxford\v2\Entity\Entry;
use PHPUnit\Framework\MockObject\MockObject;
use Tests\TestCase;

class DictionaryTest extends TestCase
{
    public function testEntriesPositive()
    {
        $client = $this->getClientMockObject();
        $client->method('get')
            ->willReturn(
                json_decode(
                    file_get_contents(base_path('tests/Unit/Fixtures/get-entries-en-gb-ace.json')),
                    true
                )
            );

        $dictionary = new Dictionary($client);

        $response = $dictionary->entries('en-gb', 'ace');

        $this->assertTrue(is_array($response));
        $this->assertEquals(get_class($response[0]), Entry::class);
    }

    public function testEntriesNegative()
    {
        $client = $this->getClientMockObject();
        $client->method('get')
            ->willThrowException(new ClientException('Exception'));

        $dictionary = new Dictionary($client);

        $this->expectException(DictionaryException::class);

        $dictionary->entries('en-gb', 'ace');
    }

    /**
     * @return ClientInterface|MockObject
     */
    private function getClientMockObject()
    {
        $client = $this->getMockBuilder(ClientInterface::class)
            ->getMock();

        return $client;
    }
}
