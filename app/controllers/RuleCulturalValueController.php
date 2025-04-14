<?php

require_once __DIR__ . '/../models/RuleCulturalValue.php';

class RuleCulturalValueController {
    private $db;

    public function __construct($db) {
        $this->db = $db;
    }

    public function getRuleValues($rule_id) {
        return RuleCulturalValue::getRuleValues($this->db, $rule_id);
    }

    public function addRuleValue($rule_id, $cultural_id, $points) {
        return RuleCulturalValue::addRuleValue($this->db, $rule_id, $cultural_id, $points);
    }

    public function deleteRuleValue($rule_id, $cultural_id) {
        return RuleCulturalValue::deleteRuleValue($this->db, $rule_id, $cultural_id);
    }
}
?>
