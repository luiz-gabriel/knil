<?php

class DataBase
{
    private static $pdo;

    private static $Host = 'localhost';
    private static $User = 'user';
    private static $Password = '12345';
    private static $DataBase = 'iniki';

    private static function Connect()
    {
        if (self::$pdo == null) {
            try {
                self::$pdo = new \PDO('mysql:host=' . self::$Host . ';dbname=' . self::$DataBase, self::$User, self::$Password,
                    array(\PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"));

                self::$pdo->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);

            } catch (\Exception $e) {
                echo $e;
            }
        }

        return self::$pdo;
    }

    public static function getInstance()
    {
        return self::Connect();
    }


}
