<?php
session_start();

// Database connection parameters
$servername = "localhost";
$username = "your_username";
$password = "your_password";
$database = "hr_management";

// Create connection
$conn = mysqli_connect($servername, $username, $password, $database);

// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $employeeID = $_POST["employeeID"];
    $password = $_POST["password"];

    // Sanitize inputs
    $employeeID = mysqli_real_escape_string($conn, $employeeID);
    $password = mysqli_real_escape_string($conn, $password);

    // Perform SQL query to check if credentials are valid
    $sql = "SELECT * FROM employees WHERE EmployeeID = '$employeeID' OR Email = '$employeeID'";
    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) == 1) {
        $row = mysqli_fetch_assoc($result);
        if (password_verify($password, $row["Password"])) {
            $_SESSION["employeeID"] = $row["EmployeeID"];
            header("Location: dashboard.php");
            exit();
        } else {
            echo json_encode(["success" => false, "message" => "Invalid credentials"]);
        }
    } else {
        echo json_encode(["success" => false, "message" => "Invalid credentials"]);
    }
}

mysqli_close($conn);
?>
