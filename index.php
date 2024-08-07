<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Liste des séances de musculation</title>
    <!-- Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container">
        <h1 class="my-4">Liste des séances de musculation</h1>
        <a href="add_session.php" class="btn btn-primary mb-4">+</a>
        <?php
        try {
            $db = new PDO('sqlite:data/musculation.db');
            $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            $result = $db->query('SELECT * FROM sessions');

            // Ajout d'une vérification pour le nombre de lignes
            $sessions = $result->fetchAll(PDO::FETCH_ASSOC);
            if (count($sessions) > 0) {
                echo "<div class='list-group'>";
                foreach ($sessions as $row) {
                    echo "<a href='session.php?id=" . htmlspecialchars($row['id']) . "' class='list-group-item list-group-item-action'>";
                    echo "<h5 class='mb-1'>" . htmlspecialchars($row['title']) . "</h5>";
                    echo "<p class='mb-1'>" . htmlspecialchars($row['description']) . "</p>";
                    echo "<small>Date : " . htmlspecialchars($row['date']) . "</small>";
                    echo "</a>";
                }
                echo "</div>";
            } else {
                echo "<div class='alert alert-info' role='alert'>Aucune séance disponible. Cliquez sur le bouton + pour ajouter une nouvelle séance.</div>";
            }
        } catch (PDOException $e) {
            echo "<div class='alert alert-danger' role='alert'>Erreur : " . $e->getMessage() . "</div>";
        }
        ?>
    </div>
    <!-- Bootstrap JS and dependencies -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
