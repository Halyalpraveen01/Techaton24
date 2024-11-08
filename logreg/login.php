<?php
// Start the session
session_start();

// Database connection parameters
$servername = "localhost";  
$username = "root";         
$password = "";             
$dbname = "career_guidance"; 

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if the form was submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get form data
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Sanitize input to prevent SQL injection
    $email = $conn->real_escape_string($email);
    $password = $conn->real_escape_string($password);

    // Check if user exists
    $sql = "SELECT * FROM users WHERE email = '$email'";
    $result = $conn->query($sql);

    if ($result->num_rows == 1) {
        // Fetch user data
        $user = $result->fetch_assoc();
        // Verify password
        if (password_verify($password, $user['password'])) {
            // Store session variables
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['user_name'] = $user['name'];
            $_SESSION['user_email'] = $user['email'];
            $_SESSION['user_mobile'] = $user['mobile'];
            $_SESSION['user_dob'] = $user['dob'];

            // Redirect to college data page
            header("Location: clgnames.php");
            exit();
        } else {
            // Invalid password
            $_SESSION['login_error'] = "Invalid password. Please try again.";
            header("Location: index.php");
            exit();
        }
    } else {
        // No user found with that email
        $_SESSION['login_error'] = "No user found with that email.";
        header("Location: index.php");
        exit();
    }
}

// Close connection
$conn->close();
?>
