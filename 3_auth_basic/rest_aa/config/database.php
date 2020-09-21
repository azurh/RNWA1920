<?php

class Database
{
    // specify your own database credentials
    private $host = "localhost:8889";
    private $db_name = "hr";
    private $username = "azur";
    private $password = "azur";
    private $conn;

    // get the database connection
    public function getConnection()
    {

        $this->conn = null;

        try {
            $this->conn = new PDO("mysql:host=" . $this->host . ";dbname=" . $this->db_name, $this->username, $this->password);
            $this->conn->exec("set names utf8");
        } catch (PDOException $exception) {
            echo "Connection error: " . $exception->getMessage();
        }

        $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        return $this->conn;
    }
}

function require_aa()
{
    if (!isset($_SERVER['PHP_AUTH_USER'])) {
        header('WWW-Authenticate: Basic realm="Basic"');
        header('HTTP/1.0 401 Unauthorized');
        echo json_encode(array("error" => "Unathorized"));
        exit;
    } elseif ($_SERVER['PHP_AUTH_USER'] != 'azur' || $_SERVER['PHP_AUTH_PW'] != 'azur') {
        header('HTTP/1.0 403 Forbidden');
        echo json_encode(array("error" => "Forbidden"));
        exit;
    }
}
