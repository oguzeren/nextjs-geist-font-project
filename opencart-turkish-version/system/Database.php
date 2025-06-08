<?php
namespace System;

class Database {
    private $connection;

    public function __construct() {
        $this->connection = new \mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
        if ($this->connection->connect_error) {
            die("Database connection failed: " . $this->connection->connect_error);
        }
        $this->connection->set_charset("utf8mb4");
    }

    public function query($sql) {
        $result = $this->connection->query($sql);
        if ($result === false) {
            die("Database query error: " . $this->connection->error);
        }
        return $result;
    }

    public function escape($value) {
        return $this->connection->real_escape_string($value);
    }

    public function insert_id() {
        return $this->connection->insert_id;
    }
}
?>
