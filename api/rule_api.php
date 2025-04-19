<?php

require_once __DIR__ . '/../db/connect.php';
require_once '../controllers/RuleController.php';

header('Content-Type: application/json');

$ruleController = new RuleController($pdo);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $input = json_decode(file_get_contents('php://input'), true);

    if (isset($input['survey_id']) && isset($input['rule_name']) && isset($input['rule_type'])) {
        $rule_id = $ruleController->createRule($input['survey_id'], $input['rule_name'], $input['rule_type']);
        
        if ($rule_id) {
            echo json_encode(['success' => true, 'rule_id' => $rule_id]);
        } else {
            echo json_encode(['success' => false, 'error' => 'Failed to create rule']);
        }
    } else {
        echo json_encode(['error' => 'Missing survey_id, rule_name, or rule_type']);
    }

} elseif ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['survey_id'])) {
    $rules = $ruleController->getRulesBySurvey($_GET['survey_id']);
    echo json_encode($rules);

} elseif ($_SERVER['REQUEST_METHOD'] === 'GET') {
    $rules = $ruleController->getAllRules();
    echo json_encode($rules);

} elseif ($_SERVER['REQUEST_METHOD'] === 'DELETE' && isset($_GET['id'])) {
    $result = $ruleController->deleteRule($_GET['id']);
    echo json_encode(['success' => $result]);

} else {
    echo json_encode(['error' => 'Invalid request']);
}
?>
