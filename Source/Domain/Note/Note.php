<?php

namespace Source\Domain\Note;

class Note
{
    public function __construct(
        private ?int $id,
        private string $title,
        private string $body
    ) {
    }

    public static function fromProperties(string $title, string $body)
    {
        return new self(
            id: null,
            title: $title,
            body: $body
        );
    }

    public function map(NoteMapper $noteMapper)
    {
        return $noteMapper->to($this->id, $this->title, $this->body);
    }
}
