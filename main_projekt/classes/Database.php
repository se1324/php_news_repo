<?php

class Database
{
    //skola = mysql:host=mysqlstudenti.litv.sssvt.cz;dbname=4b1_nguyentuananh_db1
    //doma1 = mysql:host=192.168.112.11;dbname=4b1_nguyentuananh_db1
    //doma2 = mysql:host=localhost;dbname=php_news
    private const DSN = 'mysql:host=192.168.112.11;dbname=4b1_nguyentuananh_db1';
    //skola = nguyentuananh
    //doma1 = nguyentuananh
    //doma2 = root
    private const USERNAME = 'nguyentuananh';
    //skola = 123456
    //doma1 = 123456
    //doma2 =
    private const PASSWORD = '123456';

    public $conn = null;

    public function __construct()
    {

        $this->conn = new PDO(self::DSN, self::USERNAME, self::PASSWORD, [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        ]);
        $this->conn->query('SET NAMES utf8');
    }
}