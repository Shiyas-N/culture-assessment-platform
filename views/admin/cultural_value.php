<?php
$ruleId = $_GET['rule_id'] ?? null;
$surveyId = $_GET['survey_id'] ?? null; 
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Add Cultural Values to Rule</title>
  <link rel="stylesheet" href="../../public/css/cultural_value.css">
</head>
<body>
  <h2>Add Cultural Values to Rule (Rule ID: <?= $ruleId ?>)</h2>

  <form id="ruleForm">
    <input type="hidden" name="rule_id" id="rule_id" value="<?= $ruleId ?>" />
    <div id="value-container"></div>

    <button type="button" id="add-button">Add Cultural Value</button>
    <br><br>
    <button type="submit">Submit</button>
  </form>

  <div id="result"></div>

  <script>
    const RULE_ID = <?= json_encode($ruleId) ?>;
    const SURVEY_ID = <?= json_encode($surveyId) ?>;
  </script>
  <script src="../../public/js/assign_cultural_value.js"></script>
</body>
</html>
