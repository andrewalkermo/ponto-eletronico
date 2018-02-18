<?php
    require_once('/helpers/Connection.php');

    class Schedule {
        public $id;
        public $begin_time;
        public $end_time;
        public $day;
        public $fk_members;

        function __construct($attributes = array()) {
            if (!empty($attributes)) {
                $this->id = array_key_exists('id', $attributes) ? $attributes['id'] : '';
                $this->begin_time = array_key_exists('begin_time', $attributes) ? $attributes['begin_time'] : '';
                $this->end_time = array_key_exists('end_time', $attributes) ? $attributes['end_time'] : '';
                $this->day = array_key_exists('day', $attributes) ? $attributes['day'] : '';
                $this->fk_members = array_key_exists('fk_members', $attributes) ? $attributes['fk_members'] : '';
            }
        }

        public function create() {
            $connect = Connection::connect();
            $stm = $connect->prepare('INSERT INTO `schedule`(`begin_time`, `end_time`, `day`, `fk_members`)VALUES(:begin_time, :end_time, :day, :fk_members)');
            $stm->bindValue(':begin_time', $this->begin_time, PDO::PARAM_STR);
            $stm->bindValue(':end_time', $this->end_time, PDO::PARAM_STR);
            $stm->bindValue(':day', $this->day, PDO::PARAM_INT);
            $stm->bindValue(':fk_members', $this->fk_members, PDO::PARAM_INT);
            return $stm->execute();
        }


        public function delete($id) {
            $connect = Connection::connect();
            $stm = $connect->prepare('DELETE FROM schedule WHERE id = :id');
            $stm->bindValue(':id', $id, PDO::PARAM_INT);
            return $stm->execute();
        }

        public static function read($id) {
            $connect = Connection::connect();
            $stm = $connect->prepare('SELECT id, begin_time, end_time, day, fk_members FROM schedule WHERE id=:id');
            $stm->bindValue(':id', $id, PDO::PARAM_INT);
            $stm->execute();
            return $stm->fetch(PDO::FETCH_OBJ);
        }

        public static function readAll() {
            $connect = Connection::connect();
            $stm = $connect->prepare('SELECT * FROM schedule');
            $stm->execute();
            return $stm->fetchAll(PDO::FETCH_OBJ);
        }
    }
