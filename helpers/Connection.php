<?php

class Connection {

    public static function connect() {
        try {
            $conf = [];
            foreach (file(__DIR__.'/../database/db_connection.conf') as $line) {
                list($key, $value) = explode(':', $line, 2) + [NULL, NULL];
                $conf[trim($key)] = trim($value);
            }
            $pdo = new PDO("mysql:host=".$conf['host'].";dbname=".$conf['name'],$conf['user'],$conf['password'], [PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"]);
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            return $pdo;
        }
        catch (PDOException $e) {
            echo $e->getMessage();
        }
    }
}
