<?php
// index.php - Login Page
session_start();
include('db.php');
$error = '';

// If user is already logged in, redirect to dashboard
if(isset($_SESSION['admin_id'])){
    header("location: dashboard.php");
    exit;
}

if($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $password = md5($_POST['password']); // Using md5 for simplicity, consider stronger hashing for production

    $sql = "SELECT id FROM admin WHERE username = '$username' and password = '$password'";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
    
    $count = mysqli_num_rows($result);
      
    if($count == 1) {
        $_SESSION['admin_id'] = $row['id'];
        header("location: dashboard.php");
    } else {
        $error = "Your Login Name or Password is invalid";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login - GPMS</title>
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
            max-width: 400px;
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
        .cta-btn1 {
            display: inline-block;
            padding: 10px 20px;
            margin-top: 10px;
            font-size: 16px;
            background-color: #6c757d;
            color: #ffffff;
            text-decoration: none;
            border-radius: 5px;
            transition: background-color 0.3s;
        }
        .cta-btn1:hover {
            background-color: #5a6268;
            color: #ffffff;
        }
    </style>
</head>
<body>
    <div class="login-container">
        <div class="login-card text-center">
            <h2>GPMS</h2>
            <p>Gate Pass Management System</p>
            <h5 class="my-4">Admin Login</h5>
            <form action="" method="post">
                <div class="form-floating mb-3">
                    <input type="text" class="form-control" id="username" name="username" placeholder="Username" required>
                    <label for="username">Username</label>
                </div>
                <div class="form-floating mb-3">
                    <input type="password" class="form-control" id="password" name="password" placeholder="Password" required>
                    <label for="password">Password</label>
                </div>

                <?php if($error != ''): ?>
                    <div class="alert alert-danger" role="alert">
                        <?php echo $error; ?>
                    </div>
                <?php endif; ?>

                <button type="submit" class="btn btn-primary w-100 py-2 mt-3">Login</button>
                
                <div class="mt-3">
                    <p>Don't have an account? <a href="register.php" class="btn-link">Register here</a></p>
                </div>
                
                <a href="./index.html" class="cta-btn1">Home Page</a>
            </form>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>