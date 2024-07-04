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

// Check if the form was submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Validate and sanitize input
    $user_id = isset($_POST['user_id']) ? intval($_POST['user_id']) : null; // Assuming user_id is passed via form
    $event_id = isset($_POST['event_id']) ? intval($_POST['event_id']) : null;
    $feedback = isset($_POST['feedback']) ? htmlspecialchars($_POST['feedback']) : '';

    // Ensure user_id is valid (not null or empty)
    if ($user_id && $event_id && $feedback !== '') {
        // Prepare SQL statement for inserting feedback
        $query = "INSERT INTO student_feedback (user_id, event_id, feedback) VALUES (?, ?, ?)";
        $stmt = $conn->prepare($query);

        if ($stmt) {
            // Bind parameters and execute statement
            $stmt->bind_param("iis", $user_id, $event_id, $feedback);
            if ($stmt->execute()) {
                // Feedback submitted successfully
                echo "Feedback submitted successfully.";
                echo '<br><br><a href="javascript:history.go(-1)" class="back-button">Back</a>'; // Back button
            } else {
                // Error executing statement
                echo "Error submitting feedback: " . $stmt->error;
            }
            // Close statement
            $stmt->close();
        } else {
            // Error preparing statement
            echo "Error preparing statement: " . $conn->error;
        }
    } else {
        // Validation failed
        echo "Invalid input data.";
    }
}

// Close connection
$conn->close();
?>
