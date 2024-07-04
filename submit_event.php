<?php
// Database connection parameters
$servername = "localhost";
$username = 'root'; // Replace with your MySQL username
$password = ''; // Replace with your MySQL password
$dbname = "327"; // Replace with your database name

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Retrieve form data
$title = $_POST['title'];
$description = $_POST['description'];
$date_time = $_POST['date_time'];

// Prepare SQL statement to insert event
$stmt = $conn->prepare("INSERT INTO events (title, description, date_time, approved) VALUES (?, ?, ?, 0)");
$stmt->bind_param("sss", $title, $description, $date_time);

// Execute SQL statement
if ($stmt->execute()) {
    echo "Event submitted for approval successfully.";
    echo '<br><br><a href="javascript:history.go(-1)" class="back-button">Back</a>'; // Back button
} else {
    echo "Error submitting event: " . $conn->error;
}

// Close statement and connection
$stmt->close();
$conn->close();
?>
