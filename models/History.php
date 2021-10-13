<?php
class History
{
    private $conn;
    private $table = 'history';

    public $task_name;
    public $action;
    public $user_id;

    public function __construct($db)
    {
        $this->conn = $db;
    }

    public function get_history()
    {
        $query = 'SELECT * FROM `' . $this->table .
            '` WHERE user_id = :user_id';

        $stmt = $this->conn->prepare($query);

        $stmt->bindParam(':user_id', $this->user_id);

        $stmt->execute();
        return $stmt;
    }

    public function create()
    {
        $query = 'INSERT INTO ' . $this->table . '
             SET
                task_name = :task_name,
                action = :action,
                user_id = :user_id;';

        $stmt = $this->conn->prepare($query);

        $this->task_name = htmlspecialchars(strip_tags($this->task_name));
        $this->action = htmlspecialchars(strip_tags($this->action));
        $this->user_id = htmlspecialchars(strip_tags($this->user_id));

        $stmt->bindParam(':task_name', $this->task_name);
        $stmt->bindParam(':action', $this->action);
        $stmt->bindParam(':user_id', $this->user_id);

        try {
            $stmt->execute();
            return true;
        } catch (PDOException $e) {
            return false;
        }
    }
}
