<?php

require_once __DIR__ . '/../db/connect.php';
require_once '../controllers/AnswerOptionController.php';

header('Content-Type: application/json');

$answerOptionController = new AnswerOptionController($pdo);
$method = $_SERVER['REQUEST_METHOD'];

switch ($method) {
    case 'GET':
        $options = $answerOptionController->getAll();
        echo json_encode($options);
        break;

    case 'POST':
        $input = json_decode(file_get_contents('php://input'), true);

        if (isset($input['answer_text'])) {
            $id = $answerOptionController->add($input['answer_text']);
            echo json_encode(['success' => true, 'id' => $id]);
        } else {
            echo json_encode(['success' => false, 'error' => 'Missing answer_text']);
        }
        break;

    case 'DELETE':
        $input = json_decode(file_get_contents('php://input'), true);

        if (isset($input['id'])) {
            $result = $answerOptionController->delete($input['id']);
            echo json_encode(['success' => $result]);
        } else {
            echo json_encode(['success' => false, 'error' => 'Missing id']);
        }
        break;

    default:
        http_response_code(405);
        echo json_encode(['error' => 'Method Not Allowed']);
        break;
}
?>
