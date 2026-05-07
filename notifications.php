<?php
session_start();
include("config.php");

if(!isset($_SESSION['user_id']))
{
header("Location: login.php");
exit();
}

$uid = $_SESSION['user_id'];

$result = mysqli_query($conn,
"SELECT * FROM notifications
WHERE user_id='$uid'
ORDER BY id DESC");

mysqli_query($conn,
"UPDATE notifications SET status=1 WHERE user_id='$uid'");
?>

<!DOCTYPE html>
<html>
<head>
<link rel="stylesheet" href="style.css">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Notifications</title>
<style>
body{
background:url('images/bg2.jpg') no-repeat center center fixed;
background-size:cover;
min-height:100vh;
font-family:Arial;
margin:0;
}
.box{
width:90%;
max-width:700px;
margin:30px auto;
background:white;
padding:20px;
border-radius:10px;
}
.item{
padding:12px;
border-bottom:1px solid #ddd;
}
</style>
</head>
<body>

<div class="box">

<h2>Notifications</h2>

<?php
while($row = mysqli_fetch_assoc($result))
{
echo "<div class='item'>".$row['message']."</div>";
}
?>

</div>

</body>
</html>