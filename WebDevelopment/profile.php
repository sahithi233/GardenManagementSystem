<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="styles.css">

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

nav a {
  text-decoration: none;
  color: #333;
  font-weight: bold;
}


label {
  display: block;
  margin-bottom: 10px;
}

input, select {
  width: 100%;
  padding: 10px;
  margin-bottom: 15px;
  border: 1px solid #ccc;
  border-radius: 5px;
}

.loginbox{
width: 30%;
height:100%;
margin: 50px;
border: 0px solid #ccc; 
padding-top: 80px;
padding-bottom: 80px;
border-width: 40%;
border-radius: 20px;
box-shadow:
0 0 0 2px white,
0.3em 0.3em 1em rgba(78, 65,65,0.6);

}
.a{
  text-align: left;
}

button {
  background-color: #333;
  color: #fff;
  padding: 10px 20px;
  border: none;
  border-radius: 5px;
  cursor: pointer;
}
button:hover {
  background-color: #555;
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
      <li><a href="profile.php">Profile</a></li>
      <li><a href="logout.php">Logout</a></li>
    </ul>
  </nav>

  <center>
<div class="loginbox">
    <img src="avatar.png" height=100px; width=100px;>
<?php
session_start();
$conn = mysqli_connect("localhost", "root", "", "gms");

$user_id = $_SESSION['id'];

// Check if the 'id' session variable is set
if (isset($_SESSION['id'])) {
    // Prepare and execute the SQL query
    $sql = "SELECT * FROM user WHERE id = '$user_id'";
    $result = mysqli_query($conn, $sql);

    // Check if the query was successful and data was retrieved
    if ($result && mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        $role = $row['role'];
        $name = $row['name'];
        $dob = $row['dob'];
        $mobnum = $row['mobile_no'];

        // Display user information with customized HTML and CSS
        echo '<div style="text-align: center; background-color: #f2f2f2; padding: 20px; border-radius: 10px; margin: 20px auto; width: 60%;">';
        echo '<h2>Profile</h2>';
        echo '<table style="border-collapse: collapse; width: 100%; text-align: left;">';
        echo '<tr><td style="padding: 10px;">Name:</td><td style="padding: 10px;">' . $name . '</td></tr>';
        echo '<tr><td style="padding: 10px;">Role:</td><td style="padding: 10px;">' . $role . '</td></tr>';
        echo '<tr><td style="padding: 10px;">DOB:</td><td style="padding: 10px;">' . $dob . '</td></tr>';
        echo '<tr><td style="padding: 10px;">Mobile.No:</td><td style="padding: 10px;">' . $mobnum . '</td></tr>';
        echo '</table>';
        echo '</div>';
    } else {
        // Handle the case where the query was unsuccessful or no data was found
        echo 'User not found.';
    }
}

// Close the database connection
mysqli_close($conn);
?>

<form action="change_password.php">
    <button type="submit">Change Password</button>
</form>

  </center>

    </div>
</body>
</html>
