<?php
session_start();
include("config.php");

if(!isset($_SESSION['user_id']))
{
    header("Location: login.php");
    exit();
}

$uid = $_SESSION['user_id'];

// notifications count
$nresult = mysqli_query($conn,
"SELECT COUNT(*) as total FROM notifications WHERE user_id='$uid' AND status=0");

$nrow = mysqli_fetch_assoc($nresult);
$notify_count = $nrow['total'];
?>

<!DOCTYPE html>
<html>
<head>

<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Search Skills</title>

<style>
body{
font-family:Arial;
background:#f4f6f9;
margin:0;
}

.navbar{
background:#007bff;
padding:15px 20px;
color:white;
display:flex;
justify-content:space-between;
flex-wrap:wrap;
}

.navbar a{
color:white;
text-decoration:none;
margin-left:10px;
font-weight:bold;
}

.container{
width:90%;
max-width:1100px;
margin:30px auto;
}

.box{
background:white;
padding:20px;
border-radius:10px;
}

input,select,button{
width:100%;
padding:10px;
margin-top:10px;
}

button{
background:#007bff;
color:white;
border:none;
}

table{
width:100%;
margin-top:20px;
border-collapse:collapse;
background:white;
}

th,td{
border:1px solid #ddd;
padding:10px;
text-align:center;
}

th{
background:#007bff;
color:white;
}

.action{
display:inline-block;
padding:6px 10px;
margin:3px;
background:#007bff;
color:white;
text-decoration:none;
border-radius:5px;
}

.badge{
color:green;
font-weight:bold;
}
</style>

</head>
<body>

<!-- NAVBAR -->
<div class="navbar">
<div><b>Skill Exchange</b></div>

<div>
<a href="dashboard.php">Dashboard</a>
<a href="add_skill.php">Add Skill</a>
<a href="inbox.php">Inbox</a>
<a href="notifications.php">🔔 <?php echo $notify_count; ?></a>
<a href="logout.php">Logout</a>
</div>
</div>

<div class="container">

<div class="box">
<form method="GET">

<input type="text" name="search" placeholder="Enter Skill">

<select name="category">
<option value="">All Categories</option>
<option value="Coding">Coding</option>
<option value="English">English</option>
<option value="Design">Design</option>
<option value="Music">Music</option>
<option value="Fitness">Fitness</option>
<option value="Business">Business</option>
</select>

<button type="submit">Search</button>

</form>
</div>

<?php
if(isset($_GET['search']))
{
    $search = $_GET['search'];
    $category = $_GET['category'];

    $sql = "SELECT users.id, users.name, users.city, users.verified,
    skills.skill_name, skills.type, skills.category
    FROM skills
    JOIN users ON skills.user_id = users.id
    WHERE skills.skill_name LIKE '%$search%'";

    if($category != "")
    {
        $sql .= " AND skills.category='$category'";
    }

    $result = mysqli_query($conn, $sql);

    echo "<table>";

    echo "<tr>
    <th>Name</th>
    <th>City</th>
    <th>Skill</th>
    <th>Type</th>
    <th>Category</th>
    <th>Action</th>
    </tr>";

    while($row = mysqli_fetch_assoc($result))
    {
        $profile_id = $row['id'];

        // rating
        $rate_result = mysqli_query($conn,
        "SELECT AVG(stars) as avg_rating FROM ratings WHERE to_user='$profile_id'");

        $rate_row = mysqli_fetch_assoc($rate_result);

        $avg = ($rate_row['avg_rating'] != NULL)
            ? round($rate_row['avg_rating'],1)
            : "No Rating";

        echo "<tr>";

        echo "<td>";
        echo $row['name']." (".$avg."⭐)";

        if($row['verified'] == 1)
        {
            echo " <span class='badge'>✅ Verified</span>";
        }

        echo "</td>";

        echo "<td>".$row['city']."</td>";
        echo "<td>".$row['skill_name']."</td>";
        echo "<td>".$row['type']."</td>";
        echo "<td>".$row['category']."</td>";

        echo "<td>";

        $receiver = $row['id'];
        $sender = $_SESSION['user_id'];

        $check = mysqli_query($conn,
        "SELECT * FROM requests WHERE sender_id='$sender' AND receiver_id='$receiver'");

        if(mysqli_num_rows($check) > 0)
        {
            echo "<span style='color:green;font-weight:bold;'>Request Sent</span><br>";
        }
        else
        {
            echo "<a class='action' href='send_request.php?receiver=".$row['id']."'>Send Request</a><br>";
        }

        echo "<a class='action' href='rate_user.php?user=".$row['id']."'>Rate User</a><br>";
        echo "<a class='action' href='chat.php?user=".$row['id']."'>Chat</a>";

        echo "</td>";

        echo "</tr>";
    }

    echo "</table>";
}
?>

</div>

</body>
</html>