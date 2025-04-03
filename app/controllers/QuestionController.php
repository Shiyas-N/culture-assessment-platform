<?php
require_once __DIR__ . '/../models/Question.php';
require_once __DIR__ . '/../../db/connection.php';

class QuestionController {
    private $questionModel;

    public function __construct() {
        global $pdo;
        $this->questionModel = new Question($pdo);
    }

    public function getAllQuestions() {
        return $this->questionModel->getAllQuestions();
    }
}
?>
