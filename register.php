<?php
include("config.php");

if(isset($_POST['register']))
{
    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $city = $_POST['city'];

    $sql = "INSERT INTO users(name,email,password,city)
            VALUES('$name','$email','$password','$city')";

    if(mysqli_query($conn,$sql))
    {
        echo "<script>
alert('Registration Successful');
window.location='login.php';
</script>";
    }
    else
    {
        echo "<script>alert('Email already exists');</script>";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="style.css">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <style>
        body{
background:url('images/bg2.jpg') no-repeat center center fixed;
background-size:cover;
min-height:100vh;
font-family:Arial;
margin:0;
}

        .box{
            width:400px;
            margin:80px auto;
            background:white;
            padding:30px;
            border-radius:10px;
            box-shadow:0 0 10px #ccc;
        }

        h2{
            text-align:center;
            color:#007bff;
        }

        input{
            width:100%;
            padding:12px;
            margin-top:10px;
            border:1px solid #ccc;
            border-radius:6px;
            box-sizing:border-box;
        }

        button{
            width:100%;
            padding:12px;
            margin-top:15px;
            background:#007bff;
            color:white;
            border:none;
            border-radius:6px;
        }

        button:hover{
            background:#0056b3;
        }
    </style>
</head>
<body>

<div class="box">
<h2>Create Account</h2>

<form method="POST">
    <input type="text" name="name" placeholder="Full Name" required>
    <input type="email" name="email" placeholder="Email" required>
    <input type="password" name="password" placeholder="Password" required>
    <input type="text" name="city" placeholder="City" required>

    <button type="submit" name="register">Register</button>
</form>
<p style="text-align:center; margin-top:15px;">
Already registered?
<a href="login.php">Login Here</a>
</p>

</div>

</body>
</html>