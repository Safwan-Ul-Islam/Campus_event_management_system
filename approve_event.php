<?php
// Assuming $_POST['approve_event'] form submission with 'event_id'

if (isset($_POST['approve_event'])) {
    $event_id = $_POST['event_id'];

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

    // Prepare and execute SQL statement to update approved status
    $sql = "UPDATE events SET approved = 1 WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $event_id);

    if ($stmt->execute()) {
        // Event approved successfully
        $message = "Event approved successfully.";
        $status = "success";
    } else {
        // Error approving event
        $message = "Error approving event: " . $conn->error;
        $status = "error";
    }

    // Close statement and connection
    $stmt->close();
    $conn->close();

    // Redirect back to admin_page.php with status message
    header("Location: admin_page.php?message=" . urlencode($message) . "&status=" . $status);
    exit();
}
?>
