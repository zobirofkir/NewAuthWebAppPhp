<?php
class CreateTable{
    private $database;

    public function __construct()
    {
        $username = "admin";
        $password = "admin";
    
        try {
            $this->database = new PDO("mysql:host=localhost;dbname=phpAuthentications;charset=utf8", $username, $password);
            // Set PDO error mode to exception
            $this->database->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            echo "Connected successfully";
        } catch (PDOException $e) {
            echo "Connection failed: " . $e->getMessage();
        }
    
    }

    public function CreateUserTable(){
        $CreateTable = "CREATE TABLE User (
            id INT PRIMARY KEY AUTO_INCREMENT NOT NULL,
            username VARCHAR(255) NOT NULL,
            email VARCHAR(255) NOT NULL,
            password VARCHAR(255) NOT NULL
        )";
        $this->database->exec($CreateTable);
        echo "User table created successfully.";
    }
}

// Usage
$tableCreator = new CreateTable();
$tableCreator->CreateUserTable();
?>
