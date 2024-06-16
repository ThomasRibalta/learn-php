<?php

namespace App;

/**
 * App : this class is used to manage the application.
 */
class App {
    public static $pdo;
    public static $auth;
    
    /**
     * getPdo : this method is used to get the PDO object.
     *
     * @return PDO
     */
    public static function getPdo() : \PDO {
        if (!self::$pdo) {
            self::$pdo = new \PDO("sqlite:../data.sqlite", null, null, [
                \PDO::ATTR_ERRMODE => \PDO::ERRMODE_EXCEPTION,
                \PDO::ATTR_DEFAULT_FETCH_MODE => \PDO::FETCH_ASSOC
            ]);
        }
        return self::$pdo;
    }
    
    /**
     * getAuth : this method is used to get the Auth object.
     *
     * @return Auth
     */
    public static function getAuth() : Auth {
        if (!self::$auth) {
            self::$auth = new Auth(self::getPdo());
        }
        return self::$auth;
    }
}