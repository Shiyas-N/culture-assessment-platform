<?php

class AnswerOption {

    public static function getAll($db) {
        $query = 'SELECT * FROM answer_options';
        return $db->query($query)->fetchAll(PDO::FETCH_ASSOC);
    }

    public static function add($db, $answer_text) {
        $query = 'INSERT INTO answer_options (answer_text) VALUES (:answer_text)';
        $stmt = $db->prepare($query);
        $stmt->execute(['answer_text' => $answer_text]);
        return $db->lastInsertId();
    }

    public static function delete($db, $id) {
        $query = 'DELETE FROM answer_options WHERE id = :id';
        $stmt = $db->prepare($query);
        return $stmt->execute(['id' => $id]);
    }
}
?>
