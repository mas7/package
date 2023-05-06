<?php

namespace Mas7\Transcriptions;

class Transcription
{
    public function __construct(protected array $lines)
    {
        $this->lines = $this->discardInvalidLines(array_map('trim', $lines));
    }

    public static function load(string $path): self
    {
        return new static(file($path));
    }

    public function lines(): array
    {
        $lines = [];

        foreach (range(0, count($this->lines) - 1, 2) as $i) {
            $lines[] = new Line(timestamp: $this->lines[$i], body: $this->lines[$i + 1]);
        }

        return $lines;
    }

    protected function discardInvalidLines(array $lines): array
    {
        return array_values(
            array_filter(
                $lines,
                fn($line) => Line::valid($line)
            )
        );
    }

    public function htmlLines()
    {
        $htmlLines = array_map(fn (Line $line) => $line->toAnchorTag(), $this->lines());

        return implode("\n", $htmlLines);
    }

    public function __toString(): string
    {
        return implode("\n", $this->lines);
    }
}
