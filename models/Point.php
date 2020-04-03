<?php
    require_once(__DIR__ . '/../helpers/Connection.php');

    class Point {
        public $id_point;
        public $begin_time;
        public $end_time;
        public $begin_datetime;
        public $end_datetime;
        public $type;
        public $fk_members;

        function __construct($attributes = array()) {
            if (!empty($attributes)) {
                $this->id_point = array_key_exists('id_point', $attributes) ? $attributes['id_point'] : '';
                $this->begin_time = array_key_exists('begin_time', $attributes) ? $attributes['begin_time'] : '';
                $this->end_time = array_key_exists('end_time', $attributes) ? $attributes['end_time'] : '';
                $this->begin_datetime = array_key_exists('begin_datetime', $attributes) ? $attributes['begin_datetime'] : '';
                $this->end_datetime = array_key_exists('end_datetime', $attributes) ? $attributes['end_datetime'] : '';
                $this->type = array_key_exists('type', $attributes) ? $attributes['type'] : '';
                $this->fk_members = array_key_exists('fk_members', $attributes) ? $attributes['fk_members'] : '';
            }
        }

        public function create() {
            $connect = Connection::connect();
            // var_dump($this->begin_datetime);die;
// 
            $stm = $connect->prepare('INSERT INTO `point`(`begin_time`, `end_time`, `begin_datetime`, `end_datetime`, `type`, `fk_members`)VALUES(:begin_time, :end_time, :begin_datetime, :end_datetime, :type, :fk_members)');
            $stm->bindValue(':begin_time', $this->begin_time, PDO::PARAM_STR);
            $stm->bindValue(':end_time', $this->end_time, PDO::PARAM_STR);
            $stm->bindValue(':type', $this->type, PDO::PARAM_STR);
            $stm->bindValue(':begin_datetime', $this->begin_datetime, PDO::PARAM_STR);
            $stm->bindValue(':end_datetime', $this->end_datetime, PDO::PARAM_STR);
            $stm->bindValue(':fk_members', $this->fk_members, PDO::PARAM_INT);
            return $stm->execute();
        }

        public function update() {
            $connect = Connection::connect();
            $stm = $connect->prepare('UPDATE `point` SET end_time=:end_time, end_datetime=:end_datetime WHERE id_point=:id_point');
            $stm->bindValue(':id_point', $this->id_point, PDO::PARAM_STR);
            $stm->bindValue(':end_time', $this->end_time, PDO::PARAM_STR);
            $stm->bindValue(':end_datetime', $this->end_datetime, PDO::PARAM_STR);
            return $stm->execute();

        }

        public function delete($id_point) {
            $connect = Connection::connect();
            $stm = $connect->prepare('DELETE FROM point WHERE id_point = :id_point');
            $stm->bindValue(':id_point', $id_point, PDO::PARAM_INT);
            return $stm->execute();
        }

        public static function read($id_point) {
            $connect = Connection::connect();
            $stm = $connect->prepare('SELECT * FROM point WHERE id_point=:id_point');
            $stm->bindValue(':id_point', $id_point, PDO::PARAM_INT);
            $stm->execute();
            return $stm->fetch(PDO::FETCH_OBJ);
        }

        public static function readAll() {
            $connect = Connection::connect();
            $stm = $connect->prepare('SELECT * FROM point');
            $stm->execute();
            return $stm->fetchAll(PDO::FETCH_OBJ);
        }

        public static function query($query) {

            $connect = Connection::connect();
            $stm = $connect->query($query);
            $stm->execute();
            return $stm->fetch(PDO::FETCH_OBJ);
        }

        public static function queryAll($query) {

            $connect = Connection::connect();
            $stm = $connect->query($query);
            $stm->execute();
            return $stm->fetchAll(PDO::FETCH_OBJ);
        }
    }
