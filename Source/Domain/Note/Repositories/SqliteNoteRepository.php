<?php

namespace Source\Domain\Note\Repositories;

use PDO;
use PDOStatement;
use Source\Domain\Note\Mappers\ArrayNoteMapper;
use Source\Domain\Note\Note;
use Source\Domain\Note\NoteMapper;
use Source\Domain\Note\NoteRepository;

class SqliteNoteRepository implements NoteRepository
{
    public function __construct(
        private PDO $connection,
        private NoteMapper $toArrayMapper
    ) {
    }

    public function list(): array
    {
        $statement = $this->connection->prepare("SELECT * FROM notes");
        $statement->execute();
        return array_map([$this->toArrayMapper, 'from'], $statement->fetchAll());
    }

    private function prepareInsert(Note $note): PDOStatement
    {
        $dto = $note->map($this->toArrayMapper);
        $columns = array_keys($dto);
        $placeholders = array_map(fn () => "?", $columns);
        $query = join(
            ' ',
            [
                "INSERT",
                "INTO",
                "notes",
                "(" . join(', ', $columns) . ")",
                "VALUES",
                "(" . join(", ", $placeholders) . ")"
            ]
        );

        return $this->connection->prepare($query);
    }

    public function add(Note $note): bool
    {
        $query = $this->prepareInsert($note);
        return $query->execute(array_values($note->map($this->toArrayMapper)));
    }

    public function addAll(array $notes): bool
    {
        if (empty($notes)) {
            return false;
        }

        $query = $this->prepareInsert($notes[0]);
        foreach ($notes as $note) {
            $query->execute(array_values($note->map($this->toArrayMapper)));
        }

        return true;
    }
}
