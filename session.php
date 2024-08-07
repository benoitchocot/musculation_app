<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Détails de la séance de musculation</title>
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

                // Récupérer les détails de la séance
                $stmt = $db->prepare('SELECT * FROM sessions WHERE id = :id');
                $stmt->bindParam(':id', $id, PDO::PARAM_INT);
                $stmt->execute();
                $session = $stmt->fetch(PDO::FETCH_ASSOC);

                if ($session) {
                    echo "<h1 class='my-4'>" . htmlspecialchars($session['title']) . "</h1>";
                    echo "<p>" . nl2br(htmlspecialchars($session['description'])) . "</p>";

                    // Récupérer les exercices de la séance
                    $stmt = $db->prepare('SELECT * FROM exercises WHERE session_id = :session_id');
                    $stmt->bindParam(':session_id', $id, PDO::PARAM_INT);
                    $stmt->execute();
                    $exercises = $stmt->fetchAll(PDO::FETCH_ASSOC);

                    if (count($exercises) > 0) {
                        echo "<h3 class='my-4'>Exercices</h3>";
                        echo "<ul class='list-group'>";
                        foreach ($exercises as $exercise) {
                            echo "<li class='list-group-item'>";
                            if ($exercise['photo']) {
                                echo "<img src='" . htmlspecialchars($exercise['photo']) . "' alt='Photo de l'exercice' class='img-thumbnail' width='100' height='100'><br>";
                            }
                            echo "<strong>" . htmlspecialchars($exercise['title']) . "</strong><br>";
                            echo "Poids : " . htmlspecialchars($exercise['weight']) . " kg<br>";
                            echo "Répétitions : " . htmlspecialchars($exercise['repetitions']) . "<br>";
                            echo "</li>";
                        }
                        echo "</ul>";
                    } else {
                        echo "<div class='alert alert-info' role='alert'>Aucun exercice disponible. Utilisez le formulaire ci-dessous pour ajouter un exercice.</div>";
                    }

                    // Formulaire pour ajouter un exercice
                    echo "<h3 class='my-4'>Ajouter un exercice</h3>";
                    echo "<form action='save_exercise.php' method='post' enctype='multipart/form-data'>";
                    echo "<div class='form-group'>";
                    echo "<label for='title'>Titre de l'exercice</label>";
                    echo "<input type='text' class='form-control' id='title' name='title' required>";
                    echo "</div>";
                    echo "<div class='form-group'>";
                    echo "<label for='photo'>Photo de l'exercice (optionnelle)</label>";
                    echo "<input type='file' class='form-control-file' id='photo' name='photo'>";
                    echo "</div>";
                    echo "<div class='form-group'>";
                    echo "<label for='weight'>Poids (kg)</label>";
                    echo "<input type='number' step='0.01' class='form-control' id='weight' name='weight' required>";
                    echo "</div>";
                    echo "<div class='form-group'>";
                    echo "<label for='repetitions'>Nombre de répétitions</label>";
                    echo "<input type='number' class='form-control' id='repetitions' name='repetitions' required>";
                    echo "</div>";
                    echo "<input type='hidden' name='session_id' value='" . htmlspecialchars($id) . "'>";
                    echo "<button type='submit' class='btn btn-primary'>Ajouter</button>";
                    echo "</form>";

                } else {
                    echo "<div class='alert alert-warning' role='alert'>Séance non trouvée.</div>";
                }
            } catch (PDOException $e) {
                echo "<div class='alert alert-danger' role='alert'>Erreur : " . $e->getMessage() . "</div>";
            }
        } else {
            echo "<div class='alert alert-danger' role='alert'>ID invalide.</div>";
        }
        ?>
        <a href="index.php" class="btn btn-secondary mt-4">Retour à la liste</a>
    </div>
    <!-- Bootstrap JS and dependencies -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
