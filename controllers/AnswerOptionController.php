<?php

require_once __DIR__ . '/../models/AnswerOption.php';

class AnswerOptionController {
    private $db;

    public function __construct($db) {
        $this->db = $db;
    }

    public function getAll() {
        return AnswerOption::getAll($this->db);
    }

    public function add($answer_text) {
        return AnswerOption::add($this->db, $answer_text);
    }

    public function delete($id) {
        return AnswerOption::delete($this->db, $id);
    }
}
?>
