<?php
// save_exercise.php
try {
    $db = new PDO('sqlite:data/musculation.db');
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $stmt = $db->prepare("INSERT INTO exercises (session_id, title, description, photo) VALUES (:session_id, :title, :description, :photo)");

    $session_id = $_POST['session_id'];
    $title = $_POST['title'];
    $description = $_POST['description'];

    // Gestion de la photo
    if (isset($_FILES['photo']) && $_FILES['photo']['error'] == UPLOAD_ERR_OK) {
        $photo = 'uploads/' . basename($_FILES['photo']['name']);
        move_uploaded_file($_FILES['photo']['tmp_name'], $photo);
    } else {
        $photo = null;
    }

    $stmt->bindParam(':session_id', $session_id, PDO::PARAM_INT);
    $stmt->bindParam(':title', $title, PDO::PARAM_STR);
    $stmt->bindParam(':description', $description, PDO::PARAM_STR);
    $stmt->bindParam(':photo', $photo);

    if ($stmt->execute()) {
        header('Location: session.php?id=' . $session_id);
        exit();
    } else {
        echo "Erreur lors de l'ajout de l'exercice.";
    }
} catch (PDOException $e) {
    echo "Erreur : " . $e->getMessage();
}
?>
