<?php
    require_once(__DIR__.'/../helpers/Connection.php');

    class User {
        public $id;
        public $username;
        public $password;
        public $level;

        function __construct($attributes = array()) {
            if (!empty($attributes)) {
                $this->id = array_key_exists('id', $attributes) ? $attributes['id'] : '';
                $this->username = array_key_exists('username', $attributes) ? $attributes['username'] : '';
                $this->password = array_key_exists('password', $attributes) ? $attributes['password'] : '';
                $this->level = array_key_exists('level', $attributes) ? $attributes['level'] : '';
            }
        }

        public function create() {
            $connect = Connection::connect();
            $stm = $connect->prepare('INSERT INTO `users`(`username`, `password`, `level`)VALUES(:username, :password, :level)');
            $stm->bindValue(':username', $this->username, PDO::PARAM_STR);
            $stm->bindValue(':password', $this->password, PDO::PARAM_STR);
            $stm->bindValue(':level', $this->level, PDO::PARAM_INT);
            return $stm->execute();
        }

        public function update() {
            $connect = Connection::connect();
            $stm = $connect->prepare('UPDATE `users` SET username=:username, level=:level WHERE id=:id');
            $stm->bindValue(':id', $this->id, PDO::PARAM_INT);
            $stm->bindValue(':username', $this->username, PDO::PARAM_STR);
            $stm->bindValue(':level', $this->level, PDO::PARAM_INT);
            return $stm->execute();

        }

        public function changePassword($id) {
            $connect = Connection::connect();
            $stm = $connect->prepare('UPDATE `users` SET password=:password WHERE id=:id');
            $stm->bindValue(':id', $id, PDO::PARAM_STR);
            $stm->bindValue(':password', $this->password, PDO::PARAM_STR);
            return $stm->execute();
        }

        public function delete($id) {
            $connect = Connection::connect();
            $stm = $connect->prepare('DELETE FROM users WHERE id = :id');
            $stm->bindValue(':id', $id, PDO::PARAM_INT);
            return $stm->execute();
        }

        public static function readUser($id) {
            $connect = Connection::connect();
            $stm = $connect->prepare('SELECT id, username, password, level FROM users WHERE id=:id');
            $stm->bindValue(':id', $id, PDO::PARAM_INT);
            $stm->execute();
            return $stm->fetch(PDO::FETCH_OBJ);
        }

        public static function getUser($username) {
            $connect = Connection::connect();
            $stm = $connect->prepare('SELECT * FROM users WHERE username=:username');
            $stm->bindValue(':username', $username, PDO::PARAM_STR);
            $stm->execute();
            return $stm->fetch(PDO::FETCH_ASSOC);
        }

        public static function readAllUsers() {
            $connect = Connection::connect();
            $stm = $connect->prepare('SELECT id, username, password, level FROM users');
            $stm->execute();
            return $stm->fetchAll(PDO::FETCH_OBJ);
        }
    }
