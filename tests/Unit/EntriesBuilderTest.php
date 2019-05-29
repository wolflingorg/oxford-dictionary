<?php

namespace Tests\Unit;

use App\System\Oxford\v2\Builders\EntriesBuilder;
use Tests\TestCase;

class EntriesBuilderTest extends TestCase
{
    public function testBuildWithValidResponse()
    {
        $data = json_decode(file_get_contents(base_path('tests/Unit/Fixtures/get-entries-en-gb-ace.json')),true);

        $builder = new EntriesBuilder($data);
        $result = $builder->build();

        $this->assertTrue(is_array($result));

        $this->assertEquals(
            $result[0]->getDefinitions(),
            [
                'a playing card with a single spot on it, ranked as the highest card in its suit in most card games',
                'a person who excels at a particular sport or other activity',
                '(in tennis and similar games) a service that an opponent is unable to return and thus wins a point',
                'very good',
                '(in tennis and similar games) serve an ace against (an opponent)',
                'achieve high marks in (a test or exam)'
            ]
        );

        $this->assertEquals(
            $result[0]->getPronunciations(),
            [
                'http://audio.oxforddictionaries.com/en/mp3/ace_1_gb_1_abbr.mp3',
            ]
        );
    }
}
