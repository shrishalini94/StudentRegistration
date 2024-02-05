<?php
require_once "config.php";

// Handle CORS for POST request
if ($_SERVER["REQUEST_METHOD"] === "OPTIONS") {
    header("Access-Control-Allow-Origin: http://localhost:3000");
    header("Access-Control-Allow-Methods: POST");
    header("Access-Control-Allow-Headers: Content-Type");
    exit();
}

// Check for POST data
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $postdata = file_get_contents("php://input");
    $request = json_decode($postdata);

    if (isset($request->name) && isset($request->age) && isset($request->date_of_birth)) {
        $name = $request->name;
        $age = $request->age;
        $date_of_birth = $request->date_of_birth;

        $sql = "INSERT INTO students (id,name, age, dob) VALUES (NULL, '$name', '$age', '$date_of_birth')";
        if ($conn->query($sql) === TRUE) {
            header("Access-Control-Allow-Origin: http://localhost:3000");
            echo "Student added successfully";
        } else {
            header("Access-Control-Allow-Origin: http://localhost:3000");
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    } else {
        header("Access-Control-Allow-Origin: http://localhost:3000");
        echo "Missing data in the request";
    }

    $conn->close();
}
?>
