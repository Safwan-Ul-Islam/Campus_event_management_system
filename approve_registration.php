<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Approve Event Registration</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f0f0f0;
            margin: 0;
            padding: 20px;
        }
        .container {
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
    <div class="container">
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
        $event_id = $_POST['event_id'];
        $student_id = $_POST['student_id']; // This assumes you have a student_id in event_registrations table

        // Update event_registrations to mark as approved (set approved = 1)
        $stmt = $conn->prepare("UPDATE event_registrations SET approved = 1 WHERE event_id = ? AND user_id = ?");
        $stmt->bind_param("ii", $event_id, $student_id);

        // Execute SQL statement
        if ($stmt->execute()) {
            echo "Registration approved successfully.";
        } else {
            echo "Error approving registration: " . $conn->error;
        }

        // Close statement and connection
        $stmt->close();
        $conn->close();
        ?>
        
        <!-- Back button -->
        <div class="back-button-container">
            <button class="back-button" onclick="goBack()">Go Back</button>
        </div>
    </div>

    <script>
        function goBack() {
            window.history.back();
        }
    </script>
</body>
</html>
