<?php
require_once __DIR__ . '/../../db/connection.php';

class JobRole {
    public static function getAll() {
        $pdo = Database::connect();
        $stmt = $pdo->prepare("SELECT id, survey_id, job_role FROM job_roles");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
