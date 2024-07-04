<?php
// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Validate inputs
    $event_id = $_POST['event_id'];

    // Validate if event_id is provided
    if (empty($event_id)) {
        die("Error: Event ID is required.");
    }

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

    // Start session to get student_id or faculty_id
    session_start();
    $user_id = $_SESSION['student_id']; // Replace with your actual session variable for students
    // Or
    $user_id = $_SESSION['faculty_id']; // Replace with your actual session variable for faculty

    // Check if the user is a student or faculty
    if (isset($_SESSION['student_id'])) {
        $user_type = 'student';
    } elseif (isset($_SESSION['faculty_id'])) {
        $user_type = 'faculty';
    } else {
        die("Error: User session not found.");
    }

    // Delete registration from the database
    $query_cancel_registration = "DELETE FROM event_registrations WHERE event_id = ? AND user_id = ? AND user_type = ?";
    $stmt_cancel_registration = $conn->prepare($query_cancel_registration);
    $stmt_cancel_registration->bind_param("iis", $event_id, $user_id, $user_type);

    if ($stmt_cancel_registration->execute()) {
        echo "Registration canceled successfully.";
    } else {
        echo "Error: " . $stmt_cancel_registration->error;
    }

    // Close statement and connection
    $stmt_cancel_registration->close();
    $conn->close();
} else {
    // If the form is not submitted, redirect or handle as needed
    die("Error: Form submission method not allowed.");
}
?>
