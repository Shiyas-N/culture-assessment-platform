<?php


class Questions{

    public static function getAllQuestions($db){
        $query='SELECT * from questions';
        return $db->query($query)->fetchAll(PDO::FETCH_ASSOC);
    }

    public static function addQuestion($db,$text){
        $query='INSERT INTO questions(text) VALUES (:text)';
        $stmt = $db->prepare($query);
        $result = $stmt->execute(['text' => $text]);
    
        if ($result) {
            return $db->lastInsertId();
        }
        
        return false;
    }

    public static function deleteQuestion($db,$question_id){
        $query='DELETE FROM questions WHERE id=:id';
        $stmt=$db->prepare($query);
        return $stmt->execute(['id' => $question_id]);
    }


}

?>