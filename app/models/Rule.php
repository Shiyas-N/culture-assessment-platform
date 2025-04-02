<!-- Survey rules (AND logic combining questions) -->

<?php

class Rule {

    public static function getAllRules($db) {
        $query = "SELECT * FROM rules";
        return $db->query($query)->fetchAll(PDO::FETCH_ASSOC);
    }

    public static function createRule($db, $rule_name, $rule_type) {
        $query = "INSERT INTO rules (rule_name, rule_type) VALUES (:rule_name, :rule_type)";
        $stmt = $db->prepare($query);
        return $stmt->execute(['rule_name' => $rule_name, 'rule_type' => $rule_type]);
    }

    public static function deleteRule($db, $rule_id) {
        $query = "DELETE FROM rules WHERE id = :id";
        $stmt = $db->prepare($query);
        return $stmt->execute(['id' => $rule_id]);
    }

}

?>