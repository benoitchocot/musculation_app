<?php
// save_entry.php
try {
    $db = new PDO('sqlite:data/musculation.db');
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $stmt = $db->prepare("INSERT INTO exercise_entries (exercise_id, date, weight, repetitions) VALUES (:exercise_id, :date, :weight, :repetitions)");

    $exercise_id = $_POST['exercise_id'];
    $date = $_POST['date'];
    $weight = $_POST['weight'];
    $repetitions = $_POST['repetitions'];

    $stmt->bindParam(':exercise_id', $exercise_id, PDO::PARAM_INT);
    $stmt->bindParam(':date', $date, PDO::PARAM_STR);
    $stmt->bindParam(':weight', $weight, PDO::PARAM_STR);
    $stmt->bindParam(':repetitions', $repetitions, PDO::PARAM_INT);

    if ($stmt->execute()) {
        header('Location: exercise.php?id=' . $exercise_id);
        exit();
    } else {
        echo "Erreur lors de l'ajout de l'entrée journalière.";
    }
} catch (PDOException $e) {
    echo "Erreur : " . $e->getMessage();
}
?>
