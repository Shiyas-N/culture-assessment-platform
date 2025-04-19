<?php
require_once __DIR__ . '/../../models/Survey.php';
require_once __DIR__ . '/../../db/connect.php';
$surveys = Survey::getAllSurveys($pdo); 
?>

<link rel="stylesheet" href="/../public/css/styles.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

<div class="dashboard-container">
    <div class="dashboard-header">
        <h2>Survey List</h2>
        <a href="survey_create.php" class="create-survey-btn">
            <span class="plus-icon">&#43;</span>Create Survey
        </a>
    </div>

    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Title</th>
                <th>Description</th>
                <th>Issue Date</th>
                <th>Deadline</th>
                <th>Experience</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($surveys as $survey) : ?>
                <tr>
                    <td><?= $survey['id'] ?></td>
                    <td> <a href="survey_details.php?id=<?= $survey['id'] ?>" class="survey-link"> <?= $survey['title'] ?>  </a></td>
                    <td><?= $survey['description'] ?></td>
                    <td><?= $survey['issue'] ?></td>
                    <td><?= $survey['deadline'] ?></td>
                    <td><?= $survey['experience'] ?></td>
                    <td>
    <div class="action-buttons">
        <?php
        $isLive = $survey['is_live'];
        $buttonText = $isLive ? 'Unpublish' : 'Publish';
        $buttonClass = $isLive ? 'unpublish' : 'publish';
        ?>
        <button
        id="publish"
            class="publish-btn publish<?= $buttonClass ?>"
            data-id="<?= $survey['id'] ?>"
            data-status="<?= $isLive ?>">
            <?= $buttonText ?>
        </button>

        <button class="publish-btn delete" data-id="<?= $survey['id'] ?>">
            <i class="fas fa-trash-alt"></i> Delete
        </button>
    </div>
</td>

                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>

<script src="../../public/js/admin_dashboard.js"></script>
