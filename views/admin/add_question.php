<?php
$surveyId = $_GET['survey_id'] ?? null;

require_once __DIR__ . '/../../db/connect.php';
require_once __DIR__ . '/../../controllers/QuestionController.php';

$questionController = new QuestionController($pdo);
$questions = $questionController->getAllQuestions();
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Add Questions to Survey</title>
  <link rel="stylesheet" href="../../public/css/survey_rules.css">
</head>
<body>
  <div class="container">
    <h2>Select or Add Questions</h2>

    <form id="surveyQuestionForm">
      <input type="hidden" name="survey_id" value="<?= $surveyId ?>">

      <div class="form-group">
        <label for="existingQuestions">Choose Existing Questions:</label>
        <select id="existingQuestions" multiple>
          <?php foreach ($questions as $q): ?>
            <option value="<?= htmlspecialchars($q['id']) ?>">
              <?= htmlspecialchars($q['text']) ?>
            </option>
          <?php endforeach; ?>
        </select>
      </div>

      <hr>

      <div class="form-group">
        <label for="customQuestion">Add Custom Question:</label>
        <input type="text" id="customQuestion" placeholder="Type your question">
        <button type="button" id="addCustomQuestion" class="primary">Add</button>
      </div>

      <ul id="customQuestionsList"></ul>
      <hr>

    <div class="form-group">
        <h4>Selected Questions</h4>
        <ul id="selectedQuestionsList"></ul>
    </div>

      <button type="submit" class="primary">Save Questions</button>
    </form>
  </div>

  <script src="../../public/js/survey_question_handler.js"></script>
</body>
</html>
