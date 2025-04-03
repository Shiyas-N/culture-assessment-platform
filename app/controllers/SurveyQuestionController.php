<?php
require_once __DIR__ . '/../../db/connection.php';
require_once __DIR__ . '/../models/SurveyQuestion.php';
require_once __DIR__ . '/../models/Question.php';

class SurveyQuestionController {
    private $surveyQuestionModel;
    private $questionModel;

    public function __construct() {
        global $pdo; // Use the existing PDO connection
        $this->surveyQuestionModel = new SurveyQuestion($pdo);
        $this->questionModel = new Question($pdo);
    }

    public function getSurveyQuestions($surveyId) {
        return $this->surveyQuestionModel->getQuestionsBySurvey($surveyId);
    }

    public function addQuestionToSurvey($surveyId, $questionId) {
        return $this->surveyQuestionModel->addQuestionToSurvey($surveyId, $questionId);
    }

    // **Fix: Add this function to fetch available questions**
    public function getAvailableQuestions() {
        return $this->questionModel->getAllQuestions(); 
    }
    public function getPaginatedQuestions($search = '', $page = 1, $limit = 10) {
        $db = Database::getConnection();
        $offset = ($page - 1) * $limit;
        $query = "SELECT * FROM questions WHERE question_text LIKE ? LIMIT ? OFFSET ?";
        
        $stmt = $db->prepare($query);
        $searchParam = "%$search%";
        $stmt->bind_param("sii", $searchParam, $limit, $offset);
        $stmt->execute();
        
        return $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
    }
    
}
?>
