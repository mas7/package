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

    public function toAnchorTag()
    {
        return "<a href=\"?time={$this->beginningTimestamp()}\">{$this->body}</a>";
    }

    public function beginningTimestamp()
    {
        preg_match('/^\d{2}:(\d{2}:\d{2})\.\d{3}/', $this->timestamp, $matches);

        return $matches[1];
    }
}
