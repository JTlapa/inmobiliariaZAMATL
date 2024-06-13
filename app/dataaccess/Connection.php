<?php

class   Connection {
    private $connection;
    private $host;
    private $user;
    private $password;
    private $database;

    public function __construct() {
        $this->host = "localhost";
        $this->user = "root";
        $this->password = "Agosto#_110821";
        $this->database = "inmobiliariaZAMATL";
    }

    public function getConnection() {
        $this->connection = new mysqli($this->host, $this->user, $this->password, $this->database);

        if ($this->connection->connect_error) {
            die("Error de conexión: " . $this->connection->connect_error);
        }
        return $this->connection;
    }

    public function closeConnection() {
        if ($this->connection) {
            $this->connection->close();
            $this->connection = null;
        }
    }
}
?>
