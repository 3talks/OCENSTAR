<?php
// Connect to database
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "package_tracking";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Escape user input for security
$username = $conn->real_escape_string($_POST['username']);
$password = $conn->real_escape_string($_POST['password']);

// Retrieve user information from the database
$sql = "SELECT * FROM users WHERE username='$username'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();

    // Compare passwords using a secure method
    if (password_verify($password, $row['password'])) {
        // Successful login
        session_start();
        $_SESSION['username'] = $username;
        header("Location: php/admin.php");  // Redirect to home page
    } else {
        // Incorrect password
        echo "Invalid username or password.";
    }
} else {
    // User not found
    echo "Invalid username or password.";
}

$conn->close();
?>
