<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <title>Create Rule</title>
  <link rel="stylesheet" href="../../../public/css/survey_rules.css" />
 
</head>
<body>
  <div class="container">
    <h2>Create Rule</h2>
    <form id="createRuleForm">
      <div class="form-section">
        <div class="form-group">
          <label for="rule_name">Rule Name:</label>
          <input type="text" name="rule_name" required />
        </div>

        <div class="form-group">
          <label for="rule_type">Rule Type:</label>
          <select name="rule_type">
            <option value="SINGLE">SINGLE</option>
            <option value="COMBINATION">COMBINATION</option>
          </select>
        </div>
      </div>

      <div class="form-section">
        <h3>Conditions</h3>
        <div id="conditionsContainer">
          <!-- Conditions inserted by JS -->
        </div>
        <button type="button" id="addConditionBtn" class="primary">Add Condition</button>
      </div>

      <button type="submit" class="primary">Create Rule</button>
    </form>
  </div>

  <script src="../../../public/js/create_rules.js"></script>
</body>
</html>
