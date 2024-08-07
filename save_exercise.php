<?php
// save_exercise.php
try {
    $db = new PDO('sqlite:data/musculation.db');
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $stmt = $db->prepare("INSERT INTO exercises (session_id, photo, title, weight, repetitions) VALUES (:session_id, :photo, :title, :weight, :repetitions)");

    $session_id = $_POST['session_id'];
    $title = $_POST['title'];
    $weight = $_POST['weight'];
    $repetitions = $_POST['repetitions'];

    // Gestion de la photo
    if (isset($_FILES['photo']) && $_FILES['photo']['error'] == UPLOAD_ERR_OK) {
        $photo = 'uploads/' . basename($_FILES['photo']['name']);
        move_uploaded_file($_FILES['photo']['tmp_name'], $photo);
    } else {
        $photo = null;
    }

    $stmt->bindParam(':session_id', $session_id, PDO::PARAM_INT);
    $stmt->bindParam(':photo', $photo);
    $stmt->bindParam(':title', $title, PDO::PARAM_STR);
    $stmt->bindParam(':weight', $weight, PDO::PARAM_STR);
    $stmt->bindParam(':repetitions', $repetitions, PDO::PARAM_INT);

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
