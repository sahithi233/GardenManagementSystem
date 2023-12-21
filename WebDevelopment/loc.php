
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
 form {
      width: 80%;
      margin: 20px auto;
      margin-top: 50px;
      background-color: #fff;
      padding: 20px;
      border-radius: 10px;
      box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    }


    label,p {
      display: flex;
      font-weight: bold;
    }

    input,select {
      width: 90%;
      padding: 10px;
      border: 1px solid #ccc;
      border-radius: 4px;
    }

    button {
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
    <h1><a href="mdashboard.php">GROWISE</h1>
  </header>
  <nav>
    <ul>
      <li><a href="jobs.php">Jobs</a></li>
      <li><a href="bell.php"><img src="bell.svg"></a></li>
      <li><a href="profile.php">PROFILE</a></li>
      <li><a href="logout.php">LOG OUT</a></li>
    </ul>
  </nav>
<?php
$conn = mysqli_connect("localhost", "root", "", "gms");

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$message = ""; // Initialize the message variable

if (isset($_POST['submit'])) {
    // Retrieve the user-entered message
    $message = $_POST['message'];
    $supervisor = $_POST['supervisor']; // Retrieve the supervisor's name

    // Insert a notification for the supervisor into the notifications table
    $insert_sql = "INSERT INTO notifications (supervisor, message) VALUES ('$supervisor', '$message')";
    mysqli_query($conn, $insert_sql);

    // Display a notification message to the user
    header("location: mplaces.php");
    echo "<script type='text/javascript'>alert('Notification sent');</script>";
}

// Check if place_name is set in the $_GET array
$place_name = isset($_GET['place_name']) ? $_GET['place_name'] : '';
// Retrieve a list of supervisors from the database
$sql = "SELECT name FROM team
WHERE location = '$place_name'
GROUP BY name"; // Adjust this query to match your database structure

$result = mysqli_query($conn, $sql);

?>

<center>
<center>
<form action="" method="post">
    <?php
    if ($result && mysqli_num_rows($result) > 1) {
        // If there is more than one supervisor, show the dropdown
        echo "<label for='supervisor'>Supervisor: </label>";
        echo "<select name='supervisor' required>";
        while ($row = mysqli_fetch_assoc($result)) {
            $supervisorName = $row['name'];
            echo "<option value='$supervisorName'>$supervisorName</option>";
        }
        echo "</select>";
    } else if ($result && mysqli_num_rows($result) === 1) {
    // If there is only one supervisor, display their name without the dropdown
    $row = mysqli_fetch_assoc($result);
    $supervisorName = $row['name'];
    echo "<label for='supervisor'>Supervisor: </label>";
    echo "<input type='text' name='supervisor' value='$supervisorName' readonly>";

    } else {
        echo "<p>No supervisors found.</p>";
    }
    ?>
    <br><br>
    <label for="message">Enter your message: </label><input type="text" name="message" value="<?php echo $message; ?>" required><br><br>
    <button type="submit" name="submit">Contact</button>
</form>
</center>

</body>
</html>
