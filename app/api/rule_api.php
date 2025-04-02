<?php
require_once '../controllers/RuleController.php';
header('Content-Type: application/json');

$ruleController = new RuleController($pdo);


if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['rule_name']) && isset($_POST['rule_type'])) {
    $result = $ruleController->createRule($_POST['rule_name'], $_POST['rule_type']);
    echo json_encode(['success' => $result]);
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
