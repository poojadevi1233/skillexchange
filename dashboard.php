<?php
session_start();
include("config.php");

if(!isset($_SESSION['user_id']))
{
    header("Location: login.php");
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
<link rel="stylesheet" href="style.css">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Dashboard</title>

<style>
 body.other{
background:url('images/bg2.jpg') no-repeat center center fixed !important;
background-size:cover !important;
min-height:100vh;
}

.navbar{
background:#007bff;
color:white;
padding:15px 30px;
display:flex;
justify-content:space-between;
align-items:center;
}

.navbar a{
color:white;
text-decoration:none;
margin-left:15px;
font-weight:bold;
}

.container{
width:90%;
margin:auto;
padding:30px 0;
}

.welcome{
background:white;
padding:25px;
border-radius:12px;
box-shadow:0 0 10px rgba(0,0,0,0.08);
margin-bottom:25px;
}

.welcome h1{
margin:0;
color:#007bff;
}

.grid{
display:grid;
grid-template-columns:repeat(auto-fit,minmax(220px,1fr));
gap:20px;
}

.card{
background:white;
padding:25px;
border-radius:12px;
box-shadow:0 0 10px rgba(0,0,0,0.08);
text-align:center;
transition:0.3s;
}

.card:hover{
transform:translateY(-5px);
}

.card h3{
margin-top:0;
color:#333;
}

.card a{
display:inline-block;
margin-top:10px;
padding:10px 16px;
background:#007bff;
color:white;
text-decoration:none;
border-radius:8px;
}
</style>

</head>
<body class="other">

<div class="navbar">
<div><b>Skill Exchange Platform</b></div>

<div>
<a href="dashboard.php">Dashboard</a>
<a href="inbox.php">Inbox</a>
<a href="notifications.php">🔔 Notifications (<?php echo $notify_count; ?>)</a>
<a href="logout.php">Logout</a>
</div>
</div>

<div class="container">

<div class="welcome">
<h1>Welcome, <?php echo $_SESSION['name']; ?> 🎉</h1>
<p>Email: <?php echo $_SESSION['email']; ?></p>
<p>Manage your skills and connect with learners.</p>
</div>

<div class="grid">

<div class="card">
<h3>My Profile</h3>
<p>View and update your profile details.</p>
<a href="profile.php">Open</a>
</div>

<div class="card">
<h3>Add Skills</h3>
<p>Add skills you can teach or want to learn.</p>
<a href="add_skill.php">Open</a>
</div>

<div class="card">
<h3>My Skills</h3>
<p>View and delete your added skills.</p>
<a href="my_skills.php">Open</a>
</div>

<div class="card">
<h3>Search Users</h3>
<p>Find users by skill name.</p>
<a href="search.php">Open</a>
</div>

<div class="card">
<h3>My Requests</h3>
<p>View exchange requests.</p>
<a href="my_requests.php">Open</a>
</div>

<div class="card">
<h3>Logout</h3>
<p>Securely sign out from account.</p>
<a href="logout.php">Logout</a>
</div>

</div>

</div>

</body>
</html>