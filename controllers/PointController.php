<?php

// require_once(__DIR__.'/../helpers/Session.php');
// require_once(__DIR__.'/../helpers/Clearance.php');
require_once(__DIR__.'/../models/Point.php');
// Session::checkSession();
date_default_timezone_set('America/Bahia');
class PointController{

    public static function create() {

        $data['success'] = false;

        if(isset($_POST['ponto']) && !empty($_POST['ponto']) && $_POST['ponto'] != null){
            if($_POST['ponto']['type'] == 'sede') {
                $_POST['ponto']['begin_time'] = date('H:i');
            }
            $_POST['ponto']['begin_datetime'] = date('Y-m-d H:i:s');
            $_POST['ponto']['end_time'] = null;
            $_POST['ponto']['end_datetime'] = null;

            $point = new Point($_POST['ponto']);
            try {
                $point->create();
                $_SERVER['msg'] = 'success';
                $data['success'] = true;
                $data['horario'] = $_POST['ponto']['begin_time'];

            }
            catch(PDOException $e) {
                $_SERVER['msg'] = 'error';
                $data['success'] = false;

            }
        }
        echo json_encode($data);
    }

    public static function update() {

        $data['success'] = false;

        $ponto = Point::query('SELECT * FROM point where `fk_members` = '.$_POST['ponto']['fk_members'].' AND `end_time` IS NULL AND `type` = "'.$_POST['ponto']['type'].'" ORDER BY `id_point` DESC LIMIT 1');
        if($ponto && isset($_POST['ponto']) && !empty($_POST['ponto']) && $_POST['ponto'] != null){
            if($_POST['ponto']['type'] == 'sede') {
                $_POST['ponto']['end_time'] = date('H:i');
            }
            $_POST['ponto']['end_datetime'] = date('Y-m-d H:i:s');
            $_POST['ponto']['id_point'] = $ponto->id_point;

            $point = new Point($_POST['ponto']);
            try {
                $point->update();
                $data['success'] = true;
                $data['horario'] = $_POST['ponto']['end_time'];

            }
            catch(PDOException $e) {
                $data['success'] = false;
            }
        }
        echo json_encode($data);
    }


    public static function delete() {
        if ($_POST['id'] != '') {
            try {
                Point::delete($_GET['delete']);
                $_SESSION['msg'] = null;
            }
            catch(PDOException $e) {
                $_SESSION['msg'] = null;
            }
        }
    }

    public static function select($id) {
        try {
            $point = Point::readOne($id);
            return $point;
        }
        catch (PDOException $e) {

            $_SESSION['msg'] = null;
            var_dump($e);die;

        }

    }

    public static function selectAll() {
        try {
            $points = Point::readAll();
            $_SESSION['msg'] = null;
            return $points;
        }
        catch (pdoexception $e) {
            $_SESSION['msg'] = null;
            echo $e;
        }
    }
}

$postActions = array('create', 'update', 'changePassword', 'recoverPassword');

if (isset($_POST['action']) && in_array($_POST['action'], $postActions)) {
    $action = $_POST['action'];
    PointController::$action();
} elseif (!empty($_GET)) {
    PointController::select($_GET['id']);
}
