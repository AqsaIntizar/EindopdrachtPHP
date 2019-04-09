<?php
    abstract class Db{
        private static $conn;

        public static function getInstance(){
            if (self::$conn != null){
                //connection found
                echo "😂";
                return self::$conn;
            } else{
                //no connection found, create one!
                $config = parse_ini_file("config/config.ini");
                
                //var_dump($config);
                self::$conn = new PDO('mysql:host=localhost;dbname=includefood;charset=utf8mb4', $config['db_user'], $config['db_password']);
                echo "😎";
                return self::$conn;
            }
        }
    }