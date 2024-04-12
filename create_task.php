<?php
// Inclusion du fichier de connexion à la base de données et de la classe Task
require_once 'database/db.php';
require_once 'class/Task.php';

// Connexion à la base de données
$db = new Database();
$conn = $db->connect();

// Création d'une instance de la classe Task
$taskManager = new Task($conn);

// Vérification de la soumission du formulaire
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["create_task"])) {
    // Récupération des données du formulaire
    $label = $_POST["label"];
    $description = $_POST["description"];
    $due_date = $_POST["due_date"];
    $priority = $_POST["priority"];

    // Création de la tâche dans la base de données
    if ($taskManager->createTask($label, $description, $due_date, $priority, 'à faire')) {
        echo "<div class='alert alert-success mt-3'>La tâche a été créée avec succès!</div>";
    } else {
        echo "<div class='alert alert-danger mt-3'>Une erreur est survenue lors de la création de la tâche.</div>";
    }
}
?>


<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Créer une nouvelle tâche</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-5">
        <h2>Créer une nouvelle tâche</h2>
        <form action="" method="POST">
            <div class="form-group">
                <label for="label">Libellé de la tâche:</label>
                <input type="text" class="form-control" id="label" name="label" required>
            </div>
            <div class="form-group">
                <label for="description">Description:</label>
                <textarea class="form-control" id="description" name="description" rows="3" required></textarea>
            </div>
            <div class="form-group">
                <label for="due_date">Date d'échéance:</label>
                <input type="date" class="form-control" id="due_date" name="due_date" required>
            </div>
            <div class="form-group">
                <label for="priority">Priorité:</label>
                <select class="form-control" id="priority" name="priority" required>
                    <option value="faible">Faible</option>
                    <option value="moyenne">Moyenne</option>
                    <option value="élevée">Élevée</option>
                </select>
            </div>
            <div class="form-group">
                <label for="priority">Etat:</label>
                <select class="form-control" id="priority" name="priority" required>
                    <option value="à faire">à faire</option>
                    <option value="en cours">en cours</option>
                    <option value="terminée">terminée</option>
                </select>
            </div>
            <button type="submit" class="btn btn-primary">Créer la tâche</button>
        </form>
    </div>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
