<?php

namespace Source\Domain\Note;

interface NoteRepository
{
    public function list(): array;
    public function add(Note $note): bool;
    public function addAll(array $notes): bool;
}
