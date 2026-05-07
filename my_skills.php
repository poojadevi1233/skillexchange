<?php
session_start();
include("config.php");

if(!isset($_SESSION['user_id']))
{
    header("Location: login.php");
}

$user_id = $_SESSION['user_id'];

if(isset($_GET['delete']))
{
    $id = $_GET['delete'];

    mysqli_query($conn, "DELETE FROM skills WHERE id='$id' AND user_id='$user_id'");

    header("Location: my_skills.php");
}
?>

<!DOCTYPE html>
<html>
<head>
<link rel="stylesheet" href="style.css">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>My Skills</title>

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
padding:15px 30px;
display:flex;
justify-content:space-between;
}

.navbar a{
color:white;
text-decoration:none;
margin-left:15px;
}

.container{
width:80%;
margin:30px auto;
}

table{
width:100%;
border-collapse:collapse;
background:white;
box-shadow:0 0 10px rgba(0,0,0,0.08);
}

table,th,td{
border:1px solid #ddd;
}

th,td{
padding:12px;
text-align:center;
}

h2{
color:#007bff;
}

.btn{
padding:8px 12px;
background:#dc3545;
color:white;
text-decoration:none;
border-radius:6px;
}
</style>

</head>
<body>

<div class="navbar">
<div><b>Skill Exchange Platform</b></div>

<div>
<a href="dashboard.php">Dashboard</a>
<a href="logout.php">Logout</a>
</div>
</div>

<div class="container">

<h2>My Skills</h2>

<table>
<tr>
<th>ID</th>
<th>Skill Name</th>
<th>Type</th>
<th>Category</th>
<th>Action</th>
</tr>

<?php
$result = mysqli_query($conn, "SELECT * FROM skills WHERE user_id='$user_id'");

while($row = mysqli_fetch_assoc($result))
{
    echo "<tr>
<td>".$row['id']."</td>
<td>".$row['skill_name']."</td>
<td>".$row['type']."</td>
<td>".$row['category']."</td>
<td>
<a class='btn' href='my_skills.php?delete=".$row['id']."' onclick=\"return confirm('Delete this skill?')\">Delete</a>
</td>
</tr>";
}
?>

</table>

</div>

</body>
</html>