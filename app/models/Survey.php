<?php
require_once __DIR__ . '/../../db/connection.php';

class Survey {
    private $pdo;

    public function __construct($pdo) {
        $this->pdo = $pdo;
    }

    public function getSurveyById($surveyId) {
        $stmt = $this->pdo->prepare("SELECT * FROM surveys WHERE id = ?");
        $stmt->execute([$surveyId]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
}
?>
