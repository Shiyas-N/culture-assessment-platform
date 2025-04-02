<!-- Survey model (title, description, live status, etc.) -->
<?php
require_once '../../db/connect.php';

class Survey {
    public static function getAllSurveys() {
        global $conn;
        $query = "SELECT * FROM surveys";
        $result = mysqli_query($conn, $query);
        return mysqli_fetch_all($result, MYSQLI_ASSOC);
    }

    public static function publishSurvey($surveyId) {
        global $conn;
        $query = "UPDATE surveys SET status = 'published' WHERE id = ?";
        $stmt = mysqli_prepare($conn, $query);
        mysqli_stmt_bind_param($stmt, "i", $surveyId);
        return mysqli_stmt_execute($stmt);
    }
}
?>
