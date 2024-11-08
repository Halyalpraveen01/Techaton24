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
    $name = $_POST['name'];
    $email = $_POST['email'];
    $mobile = $_POST['mobile'];
    $dob = $_POST['dob'];
    $password = $_POST['password'];

    // Sanitize input to prevent SQL injection
    $name = $conn->real_escape_string($name);
    $email = $conn->real_escape_string($email);
    $mobile = $conn->real_escape_string($mobile);
    $dob = $conn->real_escape_string($dob);
    $password = $conn->real_escape_string($password);

    // Check if email already exists
    $sql = "SELECT * FROM users WHERE email = '$email'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        echo "Email already exists! Please try a different email.";
    } else {
        // Hash the password before saving it to the database
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);

        // Insert data into the database
        $sql = "INSERT INTO users (name, email, mobile, dob, password) 
                VALUES ('$name', '$email', '$mobile','$dob', '$hashed_password')";

        if ($conn->query($sql) === TRUE) {
            // Store session variables after registration
            $_SESSION['user_name'] = $name;
            $_SESSION['user_email'] = $email;
            $_SESSION['user_mobile'] = $mobile;

            $_SESSION['user_dob'] = $dob;

            echo "Registration successful!";
            header("Location: index.php");  // Redirect to login page
            exit();
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    }
}

// Close connection
$conn->close();
?>
