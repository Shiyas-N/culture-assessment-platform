<!-- List & manage surveys -->
<?php
require_once '../../models/Survey.php';
$surveys = Survey::getAllSurveys();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Survey Management</title>
    <link rel="stylesheet" href="../../public/css/styles.css">
</head>
<body>

    <div class="dashboard">
        <h2>Survey Management</h2>
        <button class="create-btn">Create Survey +</button>

        <table>
            <thead>
                <tr>
                    <th>Survey ID</th>
                    <th>Title</th>
                    <th>Issue</th>
                    <th>Deadline</th>
                    <th>No. of Members Polled</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($surveys as $survey): ?>
                    <tr>
                        <td><?= $survey['id'] ?></td>
                        <td><?= htmlspecialchars($survey['title']) ?></td>
                        <td><?= htmlspecialchars($survey['issue']) ?></td>
                        <td><?= $survey['deadline'] ?></td>
                        <td><?= $survey['members_polled'] ?></td>
                        <td>
                            <button class="publish-btn" data-id="<?= $survey['id'] ?>">Publish</button>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>

    <script src="../../public/js/script.js"></script>
</body>
</html>
