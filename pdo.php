<?php

class Connection
{
    public $pdo = null;

    public function __construct()
    {
        try {
            $this->pdo = new PDO('mysql:server=localhost;dbname=spmart', 'root', '');
            $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $exception) {
            echo "ERROR: " . $exception->getMessage();
        }

    }

    public function getProducts()
    {
        $statement = $this->pdo->prepare("SELECT * FROM products ORDER BY productid ASC");
        $statement->execute();
        return $statement->fetchAll(PDO::FETCH_ASSOC);
    }


    public function getProductById($id)
    {
        $statement = $this->pdo->prepare("SELECT * FROM products WHERE productid = :id");
        $statement->bindValue('id', $id);
        $statement->execute();
        return $statement->fetch(PDO::FETCH_ASSOC);
    }
}

return new Connection();