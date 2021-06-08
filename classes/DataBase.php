<?php

class DataBase
{
    protected function connect()
    {
        $pdo = new PDO("mysql:host=librarysystem.cb82keujv05g.us-east-2.rds.amazonaws.com;port=3306;dbname=LibrarySystem", 'admin', '123va321si21_');
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $pdo->exec("set names utf8");
        return $pdo;
    }

    protected function doQuery($query)
    {

        $pdo = $this->connect();
        $stmt = $pdo->query("$query");
        $data = $stmt->fetchAll();
        return $data;
    }
}
