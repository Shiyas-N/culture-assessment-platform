<?php

require_once __DIR__ . '/../models/Survey.php';

class SurveyController {
    private $db;

    public function __construct($db) {
        $this->db = $db;
    }

    public function getAllSurveys() {
        return Survey::getAllSurveys($this->db);
    }

    public function createSurvey($title, $description, $issue, $deadline, $experience) {
        return Survey::createSurvey($this->db, $title, $description, $issue, $deadline, $experience);
    }

    public function getSurveyById($id) {
        return Survey::getSurveyById($this->db, $id);
    }

    public function updateSurvey($id, $title, $description, $issue, $deadline, $experience) {
        return Survey::updateSurvey($this->db, $id, $title, $description, $issue, $deadline, $experience);
    }

    public function toggleSurveyStatus($id) {
        return Survey::toggleSurveyStatus($this->db, $id);
    }

    public function deleteSurvey($id) {
        return Survey::deleteSurvey($this->db, $id);
    }
}
