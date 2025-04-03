<?php
require_once __DIR__ . '/../controllers/SurveyQuestionController.php';

$controller = new SurveyQuestionController();

if ($_SERVER['REQUEST_METHOD'] === 'POST' && !empty($_POST['custom_question'])) {
    // Handle custom question addition
    $questionId = $controller->addCustomQuestion($_POST['custom_question']);
    echo json_encode(["success" => $questionId ? true : false, "id" => $questionId]);
    exit();
}

// Fetch questions (GET request)
$search = $_GET['search'] ?? '';
$page = $_GET['page'] ?? 1;
$limit = 10;

$questions = $controller->getPaginatedQuestions($search, $page, $limit);

// Return JSON for AJAX dropdown
header('Content-Type: application/json');
echo json_encode($questions);
?>
