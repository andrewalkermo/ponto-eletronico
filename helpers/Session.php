<?php

class Session {

    public static function checkSession() {
        if(session_status() != PHP_SESSION_ACTIVE) {
            session_start();
        }
        session_regenerate_id();
    }

    public static function checkLogin() {
        if(!isset($_SESSION['login'])){
            header('Location:../user/login.php');
        }
    }

    public static function printSessionMessage() {
        if(isset($_SESSION['msg']) && $_SESSION['msg'] != ''){
            echo $_SESSION['msg'];
            $_SESSION['msg'] = '';
        }
    }

    public static function msg() {
        if (isset($_SESSION['msg'])) {
            $msg = '<div  id="session-msg" class="msg' .$_SESSION['msg']. '</div>';
            unset($_SESSION['msg']);
        } else{
            $msg = NULL;
        }
        return $msg;
    }
}
