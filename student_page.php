
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Page</title>
    <link rel="stylesheet" href="student.css"> <!-- Link to your CSS file -->
    <style>
        /* Additional inline styles if needed */
    </style>
</head>
<body>
    <div class="container">
    <?php
// Ensure you have the student ID from somewhere, e.g., from a login process or another form of authentication
$student_id = 1; // Replace with the actual student ID, or retrieve it from your application's logic

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
?>

    </style>
</head>
<body>
    
        <div class="logout-btn">
            <form action="logout.php" method="post">
                <button type="submit">Logout</button>
            </form>
        </div>
        <h2>Welcome to Student Page</h2>

        <!-- Display upcoming events -->
        <div class="event-list">
            <h3>Upcoming Events</h3>
            
            <?php
            // Query upcoming events
            $query_events = "SELECT id, title, date_time, description FROM events WHERE date_time > NOW() ORDER BY date_time";
            $result_events = $conn->query($query_events);

            if ($result_events->num_rows > 0) {
                while ($row = $result_events->fetch_assoc()) {
                    echo '<div class="event-item">';
                    echo '<h4>' . htmlspecialchars($row['title']) . '</h4>';
                    echo '<p><strong>Event ID:</strong> ' . htmlspecialchars($row['id']) . '</p>'; // Display Event ID
                    echo '<p><strong>Date:</strong> ' . htmlspecialchars($row['date_time']) . '</p>';
                    echo '<p><strong>Description:</strong><br>' . htmlspecialchars($row['description']) . '</p>';
                    echo '<form action="register_event.php" method="post">';
                    echo '<input type="hidden" name="event_id" value="' . $row['id'] . '">';
                    echo '<input type="submit" value="Register">';
                    echo '</form>';
                    echo '</div>';
                }
            } else {
                echo '<p>No upcoming events.</p>';
            }

            // Close connection
            $conn->close();
            ?>
        </div>

        <!-- Submit Feedback Section -->
        <h2>Submit Feedback</h2>
        <form action="submit_feedback.php" method="post">
            <input type="hidden" name="user_id" value="<?php echo $student_id; ?>"> <!-- Use PHP to insert actual student ID -->
            <div>
                <label for="event_id">Event ID:</label>
                <input type="text" id="event_id" name="event_id" required>
            </div>
            <div>
                <label for="feedback">Feedback:</label>
                <textarea id="feedback" name="feedback" rows="4" required></textarea>
            </div>
            <div>
                <input type="submit" value="Submit Feedback">
            </div>
        </form>

        <!-- Display registered events -->
        <div class="registered-events">
            <h3></h3>
            <?php
            // Reconnect to database for registered events section
            $conn = new mysqli($servername, $username, $password, $dbname);
            if ($conn->connect_error) {
                die("Connection failed: " . $conn->connect_error);
            }

            // Query registered events for the student
            $query_registered_events = "SELECT events.title, events.date_time, events.description
                                        FROM events
                                        INNER JOIN event_registrations ON events.id = event_registrations.event_id
                                        WHERE event_registrations.user_id = ? AND event_registrations.user_type = 'student'
                                        ORDER BY events.date_time";
            $stmt_registered_events = $conn->prepare($query_registered_events);
            $stmt_registered_events->bind_param("i", $student_id); // Bind student_id
            $stmt_registered_events->execute();
            $result_registered_events = $stmt_registered_events->get_result();

            if ($result_registered_events->num_rows > 0) {
                while ($row = $result_registered_events->fetch_assoc()) {
                    echo '<div class="event-item">';
                    echo '<h4>' . htmlspecialchars($row['title']) . '</h4>';
                    echo '<p><strong>Date:</strong> ' . htmlspecialchars($row['date_time']) . '</p>';
                    echo '<p><strong>Description:</strong><br>' . htmlspecialchars($row['description']) . '</p>';
                    echo '</div>';
                }
            } else {
                echo '<p></p>';
            }

            // Close statement and connection
            $stmt_registered_events->close();
            $conn->close();
            ?>
        </div>
    </div>
</body>
</html>

    </div>
</body>
</html>

