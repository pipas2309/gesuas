<?php

namespace App\config;

//use PDO;
use PDOException;
use SQLite3;

class Database
{
   // private PDO $pdo;
    private string $dbPath;

    private SQLite3 $db;

    public function __construct()
    {
        $this->dbPath = __DIR__ . '/database.sqlite';
        //$this->pdo = new PDO("sqlite:$this->dbPath");
        //$this->start();
        $this->db = new SQLite3($this->dbPath, SQLITE3_OPEN_CREATE | SQLITE3_OPEN_READWRITE);
        $this->start();
    }

    private function start()
    {

        try{
            $this->db->enableExceptions(true);
            $this->db->query('CREATE TABLE IF NOT EXISTS "citizens" (
            "id" INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL,
            "name" VARCHAR NOT NULL,
            "nis" INTEGER UNIQUE NOT NULL,
            "created_at" DATETIME

            );');

        } catch (\SQLiteException $exception) {
            throw new PDOException("Database connection error: " . $exception->getMessage(), (int)$exception->getCode() . "[code]");
        }

    }

    public function getConnection(): SQLite3
    {
        return $this->db;
    }
}
