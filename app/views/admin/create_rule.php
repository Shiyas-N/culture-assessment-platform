<h2>Create Rule</h2>
<form id="createRuleForm">
    <label for="rule_name">Rule Name:</label>
    <input type="text" name="rule_name" required>

    <label for="rule_type">Rule Type:</label>
    <select name="rule_type">
        <option value="SINGLE">SINGLE</option>
        <option value="COMBINATION">COMBINATION</option>
    </select>

    <h3>Conditions</h3>
    <div id="conditionsContainer">
        <!-- Conditions will be added here -->
    </div>
    <button type="button" id="addConditionBtn">Add Condition</button>

    <button type="submit">Create Rule</button>
</form>

<script src="../../../public/js/create_rules.js"></script>
