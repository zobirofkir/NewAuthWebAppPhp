<?php
class RegisterPhp {
    private $database;

    public function __construct($database) {
        $this->database = $database;
    }

    public function RegisterController() {
        if ($_SERVER["REQUEST_METHOD"] === "POST") {
            $data = file_get_contents("php://input");
            $array = json_decode($data, true);
    
            if (isset($array["username"]) &&
                isset($array["email"]) &&
                isset($array["password"])
            ) {
                $username = htmlspecialchars($array["username"], FILTER_SANITIZE_SPECIAL_CHARS);
                $email = htmlspecialchars($array["email"], FILTER_SANITIZE_EMAIL);
                $password = htmlspecialchars($array["password"], FILTER_SANITIZE_SPECIAL_CHARS);
    
                // Hash the password
                $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
    
                $InsertIntoModel = new RegisterModel($this->database);
                if ($InsertIntoModel->InsertIntoData($username, $email, $hashedPassword)) {
                    $response = ["success" => true];
                    echo json_encode($response);
                    return;
                } else {
                    $response = ["success" => false];
                    echo json_encode($response);
                    return;
                }
            }
        }
    }    
}
?>
