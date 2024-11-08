<?php
// Start the session to access session variables
session_start();

// Check if the user is logged in by checking session variables
if (!isset($_SESSION['user_name'])) {
    // If the user is not logged in, redirect to the login page
    header("Location: index.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Account - Career Guidance</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container mt-5">
        <div class="row">
            <div class="col-md-3 d-none d-md-block">
                <div class="list-group">
                    <a href="#" class="list-group-item list-group-item-action active">Dashboard</a>
                    <a href="account.php" class="list-group-item list-group-item-action">My Account</a>
                    <a href="change_password.php" class="list-group-item list-group-item-action">Change Password</a>
                    <a href="update_profile.php" class="list-group-item list-group-item-action">Edit Profile</a>
                    <a href="logout.php" class="list-group-item list-group-item-action">Logout</a>
                </div>
            </div>

            <div class="col-md-9">
                <div class="card">
                    <div class="card-header">
                        <h2>Welcome, <?php echo htmlspecialchars($_SESSION['user_name']); ?>!</h2>
                    </div>
                    <div class="card-body">
                        <h5 class="card-title">Your Account Details</h5>
                        <p><strong>Email:</strong> <?php echo htmlspecialchars($_SESSION['user_email']); ?></p>
                        <p><strong>Mobile:</strong> <?php echo htmlspecialchars($_SESSION['user_mobile']); ?></p>
                        <p><strong>Date of Birth:</strong> <?php echo htmlspecialchars($_SESSION['user_dob']); ?></p>

                        <a href="update_profile.php" class="btn btn-primary">Edit Profile</a>
                        <a href="change_password.php" class="btn btn-warning">Change Password</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
</body>
</html>
