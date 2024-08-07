<?php
// save_session.php
try {
    $db = new PDO('sqlite:data/musculation.db');
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $stmt = $db->prepare("INSERT INTO sessions (title, description) VALUES (:title, :description)");
    $stmt->bindParam(':title', $_POST['title']);
    $stmt->bindParam(':description', $_POST['description']);

    if ($stmt->execute()) {
        header('Location: index.php');
        exit();
    } else {
        echo "Erreur lors de l'ajout de la séance.";
    }
} catch (PDOException $e) {
    echo "Erreur : " . $e->getMessage();
}
?>
