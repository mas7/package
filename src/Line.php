<?php

namespace Mas7\Transcriptions;

class Line
{
    public function __construct(public string $timestamp, public string $body)
    {
    }
    public static function valid(string $line): bool
    {
        return $line !== 'WEBVTT' && $line !== '' && !is_numeric($line);
    }
}
