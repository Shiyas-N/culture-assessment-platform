<!-- Survey model (title, description, live status, etc.) -->
require_once '../helpers/database.php';

class Survey {
    public static function all() {
        global $db;
        return $db->query("SELECT * FROM survey")->fetchAll(PDO::FETCH_ASSOC);
    }

    public function save() {
        global $db;
        $stmt = $db->prepare("INSERT INTO survey (title, issue, deadline, description) VALUES (?, ?, ?, ?)");
        $stmt->execute([$this->title, $this->issue, $this->deadline, $this->description]);
    }

    public static function find($id) {
        global $db;
        $stmt = $db->prepare("SELECT * FROM survey WHERE survey_id = ?");
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_OBJ);
    }
}
