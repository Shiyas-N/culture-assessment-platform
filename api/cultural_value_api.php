<?php

require_once __DIR__ . '/../db/connect.php';
require_once '../controllers/CulturalValueController.php';

header('Content-Type: application/json');

$controller = new CulturalValueController($pdo);
$method = $_SERVER['REQUEST_METHOD'];

switch ($method) {
    case 'GET':
        $values = $controller->getAllCulturalValues();
        echo json_encode($values);
        break;

    case 'POST':
        $input = json_decode(file_get_contents('php://input'), true);

        if (isset($input['value_name'])) {
            $result = $controller->createCulturalValue($input['value_name']);
            echo json_encode(['success' => $result]);
        } else {
            echo json_encode(['error' => 'Missing value_name']);
        }
        break;

    case 'DELETE':
        $input = json_decode(file_get_contents('php://input'), true);

        if (isset($input['id'])) {
            $result = $controller->deleteCulturalValue($input['id']);
            echo json_encode(['success' => $result]);
        } else {
            echo json_encode(['error' => 'Missing id']);
        }
        break;

    default:
        http_response_code(405);
        echo json_encode(['error' => 'Method Not Allowed']);
        break;
}
