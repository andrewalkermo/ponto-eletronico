<?php
// require_once(__DIR__.'/../helpers/Session.php');
// require_once(__DIR__.'/../helpers/Clearance.php');
require_once(__DIR__.'/../models/Schedule.php');
// Session::checkSession();

class ScheduleController{

    public static function create() {
        if($_POST['ponto'] != ''){

            $member = new Schedule($_POST['ponto']);
            try {
                $member->create();
                $_SESSION['msg'] = null;
            }
            catch(PDOException $e) {
                $_SESSION['msg'] = null;
            }
        }
        header('Location:../views/membros/index.php');
    }

    public static function update() {
        if($_POST['name'] != ''){

            $member = new Schedule($_POST);
            try {
                $member->update();
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
                Schedule::delete($_GET['delete']);
                $_SESSION['msg'] = null;
            }
            catch(PDOException $e) {
                $_SESSION['msg'] = null;
            }
        }
    }

    public static function select($id) {
        try {
            $member = Schedule::readOne($id);
            return $member;
        }
        catch (PDOException $e) {

            $_SESSION['msg'] = null;
            var_dump($e);die;

        }

    }

    public static function selectAll() {
        try {
            $members = Schedule::readAll();
            $_SESSION['msg'] = null;
            return $members;
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
    UserController::$action();
} elseif (!empty($_GET)) {
    UserController::delete();
}
