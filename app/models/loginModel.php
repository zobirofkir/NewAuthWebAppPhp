<?php
class LoginModel {
    private $database;

    public function __construct($database) {
        $this->database = $database;
    }

    public function login($email, $password) {
        // First, retrieve the hashed password from the database
        $storedPasswordHash = $this->getPasswordHash($email);

        if ($storedPasswordHash !== false) {
            // Verify the input password against the stored hash
            if (password_verify($password, $storedPasswordHash)) {
                return true;
            }
        }

        return false;
    }

    public function getPasswordHash($email) {
        // Query the database for the hashed password associated with the email
        $postData = "SELECT password FROM User WHERE email = :email";
        $stmt = $this->database->prepare($postData);
        $stmt->bindParam(":email", $email);
        $stmt->execute();
        $result = $stmt->fetch();

        if ($result) {
            return $result['password'];
        } else {
            return false;
        }
    }
}
?>
