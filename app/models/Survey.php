<head><link rel="stylesheet" href="/../public/css/styles.css"></head>
<?php
require_once __DIR__ . '/../../db/connection.php';

class Survey {
    public static function getAllSurveys() {
        $pdo = Database::connect();
        $stmt = $pdo->query("SELECT id, title, description, issue, deadline, is_live, experience FROM surveys ORDER BY id DESC");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public static function createSurvey($title, $description, $issue, $deadline, $experience) {
        require_once '../../db/connection.php';
        $pdo = Database::connect();
        $stmt = $pdo->prepare("INSERT INTO surveys (title, description, issue, deadline, experience) VALUES (?, ?, ?, ?, ?)");
        return $stmt->execute([$title, $description, $issue, $deadline, $experience]);
    }

    public static function getById($id) {
        $db = Database::connect();
        $stmt = $db->prepare("SELECT * FROM surveys WHERE id = ?");
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public static function updateSurvey($id, $title, $description, $issue, $deadline, $experience) {
        $db = Database::getInstance();
        $stmt = $db->prepare("UPDATE surveys SET title = ?, description = ?, issue = ?, deadline = ?, experience = ? WHERE id = ?");
        return $stmt->execute([$title, $description, $issue, $deadline, $experience, $id]);
    }

    public static function toggleSurveyStatus($id, $status) {
        $db = Database::getInstance();
        $stmt = $db->prepare("UPDATE surveys SET is_live = ? WHERE id = ?");
        $stmt->execute([$status, $id]);
        return $stmt->rowCount();
    }
}
?>
