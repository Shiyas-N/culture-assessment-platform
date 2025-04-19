<?php


class RuleCulturalValue{

    public static function getRuleValues($db, $rule_id) {
        $query = 'SELECT c.value_name, rc.points FROM cultural_values c JOIN rule_cultural_values rc ON c.id = rc.cultural_value_id 
                  WHERE rc.rule_id = :id';
        $stmt = $db->prepare($query);
        $stmt->execute(['id' => $rule_id]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public static function addRuleValue($db,$rule_id,$cultural_id,$points){
        $query='INSERT INTO rule_cultural_values(rule_id,cultural_value_id,points) VALUES(:rule_id,:cultural_id,:points)';
        $stmt = $db->prepare($query);
        return $stmt->execute([
            'rule_id' => $rule_id,
            'cultural_id' => $cultural_id,
            'points'=>$points,
        ]);

    }

    public static function deleteRuleValue($db, $rule_id, $cultural_id) {
        $query = 'DELETE FROM rule_cultural_values WHERE rule_id = :rule_id AND cultural_value_id = :cultural_id';
        $stmt = $db->prepare($query);
        return $stmt->execute([
            'rule_id' => $rule_id,
            'cultural_id' => $cultural_id
        ]);
    }



}

?>