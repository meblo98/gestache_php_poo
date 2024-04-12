<?php

class Task {
    private $conn;

    public function __construct($db_conn) {
        $this->conn = $db_conn;
    }

    // Méthode pour créer une nouvelle tâche
    public function createTask($labelle, $description, $date_echeance, $priorite, $status) {
        $sql = "INSERT INTO tache (label, description, date_echeance, priorite, status) VALUES (?, ?, ?, ?, ?)";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("ssssi", $labelle, $description, $date_echeance, $priorite, $status);

        if ($stmt->execute()) {
            return true;
        } else {
            return false;
        }
    }

    // Méthode pour récupérer toutes les tâches d'un utilisateur
    public function getTasksByUser($user_id) {
        $sql = "SELECT * FROM tache WHERE user_id = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("i", $user_id);
        $stmt->execute();
        $result = $stmt->get_result();

        $tasks = [];
        while ($row = $result->fetch_assoc()) {
            $tasks[] = $row;
        }

        return $tasks;
    }

}

?>
