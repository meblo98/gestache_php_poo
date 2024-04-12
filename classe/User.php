<?php
require_once '../database/db.php';
error_reporting(E_ALL);
ini_set('display_errors', 1);
class User {
    private $conn;

    public function __construct($db_conn) {
        $this->conn = $db_conn;
    }

    // Méthode pour créer un nouvel utilisateur
    public function createUser($firstname, $lastname,$username, $password) {
        // Vous devrez utiliser des techniques de hachage pour stocker les mots de passe de manière sécurisée
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);

        $sql = "INSERT INTO user (username,nom,prenom, mdp) VALUES (?,?,?, ?)";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("ssss", $username,$firstname, $lastname, $hashed_password);

        if ($stmt->execute()) {
            return true;
        } else {
            return false;
        }
    }

    // Méthode pour authentifier un utilisateur
    public function authenticateUser($username, $password) {
        $sql = "SELECT id, username, password FROM user WHERE username = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("s", $username);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows == 1) {
            $user = $result->fetch_assoc();
            if (password_verify($password, $user['password'])) {
                return $user['id'];
            } else {
                return false;
            }
        } else {
            return false;
        }
    }

}

