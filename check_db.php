<?php
// check_db.php
try {
    $db = new PDO('sqlite:data/musculation.db');
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $result = $db->query('SELECT * FROM sessions');

    foreach ($result as $row) {
        echo "ID: " . $row['id'] . "<br>";
        echo "Titre: " . $row['title'] . "<br>";
        echo "Description: " . $row['description'] . "<br>";
    }
} catch (PDOException $e) {
    echo "Erreur : " . $e->getMessage();
}
?>
