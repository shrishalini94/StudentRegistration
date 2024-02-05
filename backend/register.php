
<?php


error_reporting(E_ALL);
ini_set('display_errors', 1);
require_once "config.php";

if ($_SERVER["REQUEST_METHOD"] === "OPTIONS") {
    header("Access-Control-Allow-Origin: http://localhost:3000");
    header("Access-Control-Allow-Methods: POST");
    header("Access-Control-Allow-Headers: Content-Type");
    exit();
}

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $postdata = file_get_contents("php://input");
    $request = json_decode($postdata);

    if (isset($request->name) && isset($request->email) && isset($request->password)) {
        $name = $request->name;
        $email = $request->email;
        $password = $request->password; 

        $sql = "INSERT INTO login (no, name, email, password) VALUES (NULL, '$name', '$email', '$password')";

        if ($conn->query($sql) === TRUE) {
            header("Access-Control-Allow-Origin: http://localhost:3000");
            echo json_encode("Registration successful");

        } else {
            header("Access-Control-Allow-Origin: http://localhost:3000");
            echo json_encode("Error registering: " . $conn->error);
        }
    } else {
        header("Access-Control-Allow-Origin: http://localhost:3000");
        echo json_encode("Missing name, email, or password in request");
    }
}

$conn->close();
?>







