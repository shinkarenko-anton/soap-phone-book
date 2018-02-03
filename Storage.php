<?php

class Storage
{
    const USERNAME = "root";
    const PASSWORD = "";
    const HOST = "localhost";
    const DB = "soap-phone-book";

    private function getConnection()
    {
        $username = self::USERNAME;
        $password = self::PASSWORD;
        $host = self::HOST;
        $db = self::DB;
        $connection = new PDO("mysql:dbname=$db;host=$host", $username, $password);
        return $connection;
    }

    private function query($sql, $args)
    {
        $connection = $this->getConnection();
        $stmt = $connection->prepare($sql);
        $stmt->execute($args);
        return $stmt;
    }

    public function insert($name, $email, $phone, $address) {

    }

    public function delete($id) {

    }

    public function update($name, $email, $phone, $address) {

    }

    public function getById($id) {

    }

    public function getByName($name) {

    }

    public function getHello($request){
        //in reality, this data would be coming from a database
        $string = "Hello " . serialize($request);
        return $string;

    }

    public function getGoodbye($request){
        //in reality, this data would be coming from a database
        $string = "Goodbye " . serialize($request);
        return $string;
    }
}