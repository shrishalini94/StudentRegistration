<?php
require_once "config.php";

// Handle CORS for PUT request
if ($_SERVER["REQUEST_METHOD"] === "OPTIONS") {
    header("Access-Control-Allow-Origin: http://localhost:3000");
    header("Access-Control-Allow-Methods: PUT");
    header("Access-Control-Allow-Headers: Content-Type");
    exit();
}

// Check for ID parameter in the PUT request
if ($_SERVER["REQUEST_METHOD"] === "PUT") {
    $id = $_GET["id"];

    // Get the data from the request body
    $data = json_decode(file_get_contents("php://input"));

    if (isset($id) && isset($data)) {
        $name = $data->name;
        $age = $data->age;
        $date_of_birth = $data->date_of_birth;

        // Update the student's details in the database
        $sql = "UPDATE students SET name = '$name', age = '$age', dob = '$date_of_birth' WHERE id = '$id'";
        if ($conn->query($sql) === TRUE) {
            header("Access-Control-Allow-Origin: http://localhost:3000");
            echo json_encode(array("message" => "Student details updated successfully"));
        } else {
            header("Access-Control-Allow-Origin: http://localhost:3000");
            echo json_encode(array("message" => "Error updating student details: " . $conn->error));
        }
    } else {
        header("Access-Control-Allow-Origin: http://localhost:3000");
        echo json_encode(array("message" => "Invalid data or missing ID"));
    }
}
?>
