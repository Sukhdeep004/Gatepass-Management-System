<?php
// register.php - Admin Registration Page
session_start();
include('db.php');
$error = '';
$success = '';

// If user is already logged in, redirect to dashboard
if(isset($_SESSION['admin_id'])){
    header("location: dashboard.php");
    exit;
}

if($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    
    // Validation
    if(strlen($username) < 4) {
        $error = "Username must be at least 4 characters long";
    } elseif(strlen($password) < 6) {
        $error = "Password must be at least 6 characters long";
    } elseif($password !== $confirm_password) {
        $error = "Passwords do not match";
    } else {
        // Check if username already exists
        $check_sql = "SELECT id FROM admin WHERE username = '$username'";
        $check_result = mysqli_query($conn, $check_sql);
        
        if(mysqli_num_rows($check_result) > 0) {
            $error = "Username already exists. Please choose another.";
        } else {
            // Insert new admin
            $hashed_password = md5($password);
            $insert_sql = "INSERT INTO admin (username, password, email) VALUES ('$username', '$hashed_password', '$email')";
            
            if(mysqli_query($conn, $insert_sql)) {
                $success = "Registration successful! You can now login.";
            } else {
                $error = "Registration failed. Please try again.";
            }
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Registration - GPMS</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #bdcebe;
        }
        .login-container {
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        .login-card {
            width: 100%;
            max-width: 450px;
            padding: 40px;
            border-radius: 15px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.1);
            background-color: #fff;
        }
        .login-card h2 {
            font-weight: 700;
            color: #333;
        }
        .login-card p {
            color: #666;
        }
        .btn-link {
            color: #0d6efd;
            text-decoration: none;
        }
        .btn-link:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <div class="login-container">
        <div class="login-card text-center">
            <h2>GPMS</h2>
            <p>Gate Pass Management System</p>
            <h5 class="my-4">Admin Registration</h5>
            <form action="" method="post">
                <div class="form-floating mb-3">
                    <input type="text" class="form-control" id="username" name="username" placeholder="Username" required>
                    <label for="username">Username</label>
                </div>
                <div class="form-floating mb-3">
                    <input type="email" class="form-control" id="email" name="email" placeholder="Email" required>
                    <label for="email">Email Address</label>
                </div>
                <div class="form-floating mb-3">
                    <input type="password" class="form-control" id="password" name="password" placeholder="Password" required>
                    <label for="password">Password</label>
                </div>
                <div class="form-floating mb-3">
                    <input type="password" class="form-control" id="confirm_password" name="confirm_password" placeholder="Confirm Password" required>
                    <label for="confirm_password">Confirm Password</label>
                </div>

                <?php if($error != ''): ?>
                    <div class="alert alert-danger" role="alert">
                        <?php echo $error; ?>
                    </div>
                <?php endif; ?>

                <?php if($success != ''): ?>
                    <div class="alert alert-success" role="alert">
                        <?php echo $success; ?>
                    </div>
                <?php endif; ?>

                <button type="submit" class="btn btn-primary w-100 py-2 mt-3">Register</button>
                
                <div class="mt-3">
                    <p>Already have an account? <a href="index.php" class="btn-link">Login here</a></p>
                </div>
                
                <a href="./index.html" class="btn btn-secondary mt-2">Back to Home</a>
            </form>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>