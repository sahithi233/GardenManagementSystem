
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="styles.css">
  <title>garden management system</title>
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
a{
  text-decoration: none;
  color: white;
}

.aa{
  display: flex;
  justify-content: center;
}

.issue-section{
 width: 60%;
      margin: 20px auto;
      background-color: #fff;
      padding: 20px;
      border-radius: 10px;
      box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);

}

h6 {
    display: block;
    font-weight: bold;
    margin-right: 300px;
}

button {
  text-align: right;
      background-color: #e0c2b2;
      color: #fff;
      padding: 10px 20px;
      border: none;
      border-radius: 5px;
      cursor: pointer;
      font-weight: bold;
    }


  </style>
</head>
<body>
  <header>
    <img src="growise.jpg" height="30px" width="40px">
    <h1><a href="sdashboard.php">GROWISE</a></h1>
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
  <button type="submit" name="submit"><a href="reqassets.php">Request Asset</a></button>
<center>
<?php
$conn = mysqli_connect("localhost", "root", "", "gms");
session_start();
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
$supervisor = $_SESSION['name'];
// Retrieve issues from the database
$sql = "SELECT * FROM assets WHERE supervisor='$supervisor'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $tool_name = $row['asset'];
        $quantity = $row['quantity'];
        
        // Check if the 'status' is null and assign a default value
        $status = ($row['status'] !== null) ? $row['status'] : 'default';

        // Define a class based on the status
        $statusClass = ($status === 'pending') ? 'pending' : '';

        echo "<div class='issue-section $statusClass'>";
        echo "<h5>Asset Name: $tool_name</h5>";
        echo "<div class='aa'>";
        echo "<h5>Quantity: $quantity</h5>";
        echo "<p>Status: $status</p>"; // Display the status for debugging
        echo "</div>";
        echo "</div>";
    }
} else {
    echo "No assets found.";
}

// Close the database connection
$conn->close();
?>


</center>
</body>
</html>