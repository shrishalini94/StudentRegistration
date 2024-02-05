<?php
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

    if (isset($request->email) && isset($request->password)) {
        $email = $request->email;
        $password = $request->password;

        $sql = "SELECT * FROM login WHERE email='$email' AND password='$password'"; 
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            $user = $result->fetch_assoc();
            header("Access-Control-Allow-Origin: http://localhost:3000");
            echo "Login successful";
        } else {
            header("Access-Control-Allow-Origin: http://localhost:3000");
            echo "Invalid credentials";
        }
    } else {
        header("Access-Control-Allow-Origin: http://localhost:3000");
        echo "Missing email or password in request";
    }
    
    $conn->close();
}
?>
