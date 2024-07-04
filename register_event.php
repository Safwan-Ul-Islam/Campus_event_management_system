<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register for Event</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f0f0f0;
            margin: 0;
            padding: 20px;
        }
        form {
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            max-width: 400px;
            margin: 0 auto;
        }
        label, input {
            display: block;
            margin-bottom: 10px;
        }
        input[type="submit"] {
            padding: 10px;
            background-color: #007bff;
            border: none;
            border-radius: 5px;
            color: #fff;
            font-size: 16px;
            cursor: pointer;
        }
        input[type="submit"]:hover {
            background-color: #0056b3;
        }
        .back-button-container {
            margin-top: 20px;
            text-align: center;
        }
        .back-button {
            padding: 10px 20px;
            background-color: #28a745;
            border: none;
            border-radius: 5px;
            color: #fff;
            font-size: 16px;
            cursor: pointer;
        }
        .back-button:hover {
            background-color: #218838;
        }
    </style>
</head>
<body>
    <form action="register_event.php" method="post">
        <label for="event_id">Event ID:</label>
        <input type="text" id="event_id" name="event_id" required><br><br>

        <label for="email">Email:</label>
        <input type="email" id="email" name="email" required><br><br>

        <input type="submit" value="Register">
    </form>

    <!-- Back button -->
    <div class="back-button-container">
        <button class="back-button" onclick="goBack()">Go Back</button>
    </div>

    <script>
        function goBack() {
            window.history.back();
        }
    </script>
</body>
</html>

<?php
// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Validate inputs
    $event_id = $_POST['event_id'];
    $email = $_POST['email']; // Adjust based on your form input names

    // Validate if event_id and email are provided
    if (empty($event_id) || empty($email)) {
        die("Error: Event ID and Email are required.");
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

    // Check if the user exists as a student or faculty
    $query_check_user = "SELECT id, type FROM users WHERE email = ?";
    $stmt_check_user = $conn->prepare($query_check_user);
    $stmt_check_user->bind_param("s", $email);
    $stmt_check_user->execute();
    $result_check_user = $stmt_check_user->get_result();

    if ($result_check_user->num_rows === 0) {
        die("Error: User with provided email not found.");
    }

    // Fetch user information
    $user_row = $result_check_user->fetch_assoc();
    $user_id = $user_row['id'];
    $user_type = $user_row['type'];

    // Validate if the user type is allowed to register for events
    if ($user_type !== 'student' && $user_type !== 'faculty') {
        die("Error: Only students and faculty can register for events.");
    }

    // Check if the user is already registered for the event
    $query_check_registration = "SELECT * FROM event_registrations WHERE event_id = ? AND user_id = ?";
    $stmt_check_registration = $conn->prepare($query_check_registration);
    $stmt_check_registration->bind_param("ii", $event_id, $user_id);
    $stmt_check_registration->execute();
    $result_check_registration = $stmt_check_registration->get_result();

    if ($result_check_registration->num_rows > 0) {
        die("Error: You are already registered for this event.");
    }

    // Insert registration into the database
    $query_register_event = "INSERT INTO event_registrations (event_id, user_id, user_type) VALUES (?, ?, ?)";
    $stmt_register_event = $conn->prepare($query_register_event);
    $stmt_register_event->bind_param("iis", $event_id, $user_id, $user_type);

    if ($stmt_register_event->execute()) {
        echo "Registration successful. You will receive a notification.";
        // Optionally, send a notification to the user (email, SMS, etc.)
    } else {
        echo "Error: " . $stmt_register_event->error;
    }

    // Close statements and connection
    $stmt_check_user->close();
    $stmt_check_registration->close();
    $stmt_register_event->close();
    $conn->close();
} else {
    // If the form is not submitted, redirect or handle as needed
    die("Error: Form submission method not allowed.");
}
?>
