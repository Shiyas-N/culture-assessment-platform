<?php

require_once __DIR__ . '/../models/Rule.php';
require_once __DIR__ . '/../models/RuleCondition.php';

class RuleController {
    private $db;
    
    public function __construct($db) {
        $this->db = $db;
    }

    public function getAllRules() {
        return Rule::getAllRules($this->db);
    }
    
    public function getRulesBySurvey($survey_id) {
        return Rule::getRulesBySurvey($this->db, $survey_id);
    }
    
    public function createRule($survey_id, $rule_name, $rule_type) {
        return Rule::createRule($this->db, $survey_id, $rule_name, $rule_type);
    }
    
    public function deleteRule($rule_id) {
        return Rule::deleteRule($this->db, $rule_id);
    }


    public function getAllConditions(){
        return RuleCondition::getAllConditions($this->db);
    }

    public function addCondition($rule_id, $question_id, $answer_option_id, $logic_operator) {
        return RuleCondition::addCondition($this->db, $rule_id, $question_id, $answer_option_id, $logic_operator);
    }

    public function deleteCondition($condition_id){
        return RuleCondition::deleteCondition($this->db,$condition_id);
    }


    public function getRuleConditions($rule_id){
        return RuleCondition::getRuleConditions($this->db,$rule_id);
    }

}

?>