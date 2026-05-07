<?php
session_start();
include("config.php");

if(isset($_POST['login']))
{
    $email = $_POST['email'];
    $password = $_POST['password'];

    $sql = "SELECT * FROM users WHERE email='$email' AND password='$password'";
    $result = mysqli_query($conn,$sql);

    if(mysqli_num_rows($result) > 0)
    {
        $row = mysqli_fetch_assoc($result);

        $_SESSION['user_id'] = $row['id'];
        $_SESSION['name'] = $row['name'];
        $_SESSION['email'] = $row['email'];

        header("Location: dashboard.php");
    }
    else
    {
        echo "<script>alert('Invalid Email or Password');</script>";
    }
}
?>
<!DOCTYPE html>
<html>
<head>
<link rel="stylesheet" href="style.css">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Login</title>
<style>
body{
background:url('images/bg2.jpg') no-repeat center center fixed;
background-size:cover;
min-height:100vh;
font-family:Arial;
margin:0;
}
input,button{
width:100%;
padding:12px;
margin-top:10px;
box-sizing:border-box;
}
button{
background:#007bff;
color:white;
border:none;
}
h2{text-align:center;color:#007bff;}
</style>
</head>
<body>

<div class="box">
<h2>User Login</h2>

<form method="POST">
<input type="email" name="email" placeholder="Email" required>
<input type="password" name="password" placeholder="Password" required>
<button type="submit" name="login">Login</button>
</form>

</div>

</body>
</html>