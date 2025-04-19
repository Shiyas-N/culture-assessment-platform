<head>
    <link rel="stylesheet" href="/../public/css/styles.css">
</head>
<?php
require_once __DIR__ . '/../../models/Survey.php';
require_once __DIR__ . '/../../models/QuestionSurvey.php';
require_once __DIR__ . '/../../db/connect.php';

if (!isset($_GET['id'])) {
    echo "No survey ID provided.";
    exit;
}

$survey = Survey::getSurveyById($pdo, $_GET['id']);
if (!$survey) {
    echo "Survey not found.";
    exit;
}

$surveyQuestions = QuestionSurvey::getSurveyQuestion($pdo,$_GET['id']);


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Survey Details</title>
    <!-- <style>
        :root {
            --primary-color: #3498db;
            --secondary-color: #2980b9;
            --light-gray: #f5f5f5;
            --medium-gray: #e0e0e0;
            --dark-gray: #333;
            --success-color: #2ecc71;
            --danger-color: #e74c3c;
            --warning-color: #f39c12;
        }
        
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            line-height: 1.6;
            color: #333;
            background-color: #f9f9f9;
            margin: 0;
            padding: 20px;
        }
        
        .container {
            max-width: 800px;
            margin: 0 auto;
            background-color: white;
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            padding: 30px;
        }
        
        h2 {
            color: var(--primary-color);
            border-bottom: 2px solid var(--medium-gray);
            padding-bottom: 10px;
            margin-top: 0;
            font-size: 24px;
        }
        
        .survey-info {
            margin-bottom: 30px;
            background-color: var(--light-gray);
            border-radius: 6px;
            padding: 20px;
        }
        
        .survey-info p {
            margin: 10px 0;
            display: flex;
            align-items: baseline;
        }
        
        .label {
            font-weight: 600;
            width: 140px;
            color: var(--dark-gray);
        }
        
        .value {
            flex: 1;
        }
        
        .description-value {
            padding: 15px;
            background-color: white;
            border-radius: 4px;
            border-left: 4px solid var(--primary-color);
            margin-top: 8px;
            line-height: 1.5;
        }
        
        .date-info {
            display: flex;
            flex-wrap: wrap;
            gap: 20px;
            margin: 20px 0;
        }
        
        .date-card {
            background-color: white;
            border-radius: 6px;
            padding: 15px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.05);
            min-width: 200px;
            flex: 1;
        }
        
        .date-card .date-label {
            font-size: 14px;
            color: #666;
            margin-bottom: 5px;
        }
        
        .date-card .date-value {
            font-size: 18px;
            font-weight: 600;
            color: var(--primary-color);
        }
        
        .badge {
            display: inline-block;
            padding: 5px 12px;
            border-radius: 50px;
            font-size: 14px;
            font-weight: 500;
            margin-left: 10px;
        }
        
        .experience-badge {
            background-color: #e8f4fd;
            color: var(--primary-color);
            position: relative;
            padding-left: 22px;
        }
        
        .experience-badge::before {
            content: '';
            position: absolute;
            left: 8px;
            top: 50%;
            transform: translateY(-50%);
            width: 8px;
            height: 8px;
            background-color: var(--primary-color);
            border-radius: 50%;
        }
        
        .badge-status {
            padding: 5px 12px;
            border-radius: 50px;
            font-size: 14px;
            font-weight: 500;
        }
        
        .badge-draft {
            background-color: #f0f0f0;
            color: #666;
        }
        
        .badge-published {
            background-color: #e3f9e5;
            color: var(--success-color);
        }
        
        .status-indicator {
            display: inline-flex;
            align-items: center;
        }
        
        .status-dot {
            display: inline-block;
            width: 12px;
            height: 12px;
            border-radius: 50%;
            margin-right: 8px;
        }
        
        .status-dot-live {
            background-color: var(--success-color);
            box-shadow: 0 0 0 3px rgba(46, 204, 113, 0.2);
        }
        
        .status-dot-offline {
            background-color: #ccc;
        }
        
        .stats-container {
            background-color: white;
            border-radius: 6px;
            padding: 15px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.05);
            margin: 20px 0;
        }
        
        .stats-title {
            font-size: 16px;
            color: var(--dark-gray);
            margin-bottom: 15px;
            font-weight: 600;
        }
        
        .stats-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(150px, 1fr));
            gap: 15px;
        }
        
        .stat-card {
            padding: 15px;
            background-color: var(--light-gray);
            border-radius: 6px;
            text-align: center;
        }
        
        .stat-value {
            font-size: 24px;
            font-weight: 700;
            color: var(--primary-color);
        }
        
        .stat-label {
            font-size: 14px;
            color: #666;
            margin-top: 5px;
        }
        
        .experience-range {
            display: inline-flex;
            align-items: center;
            background-color: white;
            border-radius: 6px;
            padding: 10px 15px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.05);
        }
        
        .range-label {
            font-weight: 500;
            color: #666;
            margin-right: 12px;
        }
        
        .range-value {
            color: var(--primary-color);
            font-weight: 600;
            font-size: 16px;
        }
        
        .actions {
            display: flex;
            justify-content: space-evenly;
            align-items: center;
            gap: 15px;
            margin-top: 30px;
        }
        
        .btn {
            padding: 10px 20px;
            border-radius: 6px;
            font-weight: 500;
            text-decoration: none;
            cursor: pointer;
            transition: all 0.2s;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            border: none;
        }
        
        .btn-primary {
            background-color: var(--primary-color);
            color: white;
        }
        
        .btn-primary:hover {
            background-color: var(--secondary-color);
        }
        
        .btn-secondary {
            background-color: #f0f0f0;
            color: #333;
        }
        
        .btn-secondary:hover {
            background-color: #e0e0e0;
        }
        
        .btn i {
            margin-right: 8px;
        }
        
        @media (max-width: 768px) {
            .container {
                padding: 20px;
                border-radius: 0;
            }
            
            .date-info {
                flex-direction: column;
                gap: 10px;
            }
            
            .stats-grid {
                grid-template-columns: 1fr 1fr;
            }
            
            .actions {
                flex-direction: column;
            }
            
            .btn {
                width: 100%;
            }
            
            .label {
                width: 120px;
            }
        }
    </style> -->

    <style>
        :root {
            --primary-color: #3498db;
            --secondary-color: #2980b9;
            --light-gray: #f5f5f5;
            --medium-gray: #e0e0e0;
            --dark-gray: #333;
            --success-color: #2ecc71;
            --danger-color: #e74c3c;
            --warning-color: #f39c12;
        }
        
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            line-height: 1.6;
            color: #333;
            background-color: #f9f9f9;
            margin: 0;
            padding: 20px;
        }
        
        .container {
            max-width: 800px;
            margin: 0 auto;
            background-color: white;
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            padding: 30px;
        }
        
        h2 {
            color: var(--primary-color);
            border-bottom: 2px solid var(--medium-gray);
            padding-bottom: 10px;
            margin-top: 0;
            font-size: 24px;
        }
        
        .survey-info {
            margin-bottom: 30px;
            background-color: var(--light-gray);
            border-radius: 6px;
            padding: 20px;
        }
        
        .survey-info p {
            margin: 10px 0;
            display: flex;
            align-items: baseline;
        }
        
        .label {
            font-weight: 600;
            width: 140px;
            color: var(--dark-gray);
        }
        
        .value {
            flex: 1;
        }
        
        .description-value {
            padding: 15px;
            background-color: white;
            border-radius: 4px;
            border-left: 4px solid var(--primary-color);
            margin-top: 8px;
            line-height: 1.5;
        }
        
        .date-info {
            display: flex;
            flex-wrap: wrap;
            gap: 20px;
            margin: 20px 0;
        }
        
        .date-card {
            background-color: white;
            border-radius: 6px;
            padding: 15px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.05);
            min-width: 200px;
            flex: 1;
        }
        
        .date-card .date-label {
            font-size: 14px;
            color: #666;
            margin-bottom: 5px;
        }
        
        .date-card .date-value {
            font-size: 18px;
            font-weight: 600;
            color: var(--primary-color);
        }
        
        .badge {
            display: inline-block;
            padding: 5px 12px;
            border-radius: 50px;
            font-size: 14px;
            font-weight: 500;
            margin-left: 10px;
        }
        
        .experience-badge {
            background-color: #e8f4fd;
            color: var(--primary-color);
            position: relative;
            padding-left: 22px;
        }
        
        .experience-badge::before {
            content: '';
            position: absolute;
            left: 8px;
            top: 50%;
            transform: translateY(-50%);
            width: 8px;
            height: 8px;
            background-color: var(--primary-color);
            border-radius: 50%;
        }
        
        .badge-status {
            padding: 5px 12px;
            border-radius: 50px;
            font-size: 14px;
            font-weight: 500;
        }
        
        .badge-draft {
            background-color: #f0f0f0;
            color: #666;
        }
        
        .badge-published {
            background-color: #e3f9e5;
            color: var(--success-color);
        }
        
        .status-indicator {
            display: inline-flex;
            align-items: center;
        }
        
        .status-dot {
            display: inline-block;
            width: 12px;
            height: 12px;
            border-radius: 50%;
            margin-right: 8px;
        }
        
        .status-dot-live {
            background-color: var(--success-color);
            box-shadow: 0 0 0 3px rgba(46, 204, 113, 0.2);
        }
        
        .status-dot-offline {
            background-color: #ccc;
        }
        
        .stats-container {
            background-color: white;
            border-radius: 6px;
            padding: 15px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.05);
            margin: 20px 0;
        }
        
        .stats-title {
            font-size: 16px;
            color: var(--dark-gray);
            margin-bottom: 15px;
            font-weight: 600;
        }
        
        .stats-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(150px, 1fr));
            gap: 15px;
        }
        
        .stat-card {
            padding: 15px;
            background-color: var(--light-gray);
            border-radius: 6px;
            text-align: center;
        }
        
        .stat-value {
            font-size: 24px;
            font-weight: 700;
            color: var(--primary-color);
        }
        
        .stat-label {
            font-size: 14px;
            color: #666;
            margin-top: 5px;
        }
        
        .experience-range {
            display: inline-flex;
            align-items: center;
            background-color: white;
            border-radius: 6px;
            padding: 10px 15px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.05);
        }
        
        .range-label {
            font-weight: 500;
            color: #666;
            margin-right: 12px;
        }
        
        .range-value {
            color: var(--primary-color);
            font-weight: 600;
            font-size: 16px;
        }
        
        .actions {
            display: flex;
            justify-content: space-evenly;
            align-items: center;
            gap: 15px;
            margin-top: 30px;
        }
        
        .btn {
            padding: 10px 20px;
            border-radius: 6px;
            font-weight: 500;
            text-decoration: none;
            cursor: pointer;
            transition: all 0.2s;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            border: none;
        }
        
        .btn-primary {
            background-color: var(--primary-color);
            color: white;
        }
        
        .btn-primary:hover {
            background-color: var(--secondary-color);
        }
        
        .btn-secondary {
            background-color: #f0f0f0;
            color: #333;
        }
        
        .btn-secondary:hover {
            background-color: #e0e0e0;
        }
        
        .btn-danger {
            background-color: var(--danger-color);
            color: white;
        }
        
        .btn-danger:hover {
            background-color: #c0392b;
        }
        
        .btn i {
            margin-right: 8px;
        }
        
        /* Questions Styles */
        .questions-container {
            margin-top: 30px;
        }
        
        .questions-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 15px;
        }
        
        .questions-title {
            font-size: 20px;
            color: var(--primary-color);
            font-weight: 600;
        }
        
        .question-item {
            background-color: var(--light-gray);
            border-radius: 6px;
            margin-bottom: 15px;
            padding: 15px;
            position: relative;
            transition: all 0.2s;
            border-left: 4px solid var(--primary-color);
        }
        
        .question-item:hover {
            box-shadow: 0 3px 8px rgba(0, 0, 0, 0.1);
        }
        
        .question-content {
            margin-bottom: 8px;
            font-weight: 500;
        }
        
        .question-type {
            font-size: 14px;
            color: #666;
            background-color: #e8f4fd;
            padding: 3px 10px;
            border-radius: 20px;
            display: inline-block;
            margin-bottom: 10px;
        }
        
        .question-options {
            background-color: white;
            border-radius: 6px;
            padding: 10px 15px;
            margin-top: 10px;
        }
        
        .option-item {
            padding: 5px 0;
            border-bottom: 1px solid var(--medium-gray);
        }
        
        .option-item:last-child {
            border-bottom: none;
        }
        
        .question-actions {
            position: absolute;
            right: 15px;
            top: 15px;
            display: flex;
            gap: 5px;
        }
        
        .action-btn {
            background-color: white;
            border: 1px solid var(--medium-gray);
            border-radius: 4px;
            width: 28px;
            height: 28px;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            transition: all 0.2s;
        }
        
        .action-btn:hover {
            background-color: var(--light-gray);
        }
        
        .action-btn.edit:hover {
            color: var(--primary-color);
            border-color: var(--primary-color);
        }
        
        .action-btn.delete:hover {
            color: var(--danger-color);
            border-color: var(--danger-color);
        }
        
        .add-question-form {
            background-color: white;
            border-radius: 6px;
            padding: 20px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            margin-top: 20px;
            margin-bottom: 20px;
            display: none;
        }
        
        .form-title {
            font-size: 18px;
            font-weight: 600;
            margin-bottom: 15px;
            color: var(--primary-color);
        }
        
        .form-group {
            margin-bottom: 15px;
        }
        
        .form-label {
            display: block;
            margin-bottom: 5px;
            font-weight: 500;
        }
        
        .form-control {
            width: 100%;
            padding: 10px;
            border: 1px solid var(--medium-gray);
            border-radius: 4px;
            font-family: inherit;
            font-size: 14px;
        }
        
        .form-control:focus {
            outline: none;
            border-color: var(--primary-color);
            box-shadow: 0 0 0 3px rgba(52, 152, 219, 0.1);
        }
        
        .options-container {
            margin-top: 10px;
        }
        
        .option-row {
            display: flex;
            gap: 10px;
            margin-bottom: 8px;
            align-items: center;
        }
        
        .remove-option {
            color: var(--danger-color);
            cursor: pointer;
        }
        
        .add-option {
            display: inline-flex;
            align-items: center;
            color: var(--primary-color);
            cursor: pointer;
            margin-top: 5px;
            font-size: 14px;
        }
        
        .add-option i {
            margin-right: 5px;
        }
        
        .form-actions {
            display: flex;
            justify-content: flex-end;
            gap: 10px;
            margin-top: 20px;
        }
        
        .no-questions {
            background-color: var(--light-gray);
            padding: 20px;
            text-align: center;
            border-radius: 6px;
            color: #666;
        }
        
        @media (max-width: 768px) {
            .container {
                padding: 20px;
                border-radius: 0;
            }
            
            .date-info {
                flex-direction: column;
                gap: 10px;
            }
            
            .stats-grid {
                grid-template-columns: 1fr 1fr;
            }
            
            .actions {
                flex-direction: column;
            }
            
            .btn {
                width: 100%;
            }
            
            .label {
                width: 120px;
            }
            
            .question-actions {
                position: relative;
                top: auto;
                right: auto;
                margin-top: 10px;
                justify-content: flex-end;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Survey Details</h2>
        
        <div class="survey-info">
            <p>
                <span class="label">ID:</span>
                <span class="value"><?= $survey['id'] ?></span>
            </p>
            <p>
                <span class="label">Title:</span>
                <span class="value"><?= $survey['title'] ?></span>
            </p>
            <p>
                <span class="label">Description:</span>
                <div class="description-value"><?= $survey['description'] ?></div>
            </p>
            
            <div class="date-info">
                <div class="date-card">
                    <div class="date-label">Issue Date</div>
                    <div class="date-value"><?= $survey['issue'] ?></div>
                </div>
                <div class="date-card">
                    <div class="date-label">Deadline</div>
                    <div class="date-value"><?= $survey['deadline'] ?></div>
                </div>
            </div>
            
            <p>
                <span class="label">Experience:</span>
                <span class="value">
                    <?php 
                    $experience = $survey['experience'] ?? 'Not specified';
                    
                    if (preg_match('/^(\d+)-(\d+)$/', $experience, $matches)) {
                        echo '<span class="experience-range">';
                        // echo '<span class="range-label">Years Required:</span>';
                        echo '<span class="range-value">' . $matches[1] . ' to ' . $matches[2] . ' years</span>';
                        echo '</span>';
                    } else {
                        echo '<span class="experience-badge badge">' . $experience . '</span>';
                    }
                    ?>
                </span>
            </p>
            
            <p>
                <span class="label">Status:</span>
                <span class="value">
                    <?php
                    $statusClass = ($survey['status'] == 'published') ? 'badge-published' : 'badge-draft';
                    ?>
                    <span class="badge-status <?= $statusClass ?>"><?= ucfirst($survey['status'] ?? 'draft') ?></span>
                </span>
            </p>
            
            <p>
                <span class="label">Availability:</span>
                <span class="value">
                    <span class="status-indicator">
                        <span class="status-dot <?= ($survey['is_live'] == 1) ? 'status-dot-live' : 'status-dot-offline' ?>"></span>
                        <?= ($survey['is_live'] == 1) ? 'Live' : 'Offline' ?>
                    </span>
                </span>
            </p>
        </div>
        
        <div class="stats-container">
            <div class="stats-title">Survey Statistics</div>
            <div class="stats-grid">
                <div class="stat-card">
                    <div class="stat-value"><?= $survey['members_polled'] ?></div>
                    <div class="stat-label">Members Polled</div>
                </div>
                
                <?php
                $deadline = new DateTime($survey['deadline']);
                $today = new DateTime();
                $interval = $today->diff($deadline);
                $daysRemaining = $deadline > $today ? $interval->days : 0;
                
                $issueDate = new DateTime($survey['issue']);
                $elapsedInterval = $issueDate->diff($today);
                $daysElapsed = $issueDate <= $today ? $elapsedInterval->days : 0;
                ?>
                
                <div class="stat-card">
                    <div class="stat-value"><?= $daysRemaining ?></div>
                    <div class="stat-label">Days Remaining</div>
                </div>
                
                <div class="stat-card">
                    <div class="stat-value"><?= $daysElapsed ?></div>
                    <div class="stat-label">Days Elapsed</div>
                </div>
            </div>

            <div class="questions-container">
            <div class="questions-header">
                <div class="questions-title">Survey Questions</div>
                <a href="add_question.php?survey_id=<?=$_GET['id']?>">
                <button id="addQuestionBtn" class="btn btn-primary">
                    <i class="fas fa-plus"></i> Add Question
                </button>
                </a>
            </div>
            
            
            
            <?php if (empty($surveyQuestions)): ?>
            <div class="no-questions">
                <i class="fas fa-question-circle" style="font-size: 32px; margin-bottom: 15px; color: #aaa;"></i>
                <p>No questions have been added to this survey yet.</p>
            </div>
            <?php else: ?>
                <?php foreach ($surveyQuestions as $question): ?>
                <div class="question-item">
                    <div class="question-actions">
                        <!-- <button class="action-btn edit" title="Edit Question">
                            <i class="fas fa-edit"></i>
                        </button> -->
                        <button id="delete-<?=$question['id']?>" class="action-btn delete" 
                            onclick="deleteQuestion(<?=$question['id']?>)" title="Delete Question">
                            <i class="fas fa-trash"></i>
                        </button>
                    </div>
                    <div class="question-content"><?= $question['text'] ?></div> 
                </div>
                <?php endforeach; ?>
            <?php endif; ?>
        </div>
        </div>
        
        <div class="actions">
            <a href="dashboard.php" class="btn btn-secondary">
                <i class="fas fa-arrow-left"></i> Back to Dashboard
            </a>
            
            
            <?php if ($survey['is_live'] == 1): ?>
            <a href="survey_toggle.php?id=<?= $survey['id'] ?>&action=deactivate" class="btn btn-secondary">
                <i class="fas fa-power-off"></i> Set Offline
            </a>
            <?php else: ?>
            <a href="survey_toggle.php?id=<?= $survey['id'] ?>&action=activate" class="btn btn-primary">
                <i class="fas fa-play"></i> Make Live
            </a>
            <?php endif; ?>
            
            <a href="survey_edit.php?id=<?= $survey['id'] ?>" class="btn btn-primary">
                <i class="fas fa-edit"></i> Edit Survey
            </a>
            
        </div>
    </div>
    
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/js/all.min.js"></script>
    <script src="../../public/js/survey_details.js"></script>
</body>
</html>