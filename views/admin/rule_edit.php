<?php
$rule_id = $_GET['id'] ?? null;
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Edit Rule</title>
</head>
<body>
    <h2>Edit Rule - ID: <?= htmlspecialchars($rule_id) ?></h2>
    <div id="ruleConditions"></div>

    <script>
        const ruleId = "<?= $rule_id ?>";

        fetch(`../../api/rule_condition_api.php?id=${ruleId}`)
            .then(response => response.json())
            .then(data => {
                const container = document.getElementById("ruleConditions");
                console.log(container)
                if (data.length === 0) {
                    container.innerHTML = "<p>No conditions found for this rule.</p>";
                    return;
                }

                const list = document.createElement("ul");

                data.forEach(condition => {
                    const item = document.createElement("li");
                    item.textContent = `Question ID: ${condition.question_id}, Answer Option ID: ${condition.answer_option_id}, Operator: ${condition.logic_operator}`;
                    list.appendChild(item);
                });

                container.appendChild(list);
            })
            .catch(error => {
                console.error("Error fetching rule conditions:", error);
            });
    </script>
</body>
</html>
