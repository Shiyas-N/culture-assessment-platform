<?php include '../partials/header.php'; ?>


<html lang="en">
<head> 
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create survey</title>
    <link rel="stylesheet" href="../../public/css/survey_create.css">
    
</head>

<body>
    <div class="container">
        <h2>CREATE SURVEY</h2>
        <form id = "survey-form">
            

            <label for="title">Title</label>
            <input type="text" name="title" id="title" placeholder="Survey title" required>

            <label for="issue">Issue Date</label>
            <input type="date" id="issue" name="issue" required>

            <label for="deadline">Deadline</label>
            <input type="date" id="deadline" name="deadline" required>

            <label for="description">Description</label>
            <textarea id="description" name="description" placeholder="Survey description"></textarea>

            <div class="flex">
                <div>
                    <label for="experience">Experience</label>
                    <select id="experience" name="experience" required>
                        <option value="">Select range</option>
                        <option value="0-2">0–2 Years</option>
                        <option value="2-5">2–5 Years</option>
                        <option value="5+">5+ Years</option>
                    </select>
                </div>
               
            </div>

            <div class="button-group">
                <button type="submit" class="create-btn">Create survey</button>
               
            </div>
        </form>
    </div>
</body>

</html>

 





<script src="../../public/js/survey.js"></script>

<?php include '../partials/footer.php'; ?>




