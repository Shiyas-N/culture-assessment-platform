<?php

require_once __DIR__ . '/../../db/connect.php';
require_once '../controllers/QuestionController.php';

header('Content-Type: application/json');

$questionController = new QuestionController($pdo);
$method = $_SERVER['REQUEST_METHOD'];

switch ($method) {
    case 'GET':
        if (isset($_GET['survey_id'])) {
            $questions = $questionController->getSurveyQuestion($_GET['survey_id']);
            echo json_encode($questions);
        } else {
            echo json_encode(['error' => 'Missing survey_id']);
        }
        break;


    case 'POST':
        $input = json_decode(file_get_contents('php://input'), true);

        if (isset($input['survey_id']) && isset($input['question_id'])) {
            $result = $questionController->createSurveyQuestion($input['survey_id'], $input['question_id']);
            echo json_encode(['success' => $result]);
        } else {
            echo json_encode(['error' => 'Missing survey_id or question_id']);
        }
        break;

    case 'DELETE':
        $input = json_decode(file_get_contents('php://input'), true);

        if (isset($input['survey_id']) && isset($input['question_id'])) {
            $result = $questionController->deleteSurveyQuestion($input['survey_id'], $input['question_id']);
            echo json_encode(['success' => $result]);
        } else {
            echo json_encode(['error' => 'Missing survey_id or question_id']);
        }
        break;

    default:
        http_response_code(405);
        echo json_encode(['error' => 'Method Not Allowed']);
        break;
}
