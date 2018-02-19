<?php
// require_once('/helpers/Session.php');
require_once('UsersController.php');
require_once('../vendor/autoload.php');
// Session::checkSession();

class LoginController {

    public static function login(){
        if($_POST['login']['username'] != '' && $_POST['login']['password'] != ''){
            $user = UserController::selectUser('username',  $_POST['login']['username']);
            if($_POST['login']['password'] == $user->password){

                header('Location: ../views/painel');
            }
        }
    }

    public static function logout() {
        session_destroy();
        header('Location:../views/user/login.php');
    }
}

$postActions = array('login', 'logout');

if (isset($_POST['action']) && in_array($_POST['action'], $postActions)) {
    $action = $_POST['action'];
    LoginController::$action();
} else if(isset($_GET['action'])) {
    if ($_GET['action'] == 'logout') {
        LoginController::logout();
    }
}
