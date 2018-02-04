<?php

class Storage
{
    const USERNAME = "root";
    const PASSWORD = '';
    const HOST = "localhost";
    const DB = "soap-phone-book";
    public $connection;
    public $connError;

    public function __construct()
    {
        $username = self::USERNAME;
        $password = self::PASSWORD;
        $host = self::HOST;
        $db = self::DB;
        try {
            $this->connection = new PDO("mysql:host=$host;dbname=$db", $username, $password);
        } catch (PDOException $e) {
            //$this->connection = null;
            $this->connError = $e->getMessage();
        }
    }

    public function insertData($name, $email, $phone, $address)
    {
        /*$name = $request['name'];
        $email = $request['email'];
        $phone = $request['phone'];
        $address = $request['address'];*/

        $sql = "INSERT INTO `phone-book` (`name`, `email`, `phone`, `address`) VALUES (:name, :email, :phone, :address)";

        $statement = $this->connection->prepare($sql);

        $statement->bindValue(':name', $name);
        $statement->bindValue(':email', $email);
        $statement->bindValue(':phone', $phone);
        $statement->bindValue(':address', $address);

        $inserted = $statement->execute();
        return $inserted;
    }

    public function delete($id)
    {

    }

    public function update($name, $email, $phone, $address)
    {

    }

    public function getById($id)
    {

    }

    public function getAll()
    {
        $sth = $this->connection->prepare("SELECT * FROM `phone-book`");
        $sth->execute();
        $result = $sth->fetchAll();
        return $result;
    }

    public function getByName($name)
    {

    }

    public function getHello($request)
    {
        //in reality, this data would be coming from a database
        $string = "Hello " . serialize($request);
        return $string;

    }

    public function getGoodbye($request)
    {
        //in reality, this data would be coming from a database
        $string = "Goodbye " . serialize($request);
        return $string;
    }
}