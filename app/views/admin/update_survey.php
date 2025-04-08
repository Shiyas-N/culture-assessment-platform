<?php
// update_survey.php
require_once __DIR__ . '/../../controllers/SurveyController.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $surveyId = $_POST['survey_id'];
    $title = $_POST['title'];
    $effectiveFrom = $_POST['effective_from'];
    $deadline = $_POST['deadline'];
    $experience = $_POST['experience'];

    $surveyController = new SurveyController();
    $updateSuccess = $surveyController->updateSurvey($surveyId, $title, $effectiveFrom, $deadline, $experience);

    if ($updateSuccess) {
        header("Location: survey_details.php?id=" . $surveyId . "&success=1");
    } else {
        header("Location: survey_details.php?id=" . $surveyId . "&error=1");
    }
    exit;
}
?>