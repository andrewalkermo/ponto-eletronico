<?php

// require_once(__DIR__.'/../helpers/Session.php');
// require_once(__DIR__.'/../helpers/Clearance.php');
require_once(__DIR__.'/../models/Point.php');
// Session::checkSession();
date_default_timezone_set('America/Bahia');
class PointController{

    public static function create() {
        if(isset($_POST['ponto']) && !empty($_POST['ponto']) && $_POST['ponto'] != null){
            if(!(isset($_POST['ponto']['begin_time'])) || empty($_POST['ponto']['begin_time']) || $_POST['ponto']['begin_time'] == null) {
                if(isset($_POST['ponto']['end_time']) && !empty($_POST['ponto']['end_time']) && $_POST['ponto']['end_time'] != null) {
                    $_POST['ponto']['begin_time'] = $_POST['ponto']['end_time'];
                }
                else{
                    $_POST['ponto']['begin_time'] = date('H:i');
                }
            }
            $_POST['ponto']['date'] = date('Y-m-d H:i:s');
            $_POST['ponto']['end_time'] = null;
            $point = new Point($_POST['ponto']);
            try {
                $point->create();
                $_SERVER['msg'] = 'success';
                header('Location:../views/ponto/index.php?r='. $_POST['ponto']['begin_time']);

            }
            catch(PDOException $e) {
                $_SERVER['msg'] = 'error';
                header('Location:../views/ponto/index.php?r=null');
            }
        }
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
} elseif (!empty($_GET) &&  key($_GET) == "delete") {
    PointController::delete();
}
