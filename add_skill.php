<?php
session_start();
include("config.php");

if(!isset($_SESSION['user_id']))
{
    header("Location: login.php");
}

if(isset($_POST['save']))
{
    $user_id = $_SESSION['user_id'];
    $skill = $_POST['skill'];
    $type = $_POST['type'];
    $category = $_POST['category'];

    $sql = "INSERT INTO skills(user_id,skill_name,type,category)
VALUES('$user_id','$skill','$type','$category')";

    mysqli_query($conn,$sql);

    echo "<script>alert('Skill Added Successfully');</script>";
}
?>

<!DOCTYPE html>
<html>
<head>
<link rel="stylesheet" href="style.css">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Add Skills</title>

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
padding:15px;
color:white;
display:flex;
justify-content:space-between;
}

.navbar a{
color:white;
text-decoration:none;
margin-left:15px;
}

.box{
width:450px;
background:white;
margin:80px auto;
padding:30px;
border-radius:10px;
box-shadow:0 0 10px #ccc;
}

input,select,button{
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

h2{
text-align:center;
color:#007bff;
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

<div class="box">

<h2>Add Skill</h2>

<form method="POST">

<input type="text" name="skill" placeholder="Enter Skill Name" required>

<select name="type" required>
<option value="">Select Type</option>
<option value="teach">I Can Teach</option>
<option value="learn">I Want to Learn</option>
</select>
<select name="category" required>
<option value="">Select Category</option>
<option value="Coding">Coding</option>
<option value="English">English</option>
<option value="Design">Design</option>
<option value="Music">Music</option>
<option value="Fitness">Fitness</option>
<option value="Business">Business</option>
</select>

<button type="submit" name="save">Save Skill</button>

</form>

</div>

</body>
</html>