<?php
session_start();
include("config.php");

if(!isset($_SESSION['user_id']))
{
    header("Location: login.php");
}

$from_user = $_SESSION['user_id'];
$to_user = $_GET['user'];

if(isset($_POST['rate']))
{
    $stars = $_POST['stars'];

    mysqli_query($conn,
    "INSERT INTO ratings(from_user,to_user,stars)
     VALUES('$from_user','$to_user','$stars')");

    echo "<script>alert('Rating Submitted');window.location='search.php';</script>";
}
?>

<!DOCTYPE html>
<html>
<head>
<link rel="stylesheet" href="style.css">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Rate User</title>
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
select,button{
width:100%;
padding:12px;
margin-top:12px;
}
button{
background:#007bff;
color:white;
border:none;
}
</style>
</head>
<body>

<div class="box">

<h2>Rate User</h2>

<form method="POST">

<select name="stars" required>
<option value="">Select Rating</option>
<option value="5">⭐⭐⭐⭐⭐ (5)</option>
<option value="4">⭐⭐⭐⭐ (4)</option>
<option value="3">⭐⭐⭐ (3)</option>
<option value="2">⭐⭐ (2)</option>
<option value="1">⭐ (1)</option>
</select>

<button type="submit" name="rate">Submit Rating</button>

</form>

</div>

</body>
</html>