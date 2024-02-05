<?php
require_once "config.php";

// Handle CORS for DELETE request
if ($_SERVER["REQUEST_METHOD"] === "OPTIONS") {
    header("Access-Control-Allow-Origin: http://localhost:3000");
    header("Access-Control-Allow-Methods: DELETE");
    header("Access-Control-Allow-Headers: Content-Type");
    exit();
}

// Check for ID parameter in the DELETE request
if ($_SERVER["REQUEST_METHOD"] === "DELETE") {
    $id = $_GET["id"];

    if (isset($id)) {
        $sql = "DELETE FROM students WHERE id = '$id'";
        if ($conn->query($sql) === TRUE) {
            header("Access-Control-Allow-Origin: http://localhost:3000");
            echo "Student deleted successfully";
        } else {
            header("Access-Control-Allow-Origin: http://localhost:3000");
            echo "Error deleting student: " . $conn->error;
        }
    } else {
        header("Access-Control-Allow-Origin: http://localhost:3000");
        echo "Missing ID parameter in request";
    }
}
?>
