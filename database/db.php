<?php

require_once 'config.php';

class Database {
    private $host = DB_HOST;
    private $user = DB_USER;
    private $pass = DB_PASS;
    private $dbname = DB_NAME;

    private $conn;

    // Méthode pour établir la connexion à la base de données
    public function connect() {
        $this->conn = new mysqli($this->host, $this->user, $this->pass, $this->dbname);

        if ($this->conn->connect_error) {
            die("Erreur de connexion à la base de données : " . $this->conn->connect_error);
        }

        return $this->conn;
    }

    // Méthode pour fermer la connexion à la base de données
    public function close() {
        $this->conn->close();
    }
}

