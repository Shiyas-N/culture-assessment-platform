<?php
require_once __DIR__ . '/../../../db/connection.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $finalQuestions = json_decode($_POST['final_questions'], true);

    if (!is_array($finalQuestions)) {
        die("Invalid question data.");
    }

    try {
        $stmt = $pdo->prepare("INSERT INTO questions (question_text) VALUES (:question)");
        $checkStmt = $pdo->prepare("SELECT id FROM questions WHERE question_text = :question");

        foreach ($finalQuestions as $question) {
            $checkStmt->execute(['question' => $question]);
            if ($checkStmt->rowCount() === 0) {
                $stmt->execute(['question' => $question]);
            }
        }

        echo "<script>alert('✅ Questions added successfully!'); window.history.back();</script>";
        exit;
    } catch (PDOException $e) {
        echo "❌ Error saving questions: " . $e->getMessage();
    }
} else {
    echo "Invalid request.";
}
?>
