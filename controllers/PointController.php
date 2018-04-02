<?php

// require_once(__DIR__.'/../helpers/Session.php');
// require_once(__DIR__.'/../helpers/Clearance.php');
require_once (__DIR__ . '/../vendor/autoload.php');
require_once(__DIR__.'/../models/Point.php');
// Session::checkSession();
date_default_timezone_set('America/Bahia');
class PointController{

    public static function create() {
        if(isset($_POST['ponto']) && !empty($_POST['ponto']) && $_POST['ponto'] != null){
            $_POST['ponto']['date'] = date('Y-m-d H:i:s');
            $_POST['ponto']['end_time'] = null;
            $point = new Point($_POST['ponto']);
            try {
                $point->create();
                $_SESSION['msg'] = null;
            }
            catch(PDOException $e) {
                $_SESSION['msg'] = null;
                d($e);
            }
        }
        header('Location:../views/ponto/index.php');
    }

    public static function update() {
        if($_POST['name'] != ''){

            $point = new Point($_POST);
            try {
                $point->update();
                $_SESSION['msg'] = null;
            }
            catch(PDOException $e) {
                $_SESSION['msg'] = null;
            }
        }
        header('Location:../views/membros/index.php');
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
} elseif (!empty(key($_GET)) &&  key($_GET) == "delete") {
    PointController::delete();
}
