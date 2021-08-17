<?php 

class Database {
    public static function connect() {
        $server = 'localhost';
        $username = 'root';
        $password = '';
        $database = 'proyecto_tienda';
        $port = '3306';

        $db = new mysqli($server, $username, $password, $database, $port);
        $db->query("SET NAMES 'utf8'");
        return $db;
    }
}