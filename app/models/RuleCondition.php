<?php 

class RuleCondition {

    public static function getAllConditions($db){
        $query="SELECT * from rule_conditions";
        return $db->query($query)->fetchAll(PDO::FETCH_ASSOC);
    }

    public static function getRuleConditions($db,$rule_id){
        $query="SELECT * from rule_conditions WHERE id=:id";
        $stmt=$db->prepare($query);
        $stmt->execute(['id'=>$rule_id]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public static function addCondition($db, $rule_id, $question_id, $answer_option_id, $logic_operator=NULL) {
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

    public static function deleteCondition($db,$condition_id){
        $query="DELETE FROM rule_conditions WHERE id=:id";
        $stmt =$db->prepare($query);
        return $stmt->execute(['id'=>$condition_id]);
    }
}


?>