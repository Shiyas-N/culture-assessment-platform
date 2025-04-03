<?php
require_once __DIR__ . '/../../controllers/SurveyQuestionController.php';

$surveyId = $_GET['survey_id'] ?? null;
$controller = new SurveyQuestionController();
$surveyQuestions = $surveyId ? $controller->getSurveyQuestions($surveyId) : [];
?>

<!DOCTYPE html>
<html>
<head>
    <title>Add Questions to Survey</title>
    <link rel="stylesheet" href="/culture-assessment-platform/public/css/questions.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>
<body>
    <h2>Add Questions to Survey</h2>

    <form method="POST" action="/api/survey_api.php">
        <input type="hidden" name="survey_id" value="<?php echo htmlspecialchars($surveyId); ?>">

        <!-- Dropdown for selecting questions -->
        <div class="question-selector">
            <select id="questionDropdown">
                <option value="">Select a question</option>
            </select>
            <button type="button" id="addQuestion">+</button>
        </div>

        <!-- Selected questions will be displayed here -->
        <div id="selectedQuestions">
            <?php foreach ($surveyQuestions as $question): ?>
                <div class="question-item">
                    <input type="hidden" name="question_ids[]" value="<?php echo $question['id']; ?>">
                    <span><?php echo htmlspecialchars($question['question_text']); ?></span>
                    <button type="button" class="removeQuestion">X</button>
                </div>
            <?php endforeach; ?>
        </div>

        <button type="submit">Save Questions</button>
    </form>

    <script>
    $(document).ready(function() {
        function loadQuestions() {
            $.ajax({
                url: "/api/question_api.php",
                type: "GET",
                dataType: "json",
                success: function(response) {
                    let dropdown = $("#questionDropdown");
                    dropdown.find("option:not(:first)").remove(); // Remove old options

                    if (response.length === 0) {
                        dropdown.append(`<option disabled>No questions available</option>`);
                    } else {
                        response.forEach(question => {
                            dropdown.append(`<option value="${question.id}">${question.question_text}</option>`);
                        });
                    }
                },
                error: function(xhr, status, error) {
                    console.error("Error loading questions:", error);
                }
            });
        }

        loadQuestions(); // Load questions on page load
    });
</script>

   
</body>
</html>
