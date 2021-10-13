<?php
    class User {
        private $conn;
        private $table = 'users';

        public $id;
        public $username;
        public $password;
        public $tasks;
        public $stats;
        public $level;

        public function __construct($db) {
            $this->conn = $db;
        }

        public function get_users() {
            $query = 'SELECT * FROM '.$this->table.';';
            $stmt = $this->conn->prepare($query);
            $stmt->execute();
            return $stmt;
        }

        public function get_user() {
            if($this->id) {
                $query = 'SELECT * FROM '.$this->table.
                ' WHERE id = :id LIMIT 0,1;';
                $stmt = $this->conn->prepare($query);
                $stmt->bindParam(':id', $this->id);
            }
            else {
                $query = 'SELECT * FROM '.$this->table.
                ' WHERE username = :username AND password = :password LIMIT 0,1;';
                $stmt = $this->conn->prepare($query);
                $stmt->bindParam(':username', $this->username);
                $stmt->bindParam(':password', $this->password);
            }
            $stmt->execute();
            $row = $stmt->fetch(PDO::FETCH_ASSOC);

            if($row) {
                $this->id = $row['id'];
                $this->username = $row['username'];
                $this->tasks = $row['tasks'];
                $this->stats = $row['stats'];
                $this->level = $row['level'];

                return true;
            }
            else {
                return false;
            }
        }

        public function create() {
            $query = 'INSERT INTO '.$this->table.'
             SET
                username = :username,
                password = :password';
            
            $stmt = $this->conn->prepare($query);

            $this->username = htmlspecialchars(strip_tags($this->username));
            $this->password = htmlspecialchars(strip_tags($this->password));

            $stmt->bindParam(':username', $this->username);
            $stmt->bindParam(':password', $this->password);
            
            try {
                $stmt->execute();
                return true;
            } catch(PDOException $e) {
                return false;
            }
        }

        public function update() {
            $query = 'UPDATE '.$this->table.'
             SET
                tasks = :tasks,
                stats = :stats,
                level = :level
             WHERE id = :id';
            
            $stmt = $this->conn->prepare($query);
            echo $this->tasks;

            $this->id = htmlspecialchars(strip_tags($this->id));

            $stmt->bindParam(':id', $this->id);
            $stmt->bindParam(':tasks', $this->tasks);
            $stmt->bindParam(':stats', $this->stats);
            $stmt->bindParam(':level', $this->level);

            try {
                $stmt->execute();
                return true;
            } catch(PDOException $e) {
                return false;
            }
        }

        public function delete() {
            $query = 'DELETE FROM '.$this->table.' WHERE id = :id;';
            
            $stmt = $this->conn->prepare($query);
            $this->id = htmlspecialchars(strip_tags($this->id));
            $stmt->bindParam(':id', $this->id);

            try {
                $stmt->execute();
                return true;
            } catch(PDOException $e) {
                return false;
            }
        }
    }