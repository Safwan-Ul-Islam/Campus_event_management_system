<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Page</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f2f2f2;
            margin: 0;
            padding: 20px;
        }
        .container {
            width: 80%;
            margin: 20px auto;
            background-color: #fff;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
        }
        h2 {
            text-align: center;
            margin-bottom: 20px;
        }
        .message {
            margin-bottom: 10px;
            padding: 10px;
            border-radius: 5px;
        }
        .error {
            background-color: #f8d7da;
            color: #721c24;
        }
        .success {
            background-color: #d4edda;
            color: #155724;
        }
        .form-group {
            margin-bottom: 15px;
        }
        .form-group label {
            display: block;
            margin-bottom: 5px;
        }
        .form-group input[type="email"],
        .form-group input[type="text"],
        .form-group input[type="password"],
        .form-group select {
            width: 100%;
            padding: 8px;
            box-sizing: border-box;
            border: 1px solid #ccc;
            border-radius: 3px;
        }
        .form-group input[type="submit"] {
            width: auto;
            padding: 8px 16px;
            background-color: #007bff;
            border: none;
            color: #fff;
            border-radius: 3px;
            cursor: pointer;
        }
        .form-group input[type="submit"]:hover {
            background-color: #0056b3;
        }
        .users-list {
            margin-top: 30px;
        }
        .users-list table {
            width: 100%;
            border-collapse: collapse;
        }
        .users-list th, .users-list td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }
        .users-list th {
            background-color: #f2f2f2;
        }
        .actions {
            margin-top: 20px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .pending-list {
            margin-top: 30px;
        }
        .pending-list table {
            width: 100%;
            border-collapse: collapse;
        }
        .pending-list th, .pending-list td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }
        .pending-list th {
            background-color: #f2f2f2;
        }
        .events-list {
            margin-top: 30px;
        }
        .events-list table {
            width: 100%;
            border-collapse: collapse;
        }
        .events-list th, .events-list td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }
        .events-list th {
            background-color: #f2f2f2;
        }
        .attendees-list {
            margin-top: 30px;
        }
        .attendees-list table {
            width: 100%;
            border-collapse: collapse;
        }
        .attendees-list th, .attendees-list td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }
        .attendees-list th {
            background-color: #f2f2f2;
        }
        .logout {
            text-align: right;
            margin-top: 20px;
        }
        .logout a {
            padding: 8px 16px;
            background-color: #dc3545;
            color: #fff;
            text-decoration: none;
            border-radius: 3px;
        }
        .logout a:hover {
            background-color: #c82333;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Welcome, Admin!</h2>

        <!-- Display Messages -->
        <?php
        if (isset($_GET['message']) && isset($_GET['status'])) {
            $message_class = ($_GET['status'] == 'error') ? 'error' : 'success';
            echo '<div class="message ' . $message_class . '">';
            echo htmlspecialchars($_GET['message']);
            echo '</div>';
        }
        ?>

        <!-- Add User Form -->
        <section class="add-user">
            <h3>Add User</h3>
            <form action="admin_actions.php" method="post">
                <div class="form-group">
                    <label for="email">Email:</label>
                    <input type="email" id="email" name="email" required>
                </div>
                <div class="form-group">
                    <label for="name">Name:</label>
                    <input type="text" id="name" name="name" required>
                </div>
                <div class="form-group">
                    <label for="password">Password:</label>
                    <input type="password" id="password" name="password" required>
                </div>
                <div class="form-group">
                    <label for="type">User Type:</label>
                    <select id="type" name="type" required>
                        <option value="student">Student</option>
                        <option value="faculty">Faculty</option>
                        <option value="organizer">Organizer</option>
                        <option value="admin">Admin</option>
                    </select>
                </div>
                <div class="form-group">
                    <input type="submit" name="add_user" value="Add User">
                </div>
            </form>
        </section>

        <!-- Delete User Form -->
        <section class="delete-user">
            <h3>Delete User</h3>
            <form action="admin_actions.php" method="post">
                <div class="form-group">
                    <label for="delete_email">Email:</label>
                    <input type="email" id="delete_email" name="email" required>
                </div>
                <div class="form-group">
                    <input type="submit" name="delete_user" value="Delete User">
                </div>
            </form>
        </section>

       
         <!-- Approve Events Form -->
        <section class="approve-events">
            <h3>Approve Pending Events</h3>
            <form action="approve_event.php" method="post">
                <div class="form-group">
                    <label for="event_id">Event ID:</label>
                    <input type="text" id="event_id" name="event_id" required>
                </div>
                <div class="form-group">
                    <input type="submit" name="approve_event" value="Approve Event">
                </div>
            </form>
        </section>

        
        <!-- pending Events List -->
        <section class="events-list">
            <h3>Pending Events</h3>
            <table>
                <tr>
                    <th>Title</th>
                    <th>Description</th>
                    <th>Date/Time</th>
                    <th>ID</th>
                </tr>
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


                // Query to fetch pending events with organizer details
                $query_pending = "SELECT e.id, e.title, e.description, e.date_time, u.name AS organizer_name
                                  FROM events e
                                  INNER JOIN users u ON e.id = u.id
                                  WHERE e.approved = 0";
                $result_pending = $conn->query($query_pending);

                // Display events
                if ($result_pending->num_rows > 0) {
                    while ($row = $result_pending->fetch_assoc()) {
                        echo '<tr>';
                        echo '<td>' . htmlspecialchars($row['title']) . '</td>';
                        echo '<td>' . htmlspecialchars($row['description']) . '</td>';
                        echo '<td>' . htmlspecialchars($row['date_time']) . '</td>';
                        echo '<td>' . htmlspecialchars($row['id']) . '</td>';
                        echo '</tr>';
                    }
                } else {
                    echo '<tr><td colspan="4">No pending events found.</td></tr>';
                }

                // Close connection
                $conn->close();
                ?>
            </table>
        </section>



        <!-- Approved Events List -->
        <section class="events-list">
            <h3>Approved Events</h3>
            <table>
                <tr>
                    <th>Title</th>
                    <th>Description</th>
                    <th>Date/Time</th>
                </tr>
                <?php
                // Database connection parameters (reuse existing $servername, $username, $password, $dbname)

                // Create connection
                $conn = new mysqli($servername, $username, $password, $dbname);

                // Check connection
                if ($conn->connect_error) {
                    die("Connection failed: " . $conn->connect_error);
                }

                // Query to fetch approved events with organizer details
                $query_approved = "SELECT e.title, e.description, e.date_time, u.name AS organizer_name
                                   FROM events e
                                   INNER JOIN users u ON e.id = u.id
                                   WHERE e.approved = 1";
                $result_approved = $conn->query($query_approved);

                // Display events
                if ($result_approved->num_rows > 0) {
                    while ($row = $result_approved->fetch_assoc()) {
                        echo '<tr>';
                        echo '<td>' . htmlspecialchars($row['title']) . '</td>';
                        echo '<td>' . htmlspecialchars($row['description']) . '</td>';
                        echo '<td>' . htmlspecialchars($row['date_time']) . '</td>';
                        echo '</tr>';
                    }
                } else {
                    echo '<tr><td colspan="4">No approved events found.</td></tr>';
                }

                // Close connection
                $conn->close();
                ?>
            </table>
        </section>


        <!-- Track Attendees Section -->
        <section class="attendees-list">
            <h3>Event Attendees</h3>
            <table>
                <tr>
                    <th>Event Title</th>
                    <th>Attendee Name</th>
                    <th>Email</th>
                    <th>Type</th>
                </tr>
                <?php
                // Database connection parameters (reuse existing $servername, $username, $password, $dbname)

                // Create connection
                $conn = new mysqli($servername, $username, $password, $dbname);

                // Check connection
                if ($conn->connect_error) {
                    die("Connection failed: " . $conn->connect_error);
                }

                // Query to fetch event attendees
                $query_attendees = "SELECT e.title AS event_title, u.name AS attendee_name, u.email AS attendee_email, u.type AS attendee_type
                                   FROM event_registrations er
                                   INNER JOIN events e ON er.event_id = e.id
                                   INNER JOIN users u ON er.user_id = u.id";
                $result_attendees = $conn->query($query_attendees);

                // Display attendees
                if ($result_attendees->num_rows > 0) {
                    while ($row = $result_attendees->fetch_assoc()) {
                        echo '<tr>';
                        echo '<td>' . htmlspecialchars($row['event_title']) . '</td>';
                        echo '<td>' . htmlspecialchars($row['attendee_name']) . '</td>';
                        echo '<td>' . htmlspecialchars($row['attendee_email']) . '</td>';
                        echo '<td>' . htmlspecialchars($row['attendee_type']) . '</td>';
                        echo '</tr>';
                    }
                } else {
                    echo '<tr><td colspan="4">No attendees found.</td></tr>';
                }

                // Close connection
                $conn->close();
                ?>
            </table>
        </section>

        <!-- Logout Button -->
        <div class="logout">
            <a href="logout.php">Logout</a>
        </div>
    </div>
</body>
</html>
