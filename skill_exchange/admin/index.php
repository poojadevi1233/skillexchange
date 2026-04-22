<?php
session_start();

if(!isset($_SESSION['admin']))
{
    header("Location: login.php");
    exit();
}

include("../config.php");
?>

<!DOCTYPE html>
<html>
<head>
<title>Admin Panel</title>

<style>
body{
margin:0;
font-family:Arial;
background:#f4f6f9;
}

.navbar{
background:#343a40;
color:white;
padding:15px 30px;
}

.container{
width:90%;
margin:30px auto;
}

.card{
background:white;
padding:20px;
border-radius:10px;
box-shadow:0 0 10px rgba(0,0,0,0.08);
margin-bottom:20px;
}

table{
width:100%;
border-collapse:collapse;
background:white;
}

table,th,td{
border:1px solid #ddd;
}

th,td{
padding:12px;
text-align:center;
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
<h2>Admin Panel</h2>
<a href="logout.php" style="color:white;float:right;">Logout</a>
</div>

<div class="container">

<div class="card">

<?php
$total = mysqli_num_rows(mysqli_query($conn,"SELECT * FROM users"));
echo "<h3>Total Users: $total</h3>";
?>

</div>

<table>

<tr>
<th>ID</th>
<th>Name</th>
<th>Email</th>
<th>City</th>
<th>Action</th>
</tr>

<?php
$result = mysqli_query($conn,"SELECT * FROM users");

while($row = mysqli_fetch_assoc($result))
{
echo "<tr>
<td>".$row['id']."</td>
<td>".$row['name']."</td>
<td>".$row['email']."</td>
<td>".$row['city']."</td>
<td>
<a class='btn' href='delete_user.php?id=".$row['id']."'>Delete</a>
</td>
</tr>";
}
?>

</table>

</div>

</body>
</html>