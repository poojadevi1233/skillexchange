<?php
session_start();
include("config.php");

if(!isset($_SESSION['user_id']))
{
    header("Location: login.php");
    exit();
}

$me = $_SESSION['user_id'];
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
<title>Inbox</title>
<link rel="stylesheet" href="style.css">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<style>
body{
font-family:Arial;
background:#f4f6f9;
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

.container{
width:90%;
max-width:900px;
margin:30px auto;
}

.box{
background:white;
padding:20px;
border-radius:12px;
box-shadow:0 0 10px rgba(0,0,0,0.1);
}

.user{
padding:15px;
border-bottom:1px solid #ddd;
display:flex;
justify-content:space-between;
align-items:center;
flex-wrap:wrap;
}

.btn{
background:#007bff;
color:white;
padding:8px 14px;
text-decoration:none;
border-radius:6px;
}

.btn:hover{
background:#0056b3;
}

h2{
margin-top:0;
}

@media(max-width:768px){
.user{
flex-direction:column;
align-items:flex-start;
gap:10px;
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
<a href="logout.php">Logout</a>
</div>

</div>

<div class="container">

<div class="box">

<h2>Inbox</h2>

<?php
$sql = "SELECT DISTINCT users.id, users.name
FROM messages
JOIN users ON users.id =
CASE
WHEN messages.sender_id='$me' THEN messages.receiver_id
ELSE messages.sender_id
END
WHERE messages.sender_id='$me' OR messages.receiver_id='$me'";

$result = mysqli_query($conn, $sql);

if(mysqli_num_rows($result) > 0)
{
    while($row = mysqli_fetch_assoc($result))
    {
        echo "<div class='user'>
        <div>".$row['name']."</div>
        <div>
        <a class='btn' href='chat.php?user=".$row['id']."'>Open Chat</a>
        </div>
        </div>";
    }
}
else
{
    echo "<p>No conversations yet.</p>";
}
?>

</div>

</div>

</body>
</html>