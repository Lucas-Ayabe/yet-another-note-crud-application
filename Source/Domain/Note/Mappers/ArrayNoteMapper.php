<?php

namespace Source\Domain\Note\Mappers;

use Source\Domain\Note\Note;
use Source\Domain\Note\NoteMapper;

class ArrayNoteMapper implements NoteMapper
{
    public function to(?int $id, string $title, string $body): array
    {
        return [
            'id' => $id,
            'title' => $title,
            'body' => $body
        ];
    }

    public function from(array $dto): Note
    {
        return new Note(
            id: $dto['id'],
            title: $dto['title'],
            body: $dto['body']
        );
    }
}
