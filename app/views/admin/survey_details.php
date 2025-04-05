<?php
require_once __DIR__ . '/../../controllers/SurveyController.php';

$surveyController = new SurveyController();
$surveyId = $_GET['id'] ?? 1;
$survey = $surveyController->getSurveyDetails($surveyId);

if (!$survey) {
    echo "<p style='color: red;'>Survey not found.</p>";
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Survey Details</title>
    <link rel="stylesheet" href="../../../public/css/survey.css">
</head>
<body>
<div class="survey-wrapper">
    <!-- Left Panel -->
    <div class="survey-container">
        <h2 class="survey-header">Survey Details</h2>
        <form id="survey-form" action="update_survey.php" method="POST">
            <input type="hidden" name="survey_id" value="<?= $survey['id'] ?>">
            <table class="survey-details">
                <tr>
                    <td><strong>ID:</strong></td>
                    <td><?= $survey['id'] ?></td>
                </tr>
                <tr>
                    <td><strong>Title:</strong></td>
                    <td><input type="text" name="title" value="<?= $survey['title'] ?>" disabled></td>
                    <td><button type="button" class="edit-btn" onclick="enableEdit(this)">Edit</button></td>
                </tr>
                <tr>
                    <td><strong>Effective From:</strong></td>
                    <td><input type="date" name="effective_from" value="<?= $survey['effective_from'] ?>" disabled></td>
                    <td><button type="button" class="edit-btn" onclick="enableEdit(this)">Edit</button></td>
                </tr>
                <tr>
                    <td><strong>Deadline:</strong></td>
                    <td><input type="date" name="deadline" value="<?= $survey['deadline'] ?>" disabled></td>
                    <td><button type="button" class="edit-btn" onclick="enableEdit(this)">Edit</button></td>
                </tr>
                <tr>
                    <td><strong>Experience:</strong></td>
                    <td>
                        <select name="experience" disabled>
                            <option value="0-2" <?= $survey['experience'] == '0-2' ? 'selected' : '' ?>>0-2 years</option>
                            <option value="2-5" <?= $survey['experience'] == '2-5' ? 'selected' : '' ?>>2-5 years</option>
                            <option value="5+" <?= $survey['experience'] == '5+' ? 'selected' : '' ?>>5+ years</option>
                        </select>
                    </td>
                    <td><button type="button" class="edit-btn" onclick="enableEdit(this)">Edit</button></td>
                </tr>
            </table>

            <div class="action-buttons">
                <button type="button" class="add-btn" onclick="redirectToAddQuestion()">Add Question</button>               
                <button type="button" class="add-rule-btn">Add Rule</button>
            </div>

            <div class="bottom-buttons">
                <button type="button" class="back-btn" onclick="goBack()">Back</button>
                <button type="submit" class="save-btn">Save</button>
            </div>
        </form>
    </div>

  
</div>

<?php
require_once __DIR__ . '/../../../db/connection.php';

$query = "
    SELECT q.id, q.question_text 
    FROM survey_questions sq 
    JOIN questions q ON sq.question_id = q.id 
    WHERE sq.survey_id = :survey_id
";

$stmt = $pdo->prepare($query);
$stmt->execute(['survey_id' => $surveyId]);
$surveyQuestions = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<div class="question-panel">
    <h3>📋 Questions Added to This Survey</h3>
    <ul class="question-list">
        <?php if (count($surveyQuestions) > 0): ?>
            <?php foreach ($surveyQuestions as $q): ?>
                <li data-question-id="<?= $q['id'] ?>">
                    <span><?= htmlspecialchars($q['question_text']) ?></span>
                    <form method="POST" action="remove_question.php" onsubmit="return fadeAndSubmit(this);" style="display:inline;">
    <input type="hidden" name="survey_id" value="<?= $surveyId ?>">
    <input type="hidden" name="question_id" value="<?= $q['id'] ?>">
    <button type="submit" class="remove-btn">Remove</button>
</form>


                </li>
            <?php endforeach; ?>
        <?php else: ?>
            <li>No questions have been added to this survey yet.</li>
        <?php endif; ?>
    </ul>
</div>

<script>
    function enableEdit(button) {
        let inputField = button.parentElement.previousElementSibling.querySelector('input, select');
        if (inputField) {
            inputField.disabled = false;
            inputField.focus();
        }
    }

    function goBack() {
        window.location.href = 'dashboard.php';
    }

    function redirectToAddQuestion() {
        window.location.href = 'add_question.php?survey_id=<?= $surveyId ?>';
    }
    function fadeAndSubmit(form) {
    const li = form.closest('li');
    li.style.transition = 'opacity 0.5s';
    li.style.opacity = 0;

    // Wait a bit, then submit the form
    setTimeout(() => {
        form.submit();
    }, 500);

    return false; // Prevent immediate submission
}
</script>
</body>
</html>

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
