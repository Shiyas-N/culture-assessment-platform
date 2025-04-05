<?php
require_once __DIR__ . '/../../../db/connection.php';

$surveyId = $_POST['survey_id'] ?? null;
$questionId = $_POST['question_id'] ?? null;

if ($surveyId && $questionId) {
    $stmt = $pdo->prepare("DELETE FROM survey_questions WHERE survey_id = :survey_id AND question_id = :question_id");
    $stmt->execute([
        'survey_id' => $surveyId,
        'question_id' => $questionId
    ]);
}

// Redirect back to survey details page
header("Location: survey_details.php?id=" . $surveyId);
exit;
?>
