<?php

$survey_id = $_GET['survey_id'] ?? null;

require_once __DIR__ . '/../../db/connect.php';
require_once __DIR__ . '/../../controllers/RuleController.php';


$ruleController = new RuleController($pdo);
if ($survey_id) {
    $rules = $ruleController->getRulesBySurvey($survey_id);
} else {
    $rules = [];
}

?>

<html lang="en">
<head> 
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rules List</title>
    <link rel="stylesheet" href="../../public/css/survey_rules.css">
</head>
<body>
    <div class="container">
        <h2>Rules List</h2>
        <table>
            <tr>
                <th>Rule ID</th>
                <th>Rule Name</th>
                <th>Rule Type</th>
                <th>Actions</th>
            </tr>
             <?php foreach ($rules as $rule) { ?>
        <tr>
            <td><?= $rule['id']; ?></td>
            <td><?= $rule['rule_name']; ?></td>
            <td><?= $rule['rule_type']; ?></td>
            <td>
            <div class="action-buttons">
                    <button class="editRule primary" data-id="<?= $rule['id']; ?>">Edit</button>
                    <button class="deleteRule primary" data-id="<?= $rule['id']; ?>">Delete</button>
                </div>
            </td>
        </tr>
    <?php } ?>
        </table>
        <button class="primary" onclick="location.href='create_rule.php?survey_id=<?= $survey_id ?>'">Create Rule</button>

    </div>
</body>
</html>




<script src="../../public/js/survey_rules.js"></script>

