<?php
require_once __DIR__ . '/../models/Survey.php';
require_once __DIR__ . '/../../db/connection.php'; // Ensure connection.php is included

class SurveyController {
    private $surveyModel;

    public function __construct() {
        global $pdo; // Use the existing PDO connection
        $this->surveyModel = new Survey($pdo);
    }

    public function getSurveyDetails($surveyId) {
        return $this->surveyModel->getSurveyById($surveyId);
    }

    public function updateSurvey($surveyId, $title, $effectiveFrom, $deadline, $experience) {
        global $pdo; // Use PDO from connection.php
    
        // Fetch existing values if new ones are empty
        $query = "SELECT title, effective_from, deadline, experience FROM surveys WHERE id = :id";
        $stmt = $pdo->prepare($query);
        $stmt->execute([':id' => $surveyId]);
        $existingSurvey = $stmt->fetch(PDO::FETCH_ASSOC);
    
        // Use old values if new ones are empty
        $title = !empty($title) ? $title : $existingSurvey['title'];
        $effectiveFrom = !empty($effectiveFrom) ? $effectiveFrom : $existingSurvey['effective_from'];
        $deadline = !empty($deadline) ? $deadline : $existingSurvey['deadline'];
        $experience = !empty($experience) ? $experience : $existingSurvey['experience'];
    
        // Validate date logic (effective_from should not be later than deadline)
        if (strtotime($effectiveFrom) > strtotime($deadline)) {
            return false; // Invalid date, return failure
        }
    
        // Now update the survey
        $updateQuery = "UPDATE surveys SET title = :title, effective_from = :effective_from, deadline = :deadline, experience = :experience WHERE id = :id";
        $updateStmt = $pdo->prepare($updateQuery);
        return $updateStmt->execute([
            ':id' => $surveyId,
            ':title' => $title,
            ':effective_from' => $effectiveFrom,
            ':deadline' => $deadline,
            ':experience' => $experience
        ]);
    }
    
    

}
?>
