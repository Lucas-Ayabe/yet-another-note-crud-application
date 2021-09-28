<?php
$conn = new PDO("sqlite:./database/notes.db");
$conn->exec(
    <<<SQL
        CREATE TABLE IF NOT EXISTS notes (
            id INTEGER PRIMARY KEY,
            title TEXT,
            body TEXT
        )
    SQL
);

$stmt = $conn->prepare(
    <<<SQL
        SELECT name
        FROM sqlite_master
        WHERE type = 'table'
        ORDER BY name
    SQL
);

$stmt->execute();

var_dump($stmt->fetchAll(\PDO::FETCH_ASSOC));
