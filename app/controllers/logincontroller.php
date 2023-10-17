<?php
    class loginController{
        private $database;

        public function __construct($database)
        {
            $this->database = $database;
        }
        public function loginFormData() {
            if ($_SERVER["REQUEST_METHOD"] === "POST") {
                $data = file_get_contents("php://input");
                $array = json_decode($data, true);
        
                if (isset($array["email"]) && isset($array["password"])) {
                    $email = filter_var($array["email"], FILTER_SANITIZE_EMAIL);
                    $password = $array["password"];
                    
                    // Create an instance of the LoginModel class and call the login method
                    $loginModel = new LoginModel($this->database);
                    $loginResult = $loginModel->login($email, $password);
        
                    echo json_encode(["success" => $loginResult]);
                    return;
                }
            }
        }
    }
?>