<?php
session_start();
include("config.php");

if(!isset($_SESSION['user_id']))
{
    header("Location: login.php");
}

$sender = $_SESSION['user_id'];
$receiver = $_GET['receiver'];

$sql = "INSERT INTO requests(sender_id,receiver_id)
VALUES('$sender','$receiver')";

mysqli_query($conn,
"INSERT INTO notifications(user_id,message)
VALUES('$receiver_id','You received a new skill request')");
mysqli_query($conn,$sql);

echo "<script>
alert('Request Sent Successfully');
window.location='search.php';
</script>";
?>