<?php

class Survey {
    public static function getAllSurveys($db) {
        $query = 'SELECT * FROM surveys ORDER BY id DESC';
        return $db->query($query)->fetchAll(PDO::FETCH_ASSOC);
    }

    public static function createSurvey($db, $title, $description, $issue, $deadline, $experience) {
        $query = 'INSERT INTO surveys (title, description, issue, deadline, experience) VALUES (:title, :description, :issueDate, :deadline, :exp)';
        $stmt = $db->prepare($query);
        $result = $stmt->execute([
            'title' => $title,
            'description' => $description,
            'issueDate' => $issue,
            'deadline' => $deadline,
            'exp' => $experience,
        ]);

        if ($result) {
            return $db->lastInsertId();
        }

        return false;
    }

    public static function getSurveyById($db, $id) {
        $query = 'SELECT * FROM surveys WHERE id = :id';
        $stmt = $db->prepare($query);
        $stmt->execute(['id' => $id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public static function updateSurvey($db, $id, $title, $description, $issue, $deadline, $experience) {
        $query = 'UPDATE surveys SET title = :title, description = :description, issue = :issueDate, deadline = :deadline, experience = :exp WHERE id = :id';
        $stmt = $db->prepare($query);
        return $stmt->execute([
            'title' => $title,
            'description' => $description,
            'issueDate' => $issue,
            'deadline' => $deadline,
            'exp' => $experience,
            'id' => $id,
        ]);
    }

    public static function toggleSurveyStatus($db, $id) {
        $query = 'UPDATE surveys SET is_live = NOT is_live WHERE id = :id';
        $stmt = $db->prepare($query);
        $stmt->execute(['id' => $id]);
        return $stmt->rowCount();
    }

    public static function deleteSurvey($db, $id) {
        $query = 'DELETE FROM surveys WHERE id = :id';
        $stmt = $db->prepare($query);
        return $stmt->execute(['id' => $id]);
    }
}
?>
