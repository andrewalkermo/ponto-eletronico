<?php
// require_once(__DIR__.'/../helpers/Session.php');
// require_once(__DIR__.'/../helpers/Clearance.php');
require_once(__DIR__.'/../models/Members.php');
// Session::checkSession();
class MemberController{

    public static function create() {
        if(isset($_POST['membro']) && !empty($_POST['membro']) && $_POST['membro'] != null){

            $member = new Members($_POST['membro']);
            try {
                $member->create();
                $_SESSION['msg'] = null;
            }
            catch(PDOException $e) {
                $_SESSION['msg'] = null;
                d($e);
            }
        }
        header('Location:../views/membros/index.php');
    }

    public static function update() {
        if(isset($_POST['membro']) && !empty($_POST['membro']) && $_POST['membro'] != null){

            $member = new Members($_POST['membro']);
            try {
                $member->update();
                $_SESSION['msg'] = null;
            }
            catch(PDOException $e) {
                $_SESSION['msg'] = null;
                var_dump($e); die;
            }
        }
        header('Location:../views/membros/index.php');
    }


    public static function delete() {
        if(isset($_GET['delete']) && !empty($_GET['delete']) && $_GET['delete'] != null){
            try {
                Members::delete($_GET['delete']);
                $_SESSION['msg'] = null;
            }
            catch(PDOException $e) {
                $_SESSION['msg'] = null;
            }
        }
        header('Location:../views/membros/index.php');
    }

    public static function select($id) {
        if (!empty($column) && !empty($value)) {
            try {
                $member = Members::readOne($id);
                return $member;
            }
            catch (PDOException $e) {

                $_SESSION['msg'] = null;
                var_dump($e);

            }
        }
    }

    public static function selectAll() {
        try {
            $members = Members::readAll();
            $_SESSION['msg'] = null;
            $members = $members;
            return $members;
        }
        catch (pdoexception $e) {
            $_SESSION['msg'] = null;
            return $e;
        }
    }
}

$postActions = array('create', 'update', 'changePassword', 'recoverPassword');

if (isset($_POST['action']) && in_array($_POST['action'], $postActions)) {
    $action = $_POST['action'];
    MemberController::$action();
} elseif (!empty($_GET) &&  key($_GET) == "delete") {
    MemberController::delete();
}
