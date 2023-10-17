<?php
    class RegisterModel{
        private $database;

        public function __construct($database)
        {
            $this->database = $database;
        }

        public function InsertIntoData($username, $email, $password) {
            $ExectingEmail = "SELECT COUNT(*) FROM User WHERE email=:email";
            $ExecEmail = $this->database->prepare($ExectingEmail);
            $ExecEmail->bindParam(":email", $email);
            $ExecEmail->execute();
        
            if ($ExecEmail->fetchColumn() > 0) {
                return false; // Email already exists
            } else {
                $InsertData = "INSERT INTO User(username, email, password) VALUES (:username, :email, :password)";
                $InsertDataExec = $this->database->prepare($InsertData);
                $InsertDataExec->bindParam(":username", $username);
                $InsertDataExec->bindParam(":email", $email);
                $InsertDataExec->bindParam(":password", $password);
                $InsertDataExec->execute();
                return true; // Success
            }
        }        
    }
?>