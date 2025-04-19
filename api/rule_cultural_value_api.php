<?php

require_once __DIR__ . '/../db/connect.php';
require_once '../controllers/RuleCulturalValueController.php';

header('Content-Type: application/json');

$controller = new RuleCulturalValueController($pdo);
$method = $_SERVER['REQUEST_METHOD'];

switch ($method) {
    case 'GET':
        if (isset($_GET['rule_id'])) {
            $values = $controller->getRuleValues($_GET['rule_id']);
            echo json_encode($values);
        } else {
            echo json_encode(['error' => 'Missing rule_id']);
        }
        break;

    case 'POST':
        $input = json_decode(file_get_contents('php://input'), true);

        if (isset($input['rule_id'], $input['cultural_id'], $input['points'])) {
            $result = $controller->addRuleValue($input['rule_id'], $input['cultural_id'], $input['points']);
            echo json_encode(['success' => $result]);
        } else {
            echo json_encode(['error' => 'Missing rule_id, cultural_id or points']);
        }
        break;

    case 'DELETE':
        $input = json_decode(file_get_contents('php://input'), true);

        if (isset($input['rule_id'], $input['cultural_id'])) {
            $result = $controller->deleteRuleValue($input['rule_id'], $input['cultural_id']);
            echo json_encode(['success' => $result]);
        } else {
            echo json_encode(['error' => 'Missing rule_id or cultural_id']);
        }
        break;

    default:
        http_response_code(405);
        echo json_encode(['error' => 'Method Not Allowed']);
        break;
}
