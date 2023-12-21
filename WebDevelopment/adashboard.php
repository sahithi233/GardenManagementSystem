<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="styles.css">
  <title>Admin Dashboard</title>
  <style >
    /* Reset default margin and padding */
body, h1, h2, h3, ul, li, p {
  margin: 0;
  padding: 0;
}

body {
  font-family: Arial, sans-serif;
}

header {
  background-color: #E0C2B2;
  color: #fff;
  padding: 10px;
  display: flex;
}
h1{
  padding-left: 10px;
}
nav ul {
  list-style: none;
  text-align: right;
  background-color: #f0f0f0;
  padding: 10px;
}

nav li {
  margin-right: 20px;
  text-align: center;
  display: inline-block;
}
a{
  text-decoration:none;
  color: black;
}
nav a {
  text-decoration: none;
  color: #333;
  font-weight: bold;
}

section {
            margin-bottom: 30px;
            padding: 25px;
            border: 1px solid #ddd;
            background-color: white;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.5);
            width:60%;
        }
section h2{
  text-align: center;
}
.id1{
  padding-top:20px;
}
.id1 ,.id2 ,.id3{
  display:flex;
  justify-content:  center;

  width:100%;
}

  </style>
</head>
<body>
  <header>
    <img src="growise.jpg" height="30px" width="40px">
    <h1>GROWISE</h1>
  </header>
  <nav>
    <ul>
      <li><a href="addemp.php">ADD USERS</a></li>
      <li><a href="profile.php">PROFILE</a></li>
      <li><a href="logout.php">LOG OUT</a></li>
    </ul>
  </nav>
  <div class="id1">
  <section id="user-management">
    <h2><a href="emp.php" >Employees</h2>
    <!-- Add user management form and list here -->
  </section>
  </div>
  <div class="id2">
  <section id="places-management">
    <h2><a href="places.php" >Places</h2>
  </section>
</div>
  <div class="id3">
  <section id="task-reports">
    <h2><a href="reports.php" >Task Reports</h2>
    <!-- Add task reports here -->
  </section>
</div>
</body>
</html>

