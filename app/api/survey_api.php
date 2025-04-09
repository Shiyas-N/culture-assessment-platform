<?php

require_once __DIR__ . '/../../db/connect.php';
require_once '../controllers/SurveyController.php';

header('Content-Type: application/json');

$surveyController = new SurveyController($pdo);
$method = $_SERVER['REQUEST_METHOD'];

switch ($method) {
    case 'GET':
        if (isset($_GET['id'])) {
            $survey = $surveyController->getSurveyById($_GET['id']);
            echo json_encode($survey);
        } else {
            $surveys = $surveyController->getAllSurveys();
            echo json_encode($surveys);
        }
        break;

    case 'POST':
        $input = json_decode(file_get_contents('php://input'), true);

        if (
            isset($input['title']) &&
            isset($input['description']) &&
            isset($input['issue']) &&
            isset($input['deadline']) &&
            isset($input['experience'])
        ) {
            $surveyId = $surveyController->createSurvey(
                $input['title'],
                $input['description'],
                $input['issue'],
                $input['deadline'],
                $input['experience']
            );

            echo json_encode([
                'success' => $surveyId !== false,
                'survey_id' => $surveyId
            ]);
        } else {
            echo json_encode(['success' => false, 'error' => 'Missing required fields']);
        }
        break;

    case 'PUT':
        parse_str(file_get_contents('php://input'), $input);

        if (
            isset($input['id']) &&
            isset($input['title']) &&
            isset($input['description']) &&
            isset($input['issue']) &&
            isset($input['deadline']) &&
            isset($input['experience'])
        ) {
            $updated = $surveyController->updateSurvey(
                $input['id'],
                $input['title'],
                $input['description'],
                $input['issue'],
                $input['deadline'],
                $input['experience']
            );
            echo json_encode(['success' => $updated]);
        } else {
            echo json_encode(['success' => false, 'error' => 'Missing required fields for update']);
        }
        break;

    case 'DELETE':
        if (isset($_GET['id'])) {
            $deleted = $surveyController->deleteSurvey($_GET['id']);
            echo json_encode(['success' => $deleted]);
        } else {
            echo json_encode(['success' => false, 'error' => 'Missing survey id']);
        }
        break;

    case 'PATCH':
        parse_str(file_get_contents('php://input'), $input);

        if (isset($input['id'])) {
            $toggled = $surveyController->toggleSurveyStatus($input['id']);
            echo json_encode([
                'success' => $toggled > 0,
                'message' => $toggled > 0 ? 'Survey status toggled successfully' : 'No change made'
            ]);
        } else {
            echo json_encode(['success' => false, 'error' => 'Missing survey id for toggle']);
        }
        break;

    default:
        echo json_encode(['error' => 'Invalid request method']);
        break;
}
