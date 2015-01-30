<?php
/**
 * Created by PhpStorm.
 * User: michal
 * Date: 17.11.14
 * Time: 16:42
 */

class Database {
    private static $connection;
    private static $options = array(
        PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING,
        PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES 'utf8'",
        PDO::ATTR_EMULATE_PREPARES => false);
    public static function openConnection($host, $user, $passw, $database)
    {
        if (!isset(self::$connection)) {
            self::$connection = @new PDO(
                "mysql:host=$host;dbname=$database",
                $user,
                $passw,
                self::$options
            );
        }
    }
    public static function queryOne($query, $params = array()) {
        $return = self::$connection->prepare($query);
        $return->execute($params);
        return $return->fetch();
    }
    public static function queryAll($query, $params = array()) {
        $return = self::$connection->prepare($query);
        $return->execute($params);
        return $return->fetchAll();
    }
    public static function queryOneOne($query, $params = array()) {
        $return = self::queryOne($query, $params);
        return $return[0];
    }
    public static function query($query, $params = array()) {
        $return = self::$connection->prepare($query);
        $return->execute($params);
        return $return->rowCount();
    }
}