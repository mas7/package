<?php

namespace Tests;

use PHPUnit\Framework\TestCase;
use Mas7\Transcriptions\Transcription;

class TranscriptionTest extends TestCase
{
    /** @test */
    public function it_loads_a_vtt_file()
    {
        $transcription = Transcription::load(__DIR__ . '/stubs/basic-example.vtt');

        $expected = file_get_contents(__DIR__ . '/stubs/basic-example.vtt');

        $this->assertEquals($expected, $transcription);
    }
}
