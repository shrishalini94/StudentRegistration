<?php
require_once "config.php";

if ($_SERVER["REQUEST_METHOD"] === "OPTIONS") {
    header("Access-Control-Allow-Origin: http://localhost:3000");
    header("Access-Control-Allow-Methods: GET");
    header("Access-Control-Allow-Headers: Content-Type");
    exit();
}

if ($_SERVER["REQUEST_METHOD"] === "GET") {
   
    $sql = "SELECT id, name, age, dob FROM students";
    $result = $conn->query($sql);
    // var_dump($result);
    $students = array();
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $students[] = $row;
        }
       
        header("Access-Control-Allow-Origin: http://localhost:3000");
        echo json_encode($students);
    } else {
        header("Access-Control-Allow-Origin: http://localhost:3000");
        echo json_encode(array("message" => "No student data available"));
    }

    $conn->close();
}
?>
