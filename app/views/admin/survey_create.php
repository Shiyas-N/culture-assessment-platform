<!-- Create/edit survey view -->
<?php include '../partials/header.php'; ?>
<h2>Create Survey</h2>
<form id="survey-form">
    <input type="text" name="title" placeholder="Title" required>
    <input type="text" name="issue" placeholder="Issue" required>
    <input type="date" name="deadline" required>
    <textarea name="description" placeholder="Description"></textarea>
    <button type="submit">Create</button>
</form>
<script src="/public/js/survey.js"></script>
<?php include '../partials/footer.php'; ?>
