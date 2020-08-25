<?php


namespace App\Services;

final class db
{
    private $host = '127.0.0.1';
    private $user = 'root';
    private $pass = '123';
    private $dbname = 'webinar';
    private $connect;
    private static $instance = null;

    protected function __clone() { }
    public function __wakeup()
    {
        throw new \Exception("Cannot unserialize a singleton.");
    }

    private function __construct(){

        $this->connect = new \mysqli(
            $this->host,
            $this->user,
            $this->pass,
            $this->dbname
        );

        if (mysqli_connect_error()) {
            die('Ошибка подключения (' . mysqli_connect_errno() . ') '
                . mysqli_connect_error());
        }

        if (!$this->connect ) {
            echo "Ошибка: Невозможно установить соединение с MySQL." . PHP_EOL;
            echo "Код ошибки errno: " . mysqli_connect_errno() . PHP_EOL;
            echo "Текст ошибки error: " . mysqli_connect_error() . PHP_EOL;
            exit;
        }
    }


    public static function getInstance() : db{

        if(!self::$instance)
        {
            self::$instance = new db();
        }

        return self::$instance;
    }

    public function getConnection()
    {
        return $this->connect;
    }
}