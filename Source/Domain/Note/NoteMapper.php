<?php

namespace Source\Domain\Note;

interface NoteMapper
{
    public function to(?int $id, string $title, string $body);
    public function from(array $dto): Note;
}
