<?php
// Database connection parameters
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "healthcare_system";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Handle patient registration
if ($_POST['action'] == 'register') {
    $name = $_POST['name'];
    $age = $_POST['age'];
    $gender = $_POST['gender'];

    $sql = "INSERT INTO patients (name, age, gender) VALUES ('$name', '$age', '$gender')";

    if ($conn->query($sql) === TRUE) {
        echo "Patient registered successfully";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

$conn->close();
?>
