<!-- Question model (linked to survey and culture value) -->
<?php
require_once __DIR__ . '/../../db/connection.php';

class SurveyQuestion {
    private $pdo;

    public function __construct($pdo) {
        $this->pdo = $pdo;
    }

    public function addQuestionToSurvey($surveyId, $questionId) {
        $query = "INSERT INTO survey_questions (survey_id, question_id) VALUES (:survey_id, :question_id)";
        $stmt = $this->pdo->prepare($query);
        return $stmt->execute([':survey_id' => $surveyId, ':question_id' => $questionId]);
    }

    public function getQuestionsBySurvey($surveyId) {
        $query = "SELECT q.id, q.question_text FROM questions q
                  JOIN survey_questions sq ON q.id = sq.question_id
                  WHERE sq.survey_id = :survey_id";
        $stmt = $this->pdo->prepare($query);
        $stmt->execute([':survey_id' => $surveyId]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
