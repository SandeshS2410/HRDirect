<?php
session_start();

// Check if user is not logged in, redirect to login page
if (!isset($_SESSION["employeeID"])) {
    header("Location: login.html");
    exit();
}

// Include database connection
include_once "db_connection.php";

// Fetch employee details
$employeeID = $_SESSION["employeeID"];
$sql = "SELECT * FROM employees WHERE EmployeeID = '$employeeID'";
$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_assoc($result);

// Fetch salary records
$sql = "SELECT * FROM salary_records WHERE EmployeeID = '$employeeID'";
$salaryResult = mysqli_query($conn, $sql);

// Fetch vacation records
$sql = "SELECT * FROM vacation_records WHERE EmployeeID = '$employeeID'";
$vacationResult = mysqli_query($conn, $sql);

// Close database connection
mysqli_close($conn);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
        <h2>Welcome, <?php echo $row["Name"]; ?>!</h2>
        <!-- Display other dashboard content -->
    </div>
</body>
</html>
