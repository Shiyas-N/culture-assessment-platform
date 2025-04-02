<?php

require_once __DIR__ . '/../../../db/db.php';
require_once __DIR__ . '/../../controllers/RuleController.php';


$ruleController = new RuleController($pdo);
$rules = $ruleController->getAllRules();
?>

<h2>Create Rule</h2>
<form id="createRuleForm">
    <label for="rule_name">Rule Name:</label>
    <input type="text" name="rule_name" required>

    <label for="rule_type">Rule Type:</label>
    <select name="rule_type">
        <option value="SINGLE">SINGLE</option>
        <option value="COMBINATION">COMBINATION</option>
    </select>

    <button type="submit">Create Rule</button>
</form>


<h2>Existing Rules</h2>
<table>
    <tr>
        <th>Rule Name</th>
        <th>Rule Type</th>
        <th>Actions</th>
    </tr>
    <?php foreach ($rules as $rule) { ?>
        <tr>
            <td><?= $rule['rule_name']; ?></td>
            <td><?= $rule['rule_type']; ?></td>
            <td>
                <button class="deleteRule" data-id="<?= $rule['id']; ?>">Delete</button>
            </td>
        </tr>
    <?php } ?>
</table>

<script src="../../../public/js/script.js"></script>
