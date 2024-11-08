<?php
session_start();


if (!isset($_SESSION['user_email'])) {
    header("Location: index.php");
    exit();
}


$servername = "localhost";  
$username = "root";         
$password = "";             
$dbname = "career_guidance"; 

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Retrieve user information from session
$user_email = $_SESSION['user_email'];

// Get the current user details from the database
$sql = "SELECT name, mobile, dob FROM users WHERE email = '$user_email'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $user = $result->fetch_assoc();
    $user_name = $user['name'];
    $user_mobile = $user['mobile'];
    $user_dob = $user['dob'];
} else {
    echo "No user found with that email.";
    exit();
}

// Handling profile update
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $new_name = $_POST['name'];
    $new_mobile = $_POST['mobile'];
    $new_dob = $_POST['dob'];

    // Sanitize input
    $new_name = mysqli_real_escape_string($conn, $new_name);
    $new_mobile = mysqli_real_escape_string($conn, $new_mobile);
    $new_dob = mysqli_real_escape_string($conn, $new_dob);

    // Update the user information in the database
    $update_sql = "UPDATE users SET name = '$new_name', mobile = '$new_mobile', dob = '$new_dob' WHERE email = '$user_email'";

    if ($conn->query($update_sql) === TRUE) {
        $_SESSION['user_name'] = $new_name;
        $_SESSION['user_mobile'] = $new_mobile;
        $_SESSION['user_dob'] = $new_dob;
        $success_message = "Profile updated successfully!";
    } else {
        $error_message = "Error updating profile: " . $conn->error;
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Profile - Career Guidance</title>
    <!-- Add Bootstrap 4 CDN -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <div class="row">
            <div class="col-md-6 offset-md-3">
                <div class="card">
                    <div class="card-header">
                        <h3>Edit Profile</h3>
                    </div>
                    <div class="card-body">
                        <?php if (isset($success_message)): ?>
                            <div class="alert alert-success"><?php echo $success_message; ?></div>
                        <?php elseif (isset($error_message)): ?>
                            <div class="alert alert-danger"><?php echo $error_message; ?></div>
                        <?php endif; ?>

                        <form action="update_profile.php" method="POST">
                            <div class="form-group">
                                <label for="name">Name</label>
                                <input type="text" class="form-control" id="name" name="name" value="<?php echo htmlspecialchars($user_name); ?>" required>
                            </div>
                            <div class="form-group">
                                <label for="mobile">Mobile</label>
                                <input type="text" class="form-control" id="mobile" name="mobile" value="<?php echo htmlspecialchars($user_mobile); ?>" required>
                            </div>
                            <div class="form-group">
                                <label for="dob">Date of Birth</label>
                                <input type="date" class="form-control" id="dob" name="dob" value="<?php echo htmlspecialchars($user_dob); ?>" required>
                            </div>
                            <button type="submit" class="btn btn-primary">Update Profile</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Bootstrap JS and dependencies -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
</body>
</html>
