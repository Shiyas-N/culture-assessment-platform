<head>
    <link rel="stylesheet" href="/../public/css/styles.css">
</head>
<?php
require_once __DIR__ . '/../../models/Survey.php';
require_once __DIR__ . '/../../../db/connect.php';

if (!isset($_GET['id'])) {
    echo "No survey ID provided.";
    exit;
}

$survey = Survey::getSurveyById($pdo, $_GET['id']);
if (!$survey) {
    echo "Survey not found.";
    exit;
}
?>

<h2>Survey Details</h2>

<p><strong>ID:</strong> <?= $survey['id'] ?></p>
<p><strong>Title:</strong> <?= $survey['title'] ?></p>
<p><strong>Description:</strong> <?= $survey['description'] ?></p>
<p><strong>Issue Date:</strong> <?= $survey['issue'] ?></p>
<p><strong>Deadline:</strong> <?= $survey['deadline'] ?></p>
<p><strong>Experience:</strong> <?= $survey['experience'] ?></p>

<a href="survey_edit.php?id=<?= $survey['id'] ?>" class="back-btn">Edit Survey</a> <br>
<a href="dashboard.php" class="back-btn">Back to Dashboard</a>
