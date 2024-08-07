<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Détails de l'exercice</title>
    <!-- Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container">
        <?php
        if (isset($_GET['id']) && is_numeric($_GET['id'])) {
            $id = $_GET['id'];

            try {
                $db = new PDO('sqlite:data/musculation.db');
                $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

                // Récupérer les détails de l'exercice
                $stmt = $db->prepare('SELECT * FROM exercises WHERE id = :id');
                $stmt->bindParam(':id', $id, PDO::PARAM_INT);
                $stmt->execute();
                $exercise = $stmt->fetch(PDO::FETCH_ASSOC);

                if ($exercise) {
                    echo "<h1 class='my-4'>" . htmlspecialchars($exercise['title']) . "</h1>";
                    if ($exercise['photo']) {
                        echo "<img src='" . htmlspecialchars($exercise['photo']) . "' alt='Photo de l'exercice' class='img-thumbnail' width='200' height='200'><br>";
                    }
                    echo "<p>" . nl2br(htmlspecialchars($exercise['description'])) . "</p>";

                    // Récupérer les entrées journalières de l'exercice
                    $stmt = $db->prepare('SELECT * FROM exercise_entries WHERE exercise_id = :exercise_id');
                    $stmt->bindParam(':exercise_id', $id, PDO::PARAM_INT);
                    $stmt->execute();
                    $entries = $stmt->fetchAll(PDO::FETCH_ASSOC);

                    if (count($entries) > 0) {
                        echo "<h3 class='my-4'>Entrées Journalières</h3>";
                        echo "<ul class='list-group'>";
                        foreach ($entries as $entry) {
                            echo "<li class='list-group-item'>";
                            echo "Date : " . htmlspecialchars($entry['date']) . "<br>";
                            echo "Poids : " . htmlspecialchars($entry['weight']) . " kg<br>";
                            echo "Répétitions : " . htmlspecialchars($entry['repetitions']) . "<br>";
                            echo "</li>";
                        }
                        echo "</ul>";
                    } else {
                        echo "<div class='alert alert-info' role='alert'>Aucune entrée disponible. Utilisez le formulaire ci-dessous pour ajouter une entrée.</div>";
                    }

                    // Formulaire pour ajouter une entrée journalière
                    echo "<h3 class='my-4'>Ajouter une entrée journalière</h3>";
                    echo "<form action='save_entry.php' method='post'>";
                    echo "<div class='form-group'>";
                    echo "<label for='date'>Date</label>";
                    echo "<input type='date' class='form-control' id='date' name='date' required>";
                    echo "</div>";
                    echo "<div class='form-group'>";
                    echo "<label for='weight'>Poids (kg)</label>";
                    echo "<input type='number' step='0.01' class='form-control' id='weight' name='weight' required>";
                    echo "</div>";
                    echo "<div class='form-group'>";
                    echo "<label for='repetitions'>Nombre de répétitions</label>";
                    echo "<input type='number' class='form-control' id='repetitions' name='repetitions' required>";
                    echo "</div>";
                    echo "<input type='hidden' name='exercise_id' value='" . htmlspecialchars($id) . "'>";
                    echo "<button type='submit' class='btn btn-primary'>Ajouter</button>";
                    echo "</form>";

                } else {
                    echo "<div class='alert alert-warning' role='alert'>Exercice non trouvé.</div>";
                }
            } catch (PDOException $e) {
                echo "<div class='alert alert-danger' role='alert'>Erreur : " . $e->getMessage() . "</div>";
            }
        } else {
            echo "<div class='alert alert-danger' role='alert'>ID invalide.</div>";
        }
        ?>
        <a href="session.php?id=<?php echo htmlspecialchars($exercise['session_id']); ?>" class="btn btn-secondary mt-4">Retour à la séance</a>
    </div>
    <!-- Bootstrap JS and dependencies -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
