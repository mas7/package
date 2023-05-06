<?php

namespace Tests;

use Mas7\Transcriptions\Line;
use PHPUnit\Framework\TestCase;
use Mas7\Transcriptions\Transcription;

class TranscriptionTest extends TestCase
{
    protected Transcription $transcription;

    public function setUp(): void
    {
        parent::setUp();

        $this->transcription = Transcription::load(__DIR__ . '/stubs/basic-example.vtt');
    }


    /** @test */
    public function it_loads_a_vtt_file_as_a_string()
    {
        $this->assertStringContainsString("I'll give you some basic advice", $this->transcription);
    }

    /** @test */
    public function it_can_convert_to_an_array_of_line_objects()
    {
        $lines = $this->transcription->lines();

        $this->assertCount(2, $lines);

        $this->assertContainsOnlyInstancesOf(Line::class, $lines);
    }

    /** @test */
    public function it_discards_irrelevant_lines_from_the_vtt_file()
    {
        $this->assertStringNotContainsString('WEBVTT', $this->transcription);

        $this->assertCount(2, $this->transcription->lines());
    }

    /** @test */
    public function it_renders_the_lines_as_html()
    {
        $expected = <<<EOT
            <a href="?time=00:03">In this Larabit,</a>
            <a href="?time=00:04">I'll give you some basic advice</a>
            EOT;

        $this->assertEquals($expected, $this->transcription->htmlLines());
    }

}
