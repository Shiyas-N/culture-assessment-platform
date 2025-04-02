<?php
require_once '../db/db.php';

function testDatabaseConnection($pdo) {
    try {
        $stmt = $pdo->query("SELECT 1");
        if ($stmt) {
            return "Database connection is successful!";
        }
    } catch (PDOException $e) {
        return "Database connection failed: " . $e->getMessage();
    }
}

echo testDatabaseConnection($pdo);
?>
