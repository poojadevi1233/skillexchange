<?php
session_start();
include("config.php");

if(!isset($_SESSION['user_id']))
{
    header("Location: login.php");
}

$user_id = $_SESSION['user_id'];
?>

<!DOCTYPE html>
<html>
<head>
<title>My Requests</title>

<style>
body{
font-family:Arial;
background:#f4f6f9;
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

.container{
width:80%;
margin:30px auto;
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

h2{
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

<div class="container">

<h2>Requests Received</h2>

<table>
<tr>
<th>Sender Name</th>
<th>Status</th>
<th>Action</th>
</tr>

<?php
$sql = "SELECT requests.id, users.name, requests.status
        FROM requests
        JOIN users ON requests.sender_id = users.id
        WHERE requests.receiver_id = '$user_id'";

$result = mysqli_query($conn,$sql);

while($row = mysqli_fetch_assoc($result))
{
    echo "<tr>
            <td>".$row['name']."</td>
            <td>".$row['status']."</td>
            <td>";

    if($row['status'] == 'Pending')
    {
        echo "
        <a href='update_request.php?id=".$row['id']."&status=Accepted'>Accept</a> |
        <a href='update_request.php?id=".$row['id']."&status=Rejected'>Reject</a>
        ";
    }
    else
    {
        echo "Completed";
    }

    echo "</td></tr>";
}
?>
</table>

</div>

</body>
</html>