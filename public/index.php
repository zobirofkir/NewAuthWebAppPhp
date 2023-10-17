<?php
    $username = "admin";
    $password = "admin";

    try {
        $database = new PDO("mysql:host=localhost;dbname=phpAuthentications;charset=utf8", $username, $password);
        // Set PDO error mode to exception
        $database->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    } catch (PDOException $e) {
        echo "Connection failed: " . $e->getMessage();
    }

    require_once "/home/medal/Desktop/phpAuthentications/app/controllers/registerController.php";
    require_once "/home/medal/Desktop/phpAuthentications/app/models/registerModels.php";

    require_once "/home/medal/Desktop/phpAuthentications/app/controllers/logincontroller.php";
    require_once "/home/medal/Desktop/phpAuthentications/app/models/loginModel.php";


    if ($_SERVER["REQUEST_URI"] === "/public/index.php/register" && $_SERVER["REQUEST_METHOD"] === "POST") {
        $PostData = new RegisterPhp($database);
        if ($PostData->RegisterController()) {
            $response = ["success" => true];
            echo json_encode($response);
            return;
        }
    }

    if ($_SERVER["REQUEST_URI"] === "/public/index.php/login" && $_SERVER["REQUEST_METHOD"] === "POST") {
        $PostData = new loginController($database);
        if ($PostData->loginFormData()) {
            $response = ["success" => true];
            echo json_encode($response);
            return;
        }
    }

?>
