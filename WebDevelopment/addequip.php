<?php
$conn = mysqli_connect("localhost", "root", "", "gms");

if (isset($_POST['submit'])) {
    $tool_name = $_POST['tool_name'];
    $quantity = $_POST['quantity'];

    // Use INSERT ... ON DUPLICATE KEY UPDATE to handle insertion or update
    $sql = "INSERT INTO tool (tool_name, quantity) VALUES ('$tool_name', '$quantity')
            ON DUPLICATE KEY UPDATE quantity = quantity + '$quantity'";

    $result = mysqli_query($conn, $sql);

    if ($result) {
        // Data inserted or updated successfully
        header("location: mdashboard.php");
    } else {
        // Error inserting or updating data
        echo "Error: " . mysqli_error($conn);
    }
}

mysqli_close($conn);
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

nav a {
  text-decoration: none;
  color: #333;
  font-weight: bold;
}
a{
  text-decoration: none;
  color: white;
}
.form-group {
  display: flex;
  margin-bottom: 10px;
}

label {
 display: flex;
  font-weight: bold;
  text-align: right;
  margin-right: 10px;
}

input{
  flex: 2;
  padding: 5px;
  border: 1px solid #ccc;
  border-radius: 4px;
  margin-left: 10px;
}

button {
  background-color: #e0c2b2;
  color: #fff;
  padding: 10px 20px;
  border: none;
  border-radius: 5px;
  cursor: pointer;

}

form{ 
      width: 80%;
      margin: 20px auto;
      background-color: #fff;
      padding: 20px;
      border-radius: 10px;
      box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    
}
  </style>
</head>
<body>
  <header>
    <img src="growise.jpg" height="30px" width="40px">
    <h1><a href="mdashboard.php">GROWISE</h1>
  </header>
  <nav>
     <ul>
      <li><a href="jobs.php">Jobs</a></li>
      <li><a href="mbell.php"><img src="bell.svg"></a></li>
      <li><a href="profile.php">PROFILE</a></li>
      <li><a href="logout.php">LOG OUT</a></li>
    </ul>
      </nav>
      <center>
 <form action="" method="post">
  <div class="form-group">
    <label for="tool_name">Tool Name:</label>
    <input type="text" id="tool_name" name="tool_name" required>
  </div>
  <div class="form-group">
    <label for="quantity">Quantity:</label>
    <input type="text" id="quantity" name="quantity" required>
  </div>
  <button type="submit" name="submit">Add</button>
</form>

 </center>
</body>
</html>
