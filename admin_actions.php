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

// Handle add user action
if (isset($_POST['add_user'])) {
    $email = $_POST['email'];
    $name = $_POST['name'];
    $password = $_POST['password']; // Admin-set password
    $type = $_POST['type'];

    // Check if the user already exists
    $check_query = "SELECT * FROM users WHERE email = ?";
    $stmt_check = $conn->prepare($check_query);
    $stmt_check->bind_param("s", $email);
    $stmt_check->execute();
    $check_result = $stmt_check->get_result();

    if ($check_result->num_rows > 0) {
        header("Location: admin_page.php?message=User already exists&status=error");
        exit();
    }

    // Insert the user into the users table (without password hashing)
    $insert_query = "INSERT INTO users (email, name, password, type) VALUES (?, ?, ?, ?)";
    $stmt_insert = $conn->prepare($insert_query);
    $stmt_insert->bind_param("ssss", $email, $name, $password, $type);

    if ($stmt_insert->execute()) {
        header("Location: admin_page.php?message=User added successfully&status=success");
        exit();
    } else {
        header("Location: admin_page.php?message=Error adding user: " . $conn->error . "&status=error");
        exit();
    }
}


// Handle delete user action
if (isset($_POST['delete_user'])) {
    $email = $_POST['email'];

    // Delete the user from the users table
    $delete_query = "DELETE FROM users WHERE email = ?";
    $stmt_delete = $conn->prepare($delete_query);
    $stmt_delete->bind_param("s", $email);

    if ($stmt_delete->execute()) {
        header("Location: admin_page.php?message=User deleted successfully&status=success");
        exit();
    } else {
        header("Location: admin_page.php?message=Error deleting user: " . $conn->error . "&status=error");
        exit();
    }
}

// Close connection
$conn->close();
?>
