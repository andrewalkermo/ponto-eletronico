<?php
    require_once(__DIR__ . '/../helpers/Connection.php');

    class Point {
        public $id;
        public $begin_time;
        public $end_time;
        public $date;
        public $type;
        public $fk_members;

        function __construct($attributes = array()) {
            if (!empty($attributes)) {
                $this->begin_time = array_key_exists('begin_time', $attributes) ? $attributes['begin_time'] : '';
                $this->type = array_key_exists('type', $attributes) ? $attributes['type'] : '';
                $this->end_time = array_key_exists('end_time', $attributes) ? $attributes['end_time'] : '';
                $this->date = array_key_exists('date', $attributes) ? $attributes['date'] : '';
                $this->fk_members = array_key_exists('fk_members', $attributes) ? $attributes['fk_members'] : '';
            }
        }

        public function create() {
            $connect = Connection::connect();
            $stm = $connect->prepare('INSERT INTO `point`(`begin_time`, `end_time`, `date`, `type`, `fk_members`)VALUES(:begin_time, :end_time, :date, :type, :fk_members)');
            $stm->bindValue(':begin_time', $this->begin_time, PDO::PARAM_STR);
            $stm->bindValue(':end_time', $this->end_time, PDO::PARAM_STR);
            $stm->bindValue(':type', $this->type, PDO::PARAM_STR);
            $stm->bindValue(':date', $this->date, PDO::PARAM_INT);
            $stm->bindValue(':fk_members', $this->fk_members, PDO::PARAM_INT);
            return $stm->execute();
        }


        public function delete($id) {
            $connect = Connection::connect();
            $stm = $connect->prepare('DE  LETE FROM point WHERE id = :id');
            $stm->bindValue(':id', $id, PDO::PARAM_INT);
            return $stm->execute();
        }

        public static function read($id) {
            $connect = Connection::connect();
            $stm = $connect->prepare('SELECT id, begin_time, end_time, date, fk_members FROM point WHERE id=:id');
            $stm->bindValue(':id', $id, PDO::PARAM_INT);
            $stm->execute();
            return $stm->fetch(PDO::FETCH_OBJ);
        }

        public static function readAll() {
            $connect = Connection::connect();
            $stm = $connect->prepare('SELECT * FROM point');
            $stm->execute();
            return $stm->fetchAll(PDO::FETCH_OBJ);
        }
    }
