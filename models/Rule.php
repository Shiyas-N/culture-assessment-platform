<?php

class Rule {

    public static function getAllRules($db) {
        $query = "SELECT * FROM rules";
        return $db->query($query)->fetchAll(PDO::FETCH_ASSOC);
    }


    public static function getRulesBySurvey($db, $survey_id) {
        $query = "SELECT * FROM rules WHERE survey_id = :survey_id";
        $stmt = $db->prepare($query);
        $stmt->execute(['survey_id' => $survey_id]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    

    public static function createRule($db, $survey_id, $rule_name, $rule_type) {
        $query = "INSERT INTO rules (survey_id, rule_name, rule_type) VALUES (:survey_id, :rule_name, :rule_type)";
        $stmt = $db->prepare($query);
        $result = $stmt->execute([
            'survey_id' => $survey_id,
            'rule_name' => $rule_name,
            'rule_type' => $rule_type
        ]);
    
        if ($result) {
            return $db->lastInsertId();
        }
        
        return false;
    }
    

    public static function deleteRule($db, $rule_id) {
        $query = "DELETE FROM rules WHERE id = :id";
        $stmt = $db->prepare($query);
        return $stmt->execute(['id' => $rule_id]);
    }

}

?>