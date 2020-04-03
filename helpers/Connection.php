<?php

class Connection {

    public static function connect() {
        try {
            $url = parse_url(getenv("CLEARDB_DATABASE_URL"));

            $server = $url["host"];
            $username = $url["user"];
            $password = $url["pass"];
            $db = substr($url["path"], 1);

            $pdo = new PDO("mysql:host=".$server.";dbname=".$db,$username,$password, [PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"]);
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            return $pdo;
        }
        catch (PDOException $e) {
            echo $e->getMessage();
        }
    }
}
