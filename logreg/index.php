<?php 
// Start the session
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Career Guidance - Login</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>


    <div class="container">


        <!-- Cover Section (Image + Text) -->
        <input type="checkbox" id="flip">
        <div class="cover">
            <div class="front">
                <img src="./frontImg.jpg" alt="">
                <div class="text">
                    <span class="text-1">The Future Depends <br> on what you do today</span>
                    <span class="text-2">Let's get started</span>
                </div>
            </div>
            <div class="back">
                <img class="backImg" src="backimg.jpg" alt="">
                <div class="text">
                    <span class="text-1">Career confusion??<br>sign up here </span>
                    <span class="text-2">Let's get started</span>
                </div>
            </div>
        </div>

        <!-- Forms Section (Login Form) -->
        <div class="forms">
            <div class="form-content">
                <div class="login-form">
                    <div class="title">Login</div>

                    <!-- Login Form -->
                    <form action="login.php" method="POST">
                        <div class="input-boxes">
                            <div class="input-box">
                                <i class="fas fa-envelope"></i>
                                <input type="email" name="email" placeholder="Enter Email Here" required>
                            </div>
                            <div class="input-box">
                                <i class="fas fa-lock"></i>
                                <input type="password" name="password" placeholder="Enter Password Here" required>
                            </div>
                            <!-- Display error message if it exists -->
                            <?php
                            if (isset($_SESSION['login_error'])) {
                                echo '<div class="error-message">' . $_SESSION['login_error'] . '</div>';
                                unset($_SESSION['login_error']); // Clear error message after displaying it
                            }
                            ?>
                            <div class="text"><a href="#">Forgot password?</a></div>
                            <div class="button input-box">
                                <input type="submit" value="Login">
                            </div>
                            <div class="text sign-up-text">Don't have an account? <label for="flip">Sign up now</label></div>
                        </div>
                    </form>
                </div>

                <!-- Signup Form Section (Hidden by Default) -->
                <div class="signup-form">
                    <div class="title">Signup</div>
                    <form action="register.php" method="POST">
                        <div class="input-boxes">
                            <!-- Full Name -->
                            <div class="input-box">
                                <i class="fas fa-user"></i>
                                <input type="text" name="name" placeholder="Enter Full Name" required>
                            </div>
                            <!-- Email -->
                            <div class="input-box">
                                <i class="fas fa-envelope"></i>
                                <input type="email" name="email" placeholder="Enter Email Here" required>
                            </div>
                            <!-- Mobile Number -->
                            <div class="input-box">
                                <i class="fas fa-phone"></i>
                                <input type="text" name="mobile" placeholder="Enter Mobile Number Here" required>
                            </div>
                            <!-- Age -->
                            <!-- Date of Birth -->
                            <div class="input-box">
                                <i class="fas fa-birthday-cake"></i>
                                <input type="date" name="dob" required>
                            </div>
                            <!-- Password -->
                            <div class="input-box">
                                <i class="fas fa-lock"></i>
                                <input type="password" name="password" placeholder="Enter Password Here" required>
                            </div>
                            <!-- Submit Button -->
                            <div class="button input-box">
                                <input type="submit" value="Register">
                            </div>
                            <div class="text sign-up-text">Already have an account? <label for="flip">Login now</label></div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/js/all.min.js"></script>
</body>
</html>
