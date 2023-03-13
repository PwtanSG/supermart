<?php

class Connection
{
    public $pdo = null;

    public function __construct()
    {
        try {
            $this->pdo = new PDO('mysql:server=localhost;dbname=spmart', 'root', '');
            // $this->pdo = new PDO('mysql:host=bdd-db.coneblgqjgse.ap-southeast-1.rds.amazonaws.com;dbname=spmart', 'adminbdd', '123456');
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