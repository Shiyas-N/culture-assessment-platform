<?php

require_once __DIR__ . '/../models/CulturalValue.php';

class CulturalValueController {
    private $db;

    public function __construct($db) {
        $this->db = $db;
    }

    public function getAllCulturalValues() {
        return CulturalValue::getAllCulturalValues($this->db);
    }

    public function createCulturalValue($value_name) {
        return CulturalValue::createCulturalValue($this->db, $value_name);
    }

    public function deleteCulturalValue($id) {
        return CulturalValue::deleteCulturalValue($this->db, $id);
    }
}
?>
