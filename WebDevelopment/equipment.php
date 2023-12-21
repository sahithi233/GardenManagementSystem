
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

.issue-section{
  text-align: center;
  width: 70%;
   margin-bottom: 30px;
            padding: 5px;
            border: 1px solid #ddd;
            background-color: white;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
}
button {
  display: flex;
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
    <h1><a href="mdashboard.php">GROWISE</a></h1>
  </header>
  <nav>
     <ul>
      <li><a href="jobs.php">Jobs</a></li>
      <li><a href="mbell.php"><img src="bell.svg"></a></li>
      <li><a href="profile.php">PROFILE</a></li>
      <li><a href="logout.php">LOG OUT</a></li>
    </ul>
  </nav>
  <button type="submit" name="submit"><a href="addequip.php">Add Asset</a></button>
<center>
  <?php
    $conn = mysqli_connect("localhost", "root","","gms");
    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Retrieve issues from the database
    $sql = "SELECT * FROM tool";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $tool_name = $row['tool_name'];
            $quantity = $row['quantity'];
       echo "<div class='issue-section'>";

            echo "<h5>Asset Name: $tool_name</h5>";
            echo "<h5>Quantity: $quantity</h5>";
            
            echo "</div>";
        }
    } else {
        echo "No assets found.";
    }

    // Close the database connection
    $conn->close();
    ?>
  
<button><a href="allotequip.php">Allot Asset</a> </button></center>
</body>
</html>