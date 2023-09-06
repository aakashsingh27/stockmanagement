<?php
@ob_start();
require_once 'config/config.php';
// $action = $_POST['submit'];
if (isset($_SESSION['ibc'])) {
header("location: index.php");
}
if (isset($_POST['admin_login'])) {
$a_email = $_POST['a_email'];
$a_password = md5($_POST['a_password']);
$results = $db->query("SELECT * FROM `user` WHERE username='$a_email' AND password='$a_password'");
$row_select = $results->fetch_object();
$a_name = $row_select->name;
$a_email = $row_select->username;




$whois = $a_name;
// if ($a_name == 'Admin') {
//     $a_name = 'You have';
// } else {
//     $a_name = $a_name . ' has';
// }
$num_rows = $results->num_rows; //mysqli_num_rows($results);
if ($num_rows > 0) {
session_start();
$sid = session_id();
$_SESSION['ibc'] = $sid;
$_SESSION['logintype'] = $row_select->name; // set user type
$_SESSION['a_id'] = $row_select->id;
$_SESSION['a_email'] = $row_select->username;
$_SESSION['a_name'] = $row_select->name;
$db->close();
header("Location:index.php");
exit;
} 
else
{
echo "<script>window.alert('Wrong credentials please try again.');window.location='login.php';</script>";
// header("Location:login.php");
exit;
}
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Stock Management Admin Login</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Custom Styles -->
    <style>
        body {
            background: #e1f0ff;
            background-size: cover;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }

        .login-form {
            max-width: 400px;
            border: 1px solid #dcdcdc;
            border-radius: 10px;
            background-color: #fff;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            padding: 30px;
        }

        .login-form h2 {
            text-align: center;
            margin-bottom: 30px;
           
            color: #333;
        }

        .login-form .form-group {
            margin-bottom: 20px;
        }

        .login-form label {
            font-weight: bold;
        }

        .login-form .btn-login {
            width: 100%;
            padding: 10px;
            border: none;
            border-radius: 5px;
            background-color: #000;
            color: #fff;
            font-size: 18px;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        .login-form .btn-login:hover {
            background-color: #0056b3;
        }

        .login-form .form-control:focus {
            box-shadow: none;
            border-color: #007bff;
        }

        .login-form .form-control::placeholder {
            color: #999;
        }

        .login-form .stock-icon {
            font-size: 40px;
            color: #007bff;
        }
    </style>
</head>

<body>
    <div class="login-form">
        <div class="text-center">
            <i class="bi bi-box stock-icon"></i>
            <h2>Stock Management Admin Login</h2>
        </div>
        <form action="" method="POST">
            <div class="form-group">
                <label for="username">Username</label>
                <input type="text" class="form-control" id="username" name="a_email" placeholder="Enter your username" required>
            </div>
            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" class="form-control" id="password" name="a_password" placeholder="Enter your password" required>
            </div>
            <button type="submit" name="admin_login" class="btn btn-login">Login</button>
        </form>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
