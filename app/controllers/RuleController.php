<?php

require_once __DIR__ . '/../models/Rule.php';
require_once __DIR__ . '/../models/RuleCondition.php';

class RuleController {
    private $db;
    
    public function __construct($db) {
        $this->db = $db;
    }

    public function createRule($rule_name, $rule_type) {
        return Rule::createRule($this->db, $rule_name, $rule_type);
    }

    public function deleteRule($rule_id) {
        return Rule::deleteRule($this->db, $rule_id);
    }

    public function addCondition($rule_id, $question_id, $answer_option_id, $logic_operator) {
        return RuleCondition::addCondition($this->db, $rule_id, $question_id, $answer_option_id, $logic_operator);
    }

    public function getAllRules() {
        return Rule::getAllRules($this->db);
    }
}

?>