<?php
    class Task {
        private $conn;
        private $table = 'tasks';

        public $id;
        public $name;
        public $description;
        public $category;
        public $value;
        public $creator;

        public function __construct($db) {
            $this->conn = $db;
        }

        public function get_task() {
            $query = 'SELECT * FROM '.$this->table.
            ' WHERE id = :id LIMIT 0,1;';
            $stmt = $this->conn->prepare($query);
            $stmt->bindParam(':id', $this->id);
            $stmt->execute();
            $row = $stmt->fetch(PDO::FETCH_ASSOC);

            $this->id = $row['id'];
            $this->name = $row['name'];
            $this->description = $row['description'];
            $this->category = $row['category'];
            $this->value = $row['value'];
            $this->creator = $row['creator'];
        }

        public function get_tasks($user_id, $pending, $all) {
            $pending = json_decode($pending);
            if($all){
                $query = 'SELECT * FROM `'.$this->table.
                '` WHERE creator IN (0, '.$user_id.') AND id NOT IN ('.implode(',', $pending).');';
            }
            else {
                $query = 'SELECT * FROM `'.$this->table.
                '` WHERE id IN ('.implode(',', $pending).');';
            };
            
            $stmt = $this->conn->prepare($query);
            $stmt->execute();
            return $stmt;
        }

        public function search_tasks($user_id, $pending) {
            $pending = json_decode($pending);
            $query = 'SELECT * FROM '.$this->table.
            ' WHERE creator IN (0, '.$user_id.') AND name LIKE :name AND id NOT IN ('.implode(',', $pending).');';
            $stmt = $this->conn->prepare($query);
            $stmt->bindParam(':name', $this->name);
            $stmt->execute();

            return $stmt;
        }

        public function create() {
            $query = 'INSERT INTO '.$this->table.'
             SET
                name = :name,
                description = :description,
                category = :category,
                value = :value,
                creator = :creator';
            
            $stmt = $this->conn->prepare($query);

            $this->name = htmlspecialchars(strip_tags($this->name));
            $this->description = htmlspecialchars(strip_tags($this->description));
            $this->category = htmlspecialchars(strip_tags($this->category));
            $this->value = htmlspecialchars(strip_tags($this->value));
            $this->creator = htmlspecialchars(strip_tags($this->creator));

            $stmt->bindParam(':name', $this->name);
            $stmt->bindParam(':description', $this->description);
            $stmt->bindParam(':category', $this->category);
            $stmt->bindParam(':value', $this->value);
            $stmt->bindParam(':creator', $this->creator);

            try {
                $stmt->execute();
                return true;
            } catch(PDOException $e) {
                return false;
            }
        }

    }