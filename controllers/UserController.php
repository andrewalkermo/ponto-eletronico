<?php
// require_once(__DIR__.'/../helpers/Session.php');
// require_once(__DIR__.'/../helpers/Clearance.php');
require_once(__DIR__.'/../models/Users.php');
// Session::checkSession();

class UserController {

    public static function create() {
        if($_POST['password'] != ''){
            $_REQUEST['password'] = password_hash($_POST['password'] , PASSWORD_DEFAULT);
        }
        if (empty($_POST['level']) || isset($_POST['level'])) {
            $_POST['level'] = 1;
        }
        if ($_POST['email'] != '' && $_POST['type'] != '' &&  $_POST['password'] != ''  &&  $_POST['level'] != '' ) {
            $user = new User($_REQUEST);
            try {
                $user->create();
                $_SESSION['msg'] = 'success"><i class="fa fa-check" fa-3x aria-hidden="true"></i>&nbsp Usuário criado com sucesso!';
            }
            catch(PDOException $e) {
                $_SESSION['msg'] = 'fail"><i class="fa fa-times" fa-3x aria-hidden="true"></i>&nbsp Erro ao cadastrar Usuário';
            }
        }
        header('Location:../views/user/index.php');
    }

    public static function update() {
        if ($_POST['email'] != '') {
            if (empty($_POST['level']) || isset($_POST['level'])) {
                $_POST['level'] = 1;
            }
            $user = new User($_POST);
            try {
                $user->update();
                $_SESSION['msg'] = 'success"><i class="fa fa-check" fa-3x aria-hidden="true"></i>&nbsp Usuário editado com sucesso!';
            }
            catch(PDOException $e) {
                $_SESSION['msg'] = 'fail"><i class="fa fa-times" fa-3x aria-hidden="true"></i>&nbsp Erro ao editar usuário!';
            }
        }
        header('Location:../views/user/index.php');
    }

    // public static function changePassword() {
    //     if ($_POST['oldPassword'] != '' && $_POST['password'] != '') {
    //         $user = User::readUser($_REQUEST['id']);
    //         if(password_verify($_POST['oldPassword'],$user->password)){
    //             $user = new User($_REQUEST);
    //             try{
    //                 $user->password = password_hash($user->password , PASSWORD_DEFAULT);
    //                 $user->changePassword($user->id);
    //                 $_SESSION['msg'] = 'success"><i class="fa fa-check" fa-3x aria-hidden="true"></i>&nbsp Senha trocada com sucesso!';
    //             }
    //             catch(PDOException $e) {
    //                 $_SESSION['msg'] = 'fail"><i class="fa fa-times" fa-3x aria-hidden="true"></i>&nbsp Erro ao trocar senha!';
    //             }
    //         }
    //         else{
    //             $_SESSION['msg'] = 'fail"><i class="fa fa-times" fa-3x aria-hidden="true"></i>&nbsp Senha Incorreta!';
    //         }
    //         header('Location:../views/user/index.php');
    //     }
    // }

    // public static function recoverPassword() {
    //     if($_POST['password'] != ''){
    //         try{
    //             $user = User::readUser($_REQUEST['id']);
    //             $user = new User($_REQUEST);
    //             $user->password = password_hash($_POST['password'] , PASSWORD_DEFAULT);
    //             $user->changePassword($_GET['id']);
    //             $_SESSION['msg'] = 'success"><i class="fa fa-check" fa-3x aria-hidden="true"></i>&nbsp Sucesso ao recuperar senha!';
    //         }
    //         catch(pdoexception $e) {
    //             $_SESSION['msg'] = 'fail"><i class="fa fa-times" fa-3x aria-hidden="true"></i>&nbsp Erro ao recuperar senha!';
    //         }
    //     }
    //     header('Location:../views/user/login.php');
    // }

    public static function delete() {
        if (!empty($_GET['delete']) &&  $_GET['delete'] == $_SESSION['id'] || !empty($_GET['delete']) && Clearance::checkLevel($_SESSION['level'], Clearance::ADM)) {
            try {
                User::delete($_GET['delete']);
                $_SESSION['msg'] = 'success"><i class="fa fa-check" fa-3x aria-hidden="true"></i>&nbsp Usuário deletado com sucesso!';
            }
            catch(PDOException $e) {
                $_SESSION['msg'] = 'fail"><i class="fa fa-times" fa-3x aria-hidden="true"></i>&nbsp Erro ao deletar usuário!';
            }
        } else{
            $_SESSION['msg'] = 'fail"><i class="fa fa-times" fa-3x aria-hidden="true"></i>&nbsp Senha Incorreta!';
            echo $_SESSION['msg'];
        }
        header('Location: ../views/user/index.php');
    }

    public static function selectUser($column, $value) {
        if (!empty($column) && !empty($value)) {
            try {
                $user = User::readUser($column, $value);
                return $user;
            }
            catch (PDOException $e) {

                $_SESSION['msg'] = 'fail"><i class="fa fa-times" fa-3x aria-hidden="true"></i>&nbsp Falha ao ler um usuário.';
                var_dump($e);die;

            }
        }
    }

    public static function selectAllUsers() {
        try {
            $users = User::readAllUsers();
            $_SESSION['msg'] = 'success"><i class="fa fa-check" fa-3x aria-hidden="true"></i>&nbsp Todos os usuários foram lidos com sucesso.';
            return $users;
        }
        catch (pdoexception $e) {
            $_SESSION['msg'] = 'fail"><i class="fa fa-times" fa-3x aria-hidden="true"></i>&nbsp Falha ao ler todos os usuários.';
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
