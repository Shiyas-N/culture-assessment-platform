<?php

class QuestionSurvey{

    public static function getSurveyQuestion($db, $survey_id) {
        $query = 'SELECT q.id, q.text FROM questions q JOIN survey_questions sq ON q.id = sq.question_id WHERE sq.survey_id = :id';

        $stmt = $db->prepare($query);
        $stmt->execute(['id'=>$survey_id]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public static function createSurveyQuestion($db, $survey_id, $question_id) {
        $query = 'INSERT INTO survey_questions (survey_id, question_id)
                  VALUES (:survey_id, :question_id)';

        $stmt = $db->prepare($query);
        return $stmt->execute([
            'survey_id' => $survey_id,
            'question_id' => $question_id,
        ]);
    }

    public static function deleteSurveyQuestion($db, $survey_id, $question_id) {
        $query = 'DELETE FROM survey_questions WHERE survey_id = :survey_id AND question_id = :question_id';
        $stmt = $db->prepare($query);
        return $stmt->execute([
            'survey_id'=>$survey_id,
            'question_id'=>$question_id
        ]);
    }

}


?>