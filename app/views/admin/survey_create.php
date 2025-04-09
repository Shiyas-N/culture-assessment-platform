<?php include '../partials/header.php'; ?>

<!-- Link to custom styles -->
<!-- <head>
    <link rel="stylesheet" href="/testt/public/css/styles.css">
</head> -->

<div class="form-container">
    <h2>Create Survey</h2>

    <form id="survey-form">
        <div class="form-group">
            <label for="title">Title</label>
            <input type="text" name="title" id="title" placeholder="Survey title" required>
        </div>

        <div class="form-group">
            <label for="issue">Issue Date</label>
            <input type="date" name="issue" id="issue" required>
        </div>

        <div class="form-group">
            <label for="deadline">Deadline</label>
            <input type="date" name="deadline" id="deadline" required>
        </div>

        <div class="form-group">
            <label for="description">Description</label>
            <textarea name="description" id="description" placeholder="Survey description"></textarea>
        </div>

        <div class="form-group">
            <label for="experience">Experience</label>
            <select name="experience" id="experience" required>
                <option value="">-- Select Experience --</option>
                <option value="0-1">0-1 years</option>
                <option value="0-2">0-2 years</option>
                <option value="0-3">0-3 years</option>
                <option value="1-3">1-3 years</option>
                <option value="3+">3+ years</option>
            </select>
        </div>

        <div class="form-group">
            <button type="submit" class="btn-submit">Create Survey</button>
        </div>
    </form>
</div>

<script src="../../../public/js/survey.js"></script>

<?php include '../partials/footer.php'; ?>
