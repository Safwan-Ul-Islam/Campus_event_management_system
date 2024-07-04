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

// Process form data after submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Validate user credentials based on email and password
    // Example query assuming you have a table named 'users' with 'type' column to differentiate between admin, student, faculty, organizer
    $sql = "SELECT * FROM users WHERE email = '$email' AND password = '$password'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        // User found, determine user type
        $user = $result->fetch_assoc();
        $userType = $user['type'];

        // Redirect to corresponding page based on user type
        switch ($userType) {
            case 'admin':
                header("Location: admin_page.php");
                break;
            case 'student':
                header("Location: student_page.php");
                break;
            case 'faculty':
                header("Location: faculty_page.php");
                break;
            case 'organizer':
                header("Location: organizer_page.php");
                break;
            default:
                echo "Unknown user type";
        }
    } else {
        echo "Invalid email or password";
    }
}

// Close connection
$conn->close();
?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Signin Form</title>
    <style>
        body {
            font-family: Arial, sans-serif;
        }
        .container {
            width: 300px;
            margin: 0 auto;
            padding: 20px;
            border: 1px solid #ccc;
            border-radius: 5px;
            box-shadow: 2px 2px 12px rgba(0, 0, 0, 0.1);
        }
        .container h2 {
            text-align: center;
        }
        .form-group {
            margin-bottom: 15px;
        }
        .form-group label {
            display: block;
            margin-bottom: 5px;
        }
        .form-group input[type="email"],
        .form-group input[type="password"] {
            width: 100%;
            padding: 8px;
            box-sizing: border-box;
        }
        .form-group input[type="submit"] {
            width: 100%;
            padding: 10px;
            background-color: #007bff;
            border: none;
            border-radius: 5px;
            color: #fff;    
            font-size: 16px;
            cursor: pointer;
        }
        .form-group input[type="submit"]:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Signin Form</h2>
        <form action="signin.php" method="post">
            <div class="form-group">
                <label for="email">North South Mail Address:</label>
                <input type="email" id="email" name="email" required>
            </div>
            <div class="form-group">
                <label for="password">Password:</label>
                <input type="password" id="password" name="password" required>
            </div>
            <div class="form-group">
                <input type="submit" value="Signin">
            </div>
        </form>
    </div>
</body>
</html>