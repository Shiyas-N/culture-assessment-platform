<head><link rel="stylesheet" href="/../public/css/styles.css"></head>
<?php
require_once __DIR__ . '/../../models/Survey.php';

if (!isset($_GET['id'])) {
    echo "No survey ID provided.";
    exit;
}

$survey = Survey::getById($_GET['id']);
if (!$survey) {
    echo "Survey not found.";
    exit;
}
?>

<h2>Survey Details</h2>

<p><strong>ID:</strong> <?php echo $survey['id']; ?></p>
<p><strong>Title:</strong> <?php echo $survey['title']; ?></p>
<p><strong>Description:</strong> <?php echo $survey['description']; ?></p>
<p><strong>Issue Date:</strong> <?php echo $survey['issue']; ?></p>
<p><strong>Deadline:</strong> <?php echo $survey['deadline']; ?></p>
<p><strong>Job Role:</strong> <?php echo $survey['job_role']; ?></p>

<a href="survey_edit.php?id=<?php echo $survey['id']; ?>" class="back-btn">Edit Survey</a> <br>
<a href="dashboard.php" class="back-btn"> Back to Dashboard</a>
