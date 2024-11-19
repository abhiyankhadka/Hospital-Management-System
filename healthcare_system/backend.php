<?php // strict

// Database connection parameters
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "healthcare_system";

// Create a connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Handle patient registration
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action']) && $_POST['action'] === 'register') {
    
    // Sanitize user input
    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $age = (int) $_POST['age']; // Ensure the age is treated as an integer
    $gender = mysqli_real_escape_string($conn, $_POST['gender']);
    
    // Prepare the SQL statement (using prepared statements to prevent SQL injection)
    $stmt = $conn->prepare("INSERT INTO patients (name, age, gender) VALUES (?, ?, ?)");
    
    // Check if the prepared statement is successfully created
    if (!$stmt) {
        die("Error in preparing the SQL statement: " . $conn->error);
    }
    
    // Bind parameters ('s' = string, 'i' = integer)
    $stmt->bind_param("sis", $name, $age, $gender); // 's' for string, 'i' for integer
    
    // Execute the statement
    if ($stmt->execute()) {
        echo "Patient registered successfully";
    } else {
        echo "Error: " . $stmt->error;
    }

    // Close the prepared statement
    $stmt->close();
}

// Close the connection
$conn->close();
?>
