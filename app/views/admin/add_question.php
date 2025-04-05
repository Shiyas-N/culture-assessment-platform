<?php
require_once __DIR__ . '/../../../db/connection.php';

if (!$pdo) {
    die("Database connection not established.");
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Add Question</title>
    <link rel="stylesheet" href="/../../../public/css/questions.css">
</head>
<body>

<div class="container">
    <h2>Add Questions to Survey</h2>

    <form action="insert_ques.php" method="post" onsubmit="prepareSubmit()">
        <!-- Existing question dropdown -->
        <label for="existing_qid">Select Existing Question:</label>
        <div class="question-wrapper">
            <select name="existing_qid" id="existing_qid">
                <option value="">-- Select a question --</option>
                <?php
                $questions = [];
                $stmt = $pdo->query("SELECT id, question_text FROM questions");
                while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                    $questions[$row['id']] = $row['question_text'];
                    echo "<option value='{$row['id']}'>{$row['question_text']}</option>";
                }
                ?>
            </select>
            <button type="button" class="action-btn" onclick="addSelectedQuestion()">Add</button>
        </div>

        <!-- New question input -->
        <label for="new_question">Or Add New Question:</label>
        <div class="new-question-wrapper">
            <input type="text" id="new_question_input" placeholder="Type a new question...">
            <button type="button" class="action-btn" onclick="addNewQuestion()">Create</button>
        </div>

        <!-- Display added questions -->
        <div id="selected-display">
            <strong>Added Questions:</strong>
            <div id="question-list"><ul></ul></div>
        </div>

        <!-- Hidden field for submission -->
        <input type="hidden" name="final_questions" id="final_questions">

        <!-- Buttons -->
        <div class="button-row">
            <button type="submit" class="submit-btn" onclick="prepareSubmit()">Save</button>
            <button type="button" class="back-button" onclick="window.history.back();">Go Back</button>
        </div>
    </form>
</div>

<script>
    const questions = <?php echo json_encode($questions); ?>;
</script>
<script src="/../../../public/js/questions.js"></script>

</body>
</html>
