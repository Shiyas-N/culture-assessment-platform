<?php
require_once "connect.php";

try {
    $stmt = $pdo->query("SELECT * FROM surveys");
    $surveys = $stmt->fetchAll(PDO::FETCH_ASSOC);

    if (!$surveys) {
        echo "✅ Database connected, but no surveys found in the table.";
    } else {
        echo "✅ Database connected successfully. Here are the surveys:<br>";
        print_r($surveys);
    }
} catch (Exception $e) {
    echo "❌ Error fetching surveys: " . $e->getMessage();
}
?>
