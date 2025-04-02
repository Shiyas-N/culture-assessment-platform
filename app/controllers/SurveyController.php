<!-- CRUD for surveys, questions, rules, etc. -->
<?php
require_once '../models/Survey.php';

class SurveyController {
    public function createSurvey() {
        $survey = new Survey();
        $survey->title = $_POST['title'];
        $survey->issue = $_POST['issue'];
        $survey->deadline = $_POST['deadline'];
        $survey->description = $_POST['description'];
        $survey->save();
        echo json_encode(["success" => true, "message" => "Survey created successfully"]);
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
}
?>