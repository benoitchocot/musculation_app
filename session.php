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

                $stmt = $db->prepare('SELECT * FROM sessions WHERE id = :id');
                $stmt->bindParam(':id', $id, PDO::PARAM_INT);
                $stmt->execute();
                $session = $stmt->fetch(PDO::FETCH_ASSOC);

                if ($session) {
                    echo "<h1 class='my-4'>" . htmlspecialchars($session['title']) . "</h1>";
                    echo "<p>" . nl2br(htmlspecialchars($session['description'])) . "</p>";
                    echo "<p><strong>Date : </strong>" . htmlspecialchars($session['date']) . "</p>";
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
