<?php

namespace Config {

    class Database
    {
        static function getConnection(): \PDO
        {
            $env = parse_ini_file(".env.database");

            $host = $env["DB_HOST"];
            $port = $env["DB_PORT"];
            $database = $env["DB_NAME"];
            $username = $env["DB_USERNAME"];
            $password = $env["DB_PASSWORD"];

            return new \PDO("mysql:host=$host:$port;dbname=$database", $username, $password);
        }
    }
}
