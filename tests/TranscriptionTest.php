<?php

namespace Tests;

use PHPUnit\Framework\TestCase;
use Mas7\Transcriptions\Transcription;

class TranscriptionTest extends TestCase
{
    /** @test */
    public function it_loads_a_vtt_file_as_a_string()
    {
        $file = __DIR__ . '/stubs/basic-example.vtt';

        $transcription = Transcription::load($file);

        $this->assertStringContainsString("I'll give you some basic advice", $transcription);
    }

    /** @test */
    public function it_can_convert_to_an_array_of_lines()
    {
        $file = __DIR__ . '/stubs/basic-example.vtt';

        $this->assertCount(4, Transcription::load($file)->lines());
    }

    /** @test */
    public function it_discards_irrelevant_lines_from_the_vtt_file()
    {
        $file = __DIR__ . '/stubs/basic-example.vtt';

        $transcription = Transcription::load($file);

        $this->assertStringNotContainsString('WEBVTT', $transcription);
        $this->assertCount(4, $transcription->lines());
    }

}
