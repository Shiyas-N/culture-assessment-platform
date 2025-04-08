<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

if ($pdo) {
    echo "<script>console.log('✅ Connected to DB');</script>";
} else {
    echo "<script>alert('❌ Connection failed');</script>";
}
try {
    require_once __DIR__ . '/../../../db/connect.php';

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $surveyId = isset($_POST['survey_id']) ? (int) $_POST['survey_id'] : 0;
        $finalQuestions = json_decode($_POST['final_questions'], true);

        if (empty($finalQuestions) || !is_array($finalQuestions) || $surveyId === 0) {
            echo "<script>alert('Invalid input data.'); window.history.back();</script>";
            exit;
        }

        $pdo->beginTransaction();

        $insertQuestion = $pdo->prepare("INSERT INTO questions (question_text) VALUES (:question)");
        $checkQuestion = $pdo->prepare("SELECT id FROM questions WHERE question_text = :question");
        $insertSurveyQ = $pdo->prepare("INSERT INTO survey_questions (survey_id, question_id) VALUES (:survey_id, :question_id)");

        foreach ($finalQuestions as $question) {
            $checkQuestion->execute(['question' => $question]);

            if ($checkQuestion->rowCount() === 0) {
                $insertQuestion->execute(['question' => $question]);
                $questionId = $pdo->lastInsertId();
            } else {
                $questionId = $checkQuestion->fetchColumn();
            }

            $insertSurveyQ->execute([
                'survey_id' => $surveyId,
                'question_id' => $questionId
            ]);
        }

        $pdo->commit();

        header("Location: add_question.php?survey_id=$surveyId&status=success");
        exit;
    }
} catch (PDOException $e) {
    if ($pdo && $pdo->inTransaction()) {
        $pdo->rollBack();
    }
    echo "❌ PDO Error: " . $e->getMessage();
    exit;
} catch (Exception $e) {
    echo "❌ General Error: " . $e->getMessage();
    exit;
}

?>
