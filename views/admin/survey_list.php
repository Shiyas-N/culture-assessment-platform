<!-- List & manage surveys -->
<?php include '../partials/header.php'; ?>
<h2>Manage Surveys</h2>
<div id="survey-container">
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Title</th>
                <th>Issue</th>
                <th>Deadline</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody id="survey-table-body"></tbody>
    </table>
</div>
<script src="/public/js/survey.js"></script>
<?php include '../partials/footer.php'; ?>
