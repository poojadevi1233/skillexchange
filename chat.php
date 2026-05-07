<?php
session_start();
include("config.php");

if(!isset($_SESSION['user_id']))
{
    header("Location: login.php");
    exit();
}

$me = $_SESSION['user_id'];
$other = $_GET['user'];

if(isset($_POST['send']))
{
    $msg = $_POST['message'];

    mysqli_query($conn,
    "INSERT INTO messages(sender_id,receiver_id,message)
    VALUES('$me','$other','$msg')");
}
$uid = $_SESSION['user_id'];

$nresult = mysqli_query($conn,
"SELECT COUNT(*) as total FROM notifications
WHERE user_id='$uid' AND status=0");

$nrow = mysqli_fetch_assoc($nresult);

$notify_count = $nrow['total'];
?>

<!DOCTYPE html>
<html>
<head>
<title>Chat</title>
<link rel="stylesheet" href="style.css">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<style>
body{
background:url('images/bg2.jpg') no-repeat center center fixed;
background-size:cover;
min-height:100vh;
font-family:Arial;
margin:0;
}

.navbar{
background:#007bff;
color:white;
padding:15px 20px;
display:flex;
justify-content:space-between;
flex-wrap:wrap;
}

.navbar a{
color:white;
text-decoration:none;
margin-left:15px;
font-weight:bold;
}

.box{
width:90%;
max-width:700px;
margin:30px auto;
background:white;
padding:20px;
border-radius:12px;
box-shadow:0 0 10px rgba(0,0,0,0.1);
}

.msg{
padding:10px;
margin:8px 0;
background:#eee;
border-radius:8px;
}

.me{
background:#d1ecf1;
text-align:right;
}

textarea{
width:100%;
height:80px;
padding:10px;
box-sizing:border-box;
margin-top:15px;
}

button{
padding:10px 20px;
margin-top:10px;
background:#007bff;
color:white;
border:none;
border-radius:6px;
cursor:pointer;
}

button:hover{
background:#0056b3;
}

h2{
margin-top:0;
}

@media(max-width:768px){

.navbar{
flex-direction:column;
align-items:flex-start;
}

.navbar div:last-child{
margin-top:10px;
}

.navbar a{
display:block;
margin:8px 0;
}
}
</style>
</head>

<body>

<div class="navbar">

<div><b>Skill Exchange Platform</b></div>

<div>
<a href="dashboard.php">Dashboard</a>
<a href="search.php">Search</a>
<a href="inbox.php">Inbox</a>
<a href="logout.php">Logout</a>
</div>

</div>

<div class="box">

<h2>Chat</h2>

<?php
$result = mysqli_query($conn,
"SELECT * FROM messages
WHERE (sender_id='$me' AND receiver_id='$other')
OR (sender_id='$other' AND receiver_id='$me')
ORDER BY id ASC");

while($row = mysqli_fetch_assoc($result))
{
    $class = ($row['sender_id']==$me) ? "msg me" : "msg";

    echo "<div class='$class'>".$row['message']."</div>";
}
?>

<form method="POST">
<textarea name="message" required placeholder="Type message..."></textarea>
<button type="submit" name="send">Send</button>
</form>

</div>

</body>
</html>