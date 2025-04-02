<!-- Admin dashboard view -->
<?php include '../partials/header.php'; ?>
<h2>Admin Dashboard</h2>
<a href="survey_create.php" class="btn">Create Survey</a>
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
    <tbody id="survey-list">
        <!-- Surveys will be loaded via AJAX -->
    </tbody>
</table>
<script src="/public/js/survey.js"></script>
<?php include '../partials/footer.php'; ?>
