<?php
    require_once(__DIR__ .'/../helpers/Connection.php');

    class Members extends Connection {
        public $id_member;
        public $name;

        function __construct($attributes = array()) {
            if (!empty($attributes)) {
                $this->id_member = array_key_exists('id_member', $attributes) ? $attributes['id_member'] : '';
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
            $stm = $connect->prepare('UPDATE `members` SET name=:name WHERE id_member=:id_member');
            $stm->bindValue(':id_member', $this->id_member, PDO::PARAM_INT);
            $stm->bindValue(':name', $this->name, PDO::PARAM_STR);
            return $stm->execute();

        }

        public function delete($id_member) {
            $connect = Connection::connect();
            $stm = $connect->prepare('DELETE FROM members WHERE id_member = :id_member');
            $stm->bindValue(':id_member', $id_member, PDO::PARAM_INT);
            return $stm->execute();
        }

        public static function readOne($id_member) {
            $connect = Connection::connect();
            $stm = $connect->prepare('SELECT id_member, name FROM members WHERE id_member=:id_member');
            $stm->bindValue(':id_member', $id_member, PDO::PARAM_INT);
            $stm->execute();
            return $stm->fetch(PDO::FETCH_OBJ);
        }

        public static function readAll() {
            $connect = Connection::connect();
            $stm = $connect->prepare('SELECT id_member, name FROM members');
            $stm->execute();
            return $stm->fetchAll(PDO::FETCH_OBJ);
        }
    }
