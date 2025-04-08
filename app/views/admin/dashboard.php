<?php
require_once __DIR__ . '/../../models/Survey.php';
$surveys = Survey::getAllSurveys();
?>

<!-- Link to styles -->
<link rel="stylesheet" href="/../public/css/styles.css">

<div class="dashboard-container">
    <div class="dashboard-header">
        <h2>Survey List</h2>
        <a href="survey_create.php" class="create-survey-btn">
            <span class="plus-icon">&#43;</span>Create Survey
        </a>
    </div>

    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Title</th>
                <th>Description</th>
                <th>Issue Date</th>
                <th>Deadline</th>
                <th>Experience</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($surveys as $survey) : ?>
                <tr>
                    <td>
                        <a href="survey_details.php?id=<?php echo $survey['id']; ?>" class="survey-link">
                            <?php echo $survey['id']; ?>
                        </a>
                    </td>
                    <td><?php echo $survey['title']; ?></td>
                    <td><?php echo $survey['description']; ?></td>
                    <td><?php echo $survey['issue']; ?></td>
                    <td><?php echo $survey['deadline']; ?></td>
                    <td><?php echo $survey['experience']; ?></td>
                    <td>
                    <?php
                        $isLive = $survey['is_live'];
                        $buttonText = $isLive ? 'Unpublish' : 'Publish';
                        $buttonClass = $isLive ? 'Unpublish' : 'Publish';
                        ?>
                        <button
                            class="publish-btn <?php echo $buttonClass; ?>"
                            data-id="<?php echo $survey['id']; ?>"
                            data-status="<?php echo $isLive; ?>">
                            <?php echo $buttonText; ?>
                        </button>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>

<!-- JS to handle publish -->
<script>
document.querySelectorAll('.publish-btn').forEach(button => {
    button.addEventListener('click', function () {
        const surveyId = this.getAttribute('data-id');
        const isLive = this.getAttribute('data-status') === '1';
        const newAction = isLive ? 'Unpublish' : 'Publish';

        fetch(`../../controllers/SurveyController.php?action=${newAction}&id=${surveyId}`)
            .then(response => response.json())
            .then(data => {
                alert(data.message);

                // Update button status
                const newStatus = isLive ? '0' : '1';
                this.setAttribute('data-status', newStatus);
                this.textContent = isLive ? 'Publish' : 'Unpublish';

                // Update button class
                this.classList.remove(isLive ? 'Unpublish' : 'Publish');
                this.classList.add(isLive ? 'Publish' : 'Unpublish');
            })
            .catch(err => {
                console.error("Error toggling publish:", err);
                alert("Failed to update status.");
            });
    });
});
</script>
