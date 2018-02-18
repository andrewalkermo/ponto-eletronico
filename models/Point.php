<?php
    require_once('/helpers/Connection.php');

    class Schedule {
        public $id;
        public $point;
        public $period;
        public $time;
        public $type;
        public $fk_members;

        function __construct($attributes = array()) {
            if (!empty($attributes)) {
                $this->id = array_key_exists('id', $attributes) ? $attributes['id'] : '';
                $this->point = array_key_exists('point', $attributes) ? $attributes['point'] : '';
                $this->period = array_key_exists('period', $attributes) ? $attributes['period'] : '';
                $this->time = array_key_exists('time', $attributes) ? $attributes['time'] : '';
                $this->type = array_key_exists('type', $attributes) ? $attributes['type'] : '';
                $this->fk_members = array_key_exists('fk_members', $attributes) ? $attributes['fk_members'] : '';
            }
        }

        public function create() {
            $connect = Connection::connect();
            $stm = $connect->prepare('INSERT INTO `schedule`(`point`, `period`, `time`, `type`, `fk_members`)VALUES(:point, :period, :time, :type, :fk_members)');
            $stm->bindValue(':point', $this->point, PDO::PARAM_STR);
            $stm->bindValue(':period', $this->period, PDO::PARAM_STR);
            $stm->bindValue(':time', $this->time, PDO::PARAM_INT);
            $stm->bindValue(':type', $this->type, PDO::PARAM_INT);
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
            $stm = $connect->prepare('SELECT * FROM schedule WHERE id=:id');
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
