<!DOCTYPE html>
<html>
<head>
<title>Skill Exchange Platform</title>
<link rel="stylesheet" href="style.css">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<style>
*{
margin:0;
padding:0;
box-sizing:border-box;
}

body{
font-family:Arial, sans-serif;
background:url('images/bg.jpg') no-repeat center center/cover;
min-height:100vh;
}

.overlay{
background:rgba(0,0,0,0.55);
min-height:100vh;
}

.navbar{
display:flex;
justify-content:space-between;
align-items:center;
padding:15px 25px;
flex-wrap:wrap;
}

.logo{
color:white;
font-size:24px;
font-weight:bold;
}

.menu a{
color:white;
text-decoration:none;
margin-left:15px;
font-weight:bold;
}

.hero{
text-align:center;
color:white;
padding:120px 20px 80px;
max-width:800px;
margin:auto;
}

.hero h1{
font-size:48px;
margin-bottom:15px;
}

.hero p{
font-size:22px;
margin-bottom:25px;
line-height:1.5;
}

.btn{
display:inline-block;
padding:12px 22px;
margin:8px;
background:#007bff;
color:white;
text-decoration:none;
border-radius:8px;
font-weight:bold;
}

.btn:hover{
background:#0056b3;
}

.footer{
text-align:center;
color:white;
padding:18px;
margin-top:40px;
}

/* Mobile */
@media(max-width:768px){

.navbar{
flex-direction:column;
align-items:flex-start;
}

.menu{
margin-top:10px;
width:100%;
}

.menu a{
display:block;
margin:8px 0;
}

.hero{
padding:70px 15px;
}

.hero h1{
font-size:32px;
}

.hero p{
font-size:18px;
}

.btn{
display:block;
max-width:220px;
margin:10px auto;
}
}
</style>
</head>

<body>

<div class="overlay">

<div class="navbar">
<div class="logo">Skill Exchange</div>

<div class="menu">
<a href="index.php">Home</a>
<a href="register.php">Register</a>
<a href="login.php">Login</a>
<a href="search.php">Search</a>
<a href="admin/login.php">Admin</a>
</div>
</div>

<div class="hero">
<h1>Learn Skills by Exchanging Yours</h1>
<p>Teach what you know. Learn what you need. Grow with real people.</p>

<a href="register.php" class="btn">Join Now</a>
<a href="login.php" class="btn">Login</a>
<a href="search.php" class="btn">Explore Skills</a>
</div>

<div class="footer">
© 2026 Skill Exchange Platform
</div>

</div>

</body>
</html>