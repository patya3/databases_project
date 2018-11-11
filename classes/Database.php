<?php

class Database {

    public static $host = "127.0.0.1";
    public static $db_name = "tv_guide";
    public static $username = "root";
    public static $password = "";

    private static $con;

    public function __construct() {
        if (self::$con == null)
            self::$con = new mysqli(self::$host, self::$username, self::$password, self::$db_name);
            if (self::$con->connect_errno) {
                die("Failed to connect to the database ". self::$con->connect_errno);
            }
            self::$con->set_charset("utf8");
    }

    /*public static function connect() {
        if (self::$con !== null) {
            self::$con = new mysqli(self::$host, self::$username, self::$password, self::$db_name);
            if (self::$con->connect_errno) {
                die("Failed to connect to the database ". self::$con->connect_errno);
            }
            self::$con->set_charset("utf8");
        }
    }*/

    public static function stmt_query($query, $types, $params = array()) {
        $a_params = array();
        $a_params[] = $types;
        foreach ($params as &$p) {
            $a_params[] = &$p;
        }

        $statement = self::$con->prepare($query);
        call_user_func_array(array($statement, 'bind_param'), $a_params);
        $statement->execute();

        if (explode(' ',$query)[0] == 'SELECT') {
            $result = $statement->get_result();
            $data = $result->fetch_assoc();

            $result->close();
            $statement->close();

            return $data;
        }
    }

    public static function query($query) {
        $result = self::$con->query($query);
        $data = array();
        while ($row = $result->fetch_assoc()) {
            $data[] = $row;
        }
        $result->close();
        return $data;
    }
}