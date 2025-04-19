<?php

require_once __DIR__ . '/../models/Questions.php';
require_once __DIR__ . '/../models/QuestionSurvey.php';

class QuestionController {
    private $db;
    
    public function __construct($db) {
        $this->db = $db;
    }

    public function getAllQuestions(){
        return Questions::getAllQuestions($this->db);
    }

    public function addQuestion($question){
        return Questions::addQuestion($this->db,$question);
    }

    public function deleteQuestion($question_id){
        return Questions::deleteQuestion($this->db,$question_id);
    }

    public function getSurveyQuestion($survey_id){
        return QuestionSurvey::getSurveyQuestion($this->db,$survey_id);
    }

    public function createSurveyQuestion($survey_id,$question_id){
        return QuestionSurvey::createSurveyQuestion($this->db,$survey_id,$question_id);
    }
    
    public function deleteSurveyQuestion($survey_id,$question_id){
        return QuestionSurvey::deleteSurveyQuestion($this->db,$survey_id,$question_id);
    }

}

?>
