<?php

namespace Mas7\Transcriptions;

class Transcription
{
    public function __construct(protected array $lines)
    {
        $this->lines = $this->discardInvalidLines($lines);
    }

    public static function load(string $path): self
    {
        return new static(file($path));
    }

    public function lines(): array
    {
        return array_map(
            fn($line) => new Line(...$line),
            array_chunk($this->lines, 3)
        );
    }

    protected function discardInvalidLines(array $lines): array
    {
        return array_slice(array_filter(array_map('trim', $lines)), 1);
    }

    public function htmlLines()
    {
        $htmlLines = array_map(fn(Line $line) => $line->toAnchorTag(), $this->lines());

        return implode("\n", $htmlLines);
    }

    public function __toString(): string
    {
        return implode("\n", $this->lines);
    }
}
