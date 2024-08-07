<?php
// setup.php
try {
    $db = new PDO('sqlite:data/musculation.db');
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Créer les tables
    $db->exec(file_get_contents('database.sql'));

    echo "Base de données initialisée avec succès.";
} catch (PDOException $e) {
    echo "Erreur : " . $e->getMessage();
}
?>
