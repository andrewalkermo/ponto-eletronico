<?php
    require_once('/helpers/Connection.php');

    class Members {
        public $id;
        public $name;

        function __construct($attributes = array()) {
            if (!empty($attributes)) {
                $this->id = array_key_exists('id', $attributes) ? $attributes['id'] : '';
                $this->name = array_key_exists('name', $attributes) ? $attributes['name'] : '';
            }
        }

        public function create() {
            $connect = Connection::connect();
            $stm = $connect->prepare('INSERT INTO `members`(`name`)VALUES(:name)');
            $stm->bindValue(':name', $this->name, PDO::PARAM_STR);
            return $stm->execute();
        }

        public function update() {
            $connect = Connection::connect();
            $stm = $connect->prepare('UPDATE `members` SET name=:name WHERE id=:id');
            $stm->bindValue(':id', $this->id, PDO::PARAM_INT);
            $stm->bindValue(':name', $this->name, PDO::PARAM_STR);
            return $stm->execute();

        }

        public function delete($id) {
            $connect = Connection::connect();
            $stm = $connect->prepare('DELETE FROM members WHERE id = :id');
            $stm->bindValue(':id', $id, PDO::PARAM_INT);
            return $stm->execute();
        }

        public static function readUser($id) {
            $connect = Connection::connect();
            $stm = $connect->prepare('SELECT id, name FROM members WHERE id=:id');
            $stm->bindValue(':id', $id, PDO::PARAM_INT);
            $stm->execute();
            return $stm->fetch(PDO::FETCH_OBJ);
        }

        public static function readAllUsers() {
            $connect = Connection::connect();
            $stm = $connect->prepare('SELECT id, name FROM members');
            $stm->execute();
            return $stm->fetchAll(PDO::FETCH_OBJ);
        }
    }
