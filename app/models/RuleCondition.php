<!-- Condition linking questions and answer options -->

<?php 

require_once __DIR__ . '/../../db/db.php';

class RuleCondition {
    public static function addCondition($db, $rule_id, $question_id, $answer_option_id, $logic_operator) {
        $query = "INSERT INTO rule_conditions (rule_id, question_id, answer_option_id, logic_operator) 
                  VALUES (:rule_id, :question_id, :answer_option_id, :logic_operator)";
        $stmt = $db->prepare($query);
        return $stmt->execute([
            'rule_id' => $rule_id,
            'question_id' => $question_id,
            'answer_option_id' => $answer_option_id,
            'logic_operator' => $logic_operator
        ]);
    }
}


?>