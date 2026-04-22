<?php
session_start();

if(isset($_POST['login']))
{
    $username = $_POST['username'];
    $password = $_POST['password'];

    if($username == "admin" && $password == "12345")
    {
        $_SESSION['admin'] = true;
        header("Location: index.php");
    }
    else
    {
        echo "<script>alert('Invalid Admin Login');</script>";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
<title>Admin Login</title>

<style>
body{
font-family:Arial;
background:#f4f6f9;
}

.box{
width:400px;
margin:100px auto;
background:white;
padding:30px;
border-radius:10px;
box-shadow:0 0 10px #ccc;
}

input,button{
width:100%;
padding:12px;
margin-top:10px;
box-sizing:border-box;
}

button{
background:#343a40;
color:white;
border:none;
}

h2{
text-align:center;
}
</style>

</head>
<body>

<div class="box">

<h2>Admin Login</h2>

<form method="POST">
<input type="text" name="username" placeholder="Username" required>
<input type="password" name="password" placeholder="Password" required>

<button type="submit" name="login">Login</button>
</form>

</div>

</body>
</html>