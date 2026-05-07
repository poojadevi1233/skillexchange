<?php
session_start();
include("config.php");

$uid = $_SESSION['user_id'];

$nresult = mysqli_query($conn,
"SELECT COUNT(*) as total FROM notifications
WHERE user_id='$uid' AND status=0");

$nrow = mysqli_fetch_assoc($nresult);

$notify_count = $nrow['total'];
if(!isset($_SESSION['user_id']))
{
    header("Location: login.php");
}

$user_id = $_SESSION['user_id'];

if(isset($_POST['update']))
{
    $name  = $_POST['name'];
    $email = $_POST['email'];
    $city  = $_POST['city'];

    $image_name = "";

    if($_FILES['image']['name'] != "")
    {
        $image_name = time() . "_" . $_FILES['image']['name'];
        $tmp = $_FILES['image']['tmp_name'];

        move_uploaded_file($tmp, "images/".$image_name);

        $sql = "UPDATE users 
                SET name='$name', email='$email', city='$city', image='$image_name'
                WHERE id='$user_id'";
    }
    else
    {
        $sql = "UPDATE users 
                SET name='$name', email='$email', city='$city'
                WHERE id='$user_id'";
    }

    mysqli_query($conn,$sql);

    $_SESSION['name'] = $name;
    $_SESSION['email'] = $email;

    echo "<script>alert('Profile Updated Successfully');</script>";
}

$sql = "SELECT * FROM users WHERE id='$user_id'";
$result = mysqli_query($conn,$sql);
$row = mysqli_fetch_assoc($result);
?>

<!DOCTYPE html>
<html>
<head>
<link rel="stylesheet" href="style.css">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>My Profile</title>

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

.box{
width:520px;
margin:40px auto;
background:white;
padding:30px;
border-radius:12px;
box-shadow:0 0 10px rgba(0,0,0,0.08);
}

h2{
text-align:center;
color:#007bff;
}

.profile-img{
width:120px;
height:120px;
border-radius:50%;
object-fit:cover;
display:block;
margin:0 auto 15px;
border:3px solid #007bff;
}

input{
width:100%;
padding:12px;
margin-top:10px;
box-sizing:border-box;
}

button{
width:100%;
padding:12px;
margin-top:15px;
background:#007bff;
color:white;
border:none;
border-radius:8px;
}
</style>

</head>
<body>

<div class="navbar">
<div><b>Skill Exchange Platform</b></div>

<div>
<a href="dashboard.php">Dashboard</a>
<a href="inbox.php">Inbox</a>
<a href="notifications.php">🔔 <?php echo $notify_count; ?></a>
<a href="logout.php">Logout</a>
</div>
</div>

<div class="box">

<h2>My Profile</h2>

<?php
if($row['image'] != "")
{
    echo "<img src='images/".$row['image']."' class='profile-img'>";
}
else
{
    echo "<img src='https://via.placeholder.com/120' class='profile-img'>";
}
?>

<form method="POST" enctype="multipart/form-data">

<input type="text" name="name" value="<?php echo $row['name']; ?>" required>

<input type="email" name="email" value="<?php echo $row['email']; ?>" required>

<input type="text" name="city" value="<?php echo $row['city']; ?>" required>

<input type="file" name="image">

<button type="submit" name="update">Update Profile</button>

</form>

</div>

</body>
</html>