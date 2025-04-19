<?php

require_once __DIR__ . '/../db/connect.php';
require_once '../controllers/QuestionController.php';

header('Content-Type: application/json');

$questionController = new QuestionController($pdo);
$method = $_SERVER['REQUEST_METHOD'];

switch ($method) {
    case 'GET':
        $questions = $questionController->getAllQuestions();
        echo json_encode($questions);
        break;

    case 'POST':
        $input = json_decode(file_get_contents('php://input'), true);

        if (isset($input['question'])) {

            $question_id=$questionController->addQuestion($input['question']);
            if ($question_id) {
                echo json_encode(['success' => true, 'question_id' => $question_id]);
            } else {
                echo json_encode(['success' => false, 'error' => 'Failed to create question']);
            }
            
        } else {
            echo json_encode(['error' => 'Missing required fields']);
        }
        break;

    case 'DELETE':
        $input = json_decode(file_get_contents('php://input'), true);

        if (isset($input['question_id'])) {
            $result = $questionController->deleteQuestion($input['question_id']);
            echo json_encode(['success' => $result]);
        } else {
            echo json_encode(['error' => 'Missing question_id']);
        }
        break;

    default:
        http_response_code(405);
        echo json_encode(['error' => 'Method Not Allowed']);
        break;
}
