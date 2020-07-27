<?php


namespace App\Services;


class db
{
    public function connect(){
        $mysqli = new \mysqli('127.0.0.1', 'root', '123', 'webinar');

        if (mysqli_connect_error()) {
            die('Ошибка подключения (' . mysqli_connect_errno() . ') '
                . mysqli_connect_error());
        }

        if (!$mysqli) {
            echo "Ошибка: Невозможно установить соединение с MySQL." . PHP_EOL;
            echo "Код ошибки errno: " . mysqli_connect_errno() . PHP_EOL;
            echo "Текст ошибки error: " . mysqli_connect_error() . PHP_EOL;
            exit;
        }

        return $mysqli;
    }

}