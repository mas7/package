<?php

namespace Tests;

use Mas7\Transcriptions\Line;
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
    public function it_can_convert_to_an_array_of_line_objects()
    {
        $file = __DIR__ . '/stubs/basic-example.vtt';

        $lines = Transcription::load($file)->lines();

        $this->assertCount(2, $lines);

        $this->assertContainsOnlyInstancesOf(Line::class, $lines);
    }

    /** @test */
    public function it_discards_irrelevant_lines_from_the_vtt_file()
    {
        $file = __DIR__ . '/stubs/basic-example.vtt';

        $transcription = Transcription::load($file);

        $this->assertStringNotContainsString('WEBVTT', $transcription);

        $this->assertCount(2, $transcription->lines());
    }

    /** @test */
    public function it_renders_the_lines_as_html()
    {
        $file = __DIR__ . '/stubs/basic-example.vtt';

        $transcription = Transcription::load($file);

        $expected = <<<EOT
        <a href="?time=00:03">In this Larabit,</a>
        <a href="?time=00:04">I'll give you some basic advice</a>
        EOT;

        $result = $transcription->htmlLines();

        $this->assertEquals($expected, $result);
    }

}
