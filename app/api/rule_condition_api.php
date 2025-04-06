<?php

require_once __DIR__ . '/../../db/connect.php';

require_once '../controllers/RuleController.php';
header('Content-Type: application/json');

$ruleController = new RuleController($pdo);

$method = $_SERVER['REQUEST_METHOD'];

switch ($method) {
    case 'GET':
        if (isset($_GET['rule_id'])) {
            $rule_id = $_GET['rule_id'];
            $conditions = $ruleController->getRuleConditions($rule_id);
            echo json_encode($conditions);
        } else {
            $conditions = $ruleController->getAllConditions();
            echo json_encode($conditions);
        }
        break;

    case 'POST':
        $input = json_decode(file_get_contents('php://input'), true);

        if (
            isset($input['rule_id']) &&
            isset($input['question_id']) &&
            isset($input['answer_option_id']) &&
            isset($input['logic_operator'])
        ) {
            $result = $ruleController->addCondition(
                $input['rule_id'],
                $input['question_id'],
                $input['answer_option_id'],
                $input['logic_operator']
            );
            echo json_encode(['success' => $result]);
        } else {
            echo json_encode(['error' => 'Missing required fields']);
        }
        break;

    case 'DELETE':
        $input = json_decode(file_get_contents('php://input'), true);

        if (isset($input['condition_id'])) {
            $result = $ruleController->deleteCondition($input['condition_id']);
            echo json_encode(['success' => $result]);
        } else {
            echo json_encode(['error' => 'Missing condition_id']);
        }
        break;

    default:
        http_response_code(405);
        echo json_encode(['error' => 'Method Not Allowed']);
        break;
}


?>