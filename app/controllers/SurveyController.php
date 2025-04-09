<?php
require_once '../models/Survey.php';

class SurveyController {
    
    public function createSurvey() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['create_survey'])) {
            $title = $_POST['title'];
            $description = $_POST['description'];
            $issue = $_POST['issue']; // should be in YYYY-MM-DD format
            $deadline = $_POST['deadline'];
            $experience = $_POST['experience'];
            $result = Survey::createSurvey($title, $description, $issue, $deadline, $experience);

            if ($result) {
                header('Location: ../views/admin/dashboard.php');
                exit;
            } else {
                echo "Failed to create survey.";
            }
        }
    }

    public function fetchSurveys() {
        $surveys = Survey::all();
        echo json_encode($surveys);
    }

    public function publishSurvey() {
        $survey = Survey::find($_GET['id']);
        $survey->is_published = 1;
        $survey->save();
        echo json_encode(["success" => true, "message" => "Survey published"]);
    }
    public function unpublishSurvey() {
        $survey = Survey::find($_GET['id']);
        $survey->is_live = 0;
        $survey->save();
        echo json_encode(["success" => true, "message" => "Survey unpublished"]);
    }    
}

// Handle form submission here
$controller = new SurveyController();
$controller->createSurvey();
if (isset($_GET['action']) && isset($_GET['id'])) {
    $action = $_GET['action'];
    $id = $_GET['id'];

    if ($action === 'publish') {
        Survey::toggleSurveyStatus($id, 1);
        echo json_encode(['message' => 'Survey published']);
    } elseif ($action === 'unpublish') {
        Survey::toggleSurveyStatus($id, 0);
        echo json_encode(['message' => 'Survey unpublished']);
    }
    exit;
}

if (isset($_POST['update_survey'])) {
    $id = $_POST['survey_id'];
    $title = $_POST['title'];
    $desc = $_POST['description'];
    $issue = $_POST['issue'];
    $deadline = $_POST['deadline'];
    $experience = $_POST['experience'];

    Survey::updateSurvey($id, $title, $desc, $issue, $deadline, $experience);

    header('Location: ../views/admin/dashboard.php');
    exit();
}



