<?php
session_start();
?>
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


a{
  text-decoration: none;
  color: white;
}

.loginbox{
width: 30%;
      margin: 20px auto;
      background-color: #fff;
      padding: 20px;
      border-radius: 10px;
      box-shadow: 0 0 30px rgba(0, 0, 0, 0.1);


}
button {
  background-color: #e0c2b2;
  color: #fff;
  padding: 10px 20px;
  border: none;
  border-radius: 5px;
  cursor: pointer;
}


  </style>
</head>
<body>
  <header>
    <img src="growise.jpg" height="30px" width="40px">
    <h1><a href="sdashboard.php">GROWISE</h1>
  </header>
   <nav>
    <ul>
      <li><a href="bell.php"><img src="bell.svg"></a></li>
      <li><a href="assigntask.php">Assign Task</a></li>
      <li><a href="sjobs.php">Jobs</a></li>
      <li><a href="assets.php">Assets</a></li>
      <li><a href="sleaderboard.php">Leaderbooard</a></li>
      <li><a href="sprofile.php">Profile</a></li>
      <li><a href="logout.php">Logout</a></li>
    </ul>
  </nav>
  <center>
<div class="loginbox">
  
    <img src="avatar.png" height=100px; width=100px;>
        <h2>Profile</h2>
<?php
$conn = mysqli_connect("localhost", "root", "", "gms");

$user_id = $_SESSION['id'];
//echo "$user_id";

// Check if the 'id' session variable is set
if(isset($_SESSION['id'])){
    

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

        // Display user information
        echo '<tr><td>Name:</td> <td>' . $name . '</td></tr><br></br>';
        echo '<tr><td>Role:</td> <td>' . $role . '</td></tr><br></br>';
        echo '<tr><td>DOB:</td> <td>' . $dob . '</td></tr><br></br>';
        echo '<tr><td>Mobile.No:</td> <td>' . $mobnum . '</td></tr><br></br>';
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
