<?php
// Start the session
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register - Career Guidance</title>
    <!-- Link to custom stylesheet -->
    <link rel="stylesheet" href="reg.css">
    <link href="https://unpkg.com/ionicons@5.4.0/dist/ionicons.css" rel="stylesheet">
</head>
<body>

    <div class="main">
        <div class="navbar">
            <div class="menu">
                <ul>
                    <li><a href="#">HOME</a></li>
                    <li><a href="#">ABOUT</a></li>
                    <li><a href="#">CONTACT</a></li>
                </ul>
            </div>
        </div> 

        <!-- Registration Form Section -->
        <div class="form">
            <h2>Create Your Account</h2>

            <!-- Display error message if it exists -->
            <?php
            if (isset($_SESSION['register_error'])) {
                echo '<div class="error-message">' . $_SESSION['register_error'] . '</div>';
                unset($_SESSION['register_error']); // Clear error after displaying it
            }
            ?>

            <!-- Registration Form -->
            <form action="register.php" method="POST">
                <!-- Full Name -->
                <input type="text" name="name" placeholder="Enter Full Name Here" required>

                <!-- Email -->
                <input type="email" name="email" placeholder="Enter Email Here" required>

                <!-- Mobile Number -->
                <input type="text" name="mobile" placeholder="Enter Mobile Number Here" required>

                <!-- Age -->
                <input type="number" name="age" placeholder="Enter Your Age Here" required>

                <!-- Date of Birth -->
                <input type="date" name="dob" required>

                <!-- Password -->
                <input type="password" name="password" placeholder="Enter Password Here" required>

                <!-- Register Button -->
                <button class="btnn" type="submit">Register</button>

                <!-- Login Link -->
                <p class="link">Already have an account? <a href="index.php">Login here</a></p>
            </form>
        </div>
    </div>

    <!-- Ionicons Script -->
    <script src="https://unpkg.com/ionicons@5.4.0/dist/ionicons.js"></script>
</body>
</html>
