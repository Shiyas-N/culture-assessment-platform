<?php
require_once __DIR__ . '/../../db/connection.php';

class Question {
    private $pdo;

    public function __construct($pdo) {
        $this->pdo = $pdo;
    }

    public function getAllQuestions() {
        $query = "SELECT * FROM questions";
        $stmt = $this->pdo->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
