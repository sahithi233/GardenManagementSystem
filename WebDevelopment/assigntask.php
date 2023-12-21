<?php
$conn = mysqli_connect("localhost", "root","","gms");
$sql= "SELECT task_name FROM task ";
$data= mysqli_query($conn,$sql);




?>
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
a{
  text-decoration: none;
  color: white;
}
nav a {
  text-decoration: none;
  color: #333;
  font-weight: bold;
}
    .assign-form {
      width: 80%;
      margin: 20px auto;
      background-color: #fff;
      padding: 20px;
      border-radius: 10px;
      box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    }

    .form-group {
      margin-bottom: 20px;
    }

    label {
      display: flex;
      font-weight: bold;
    }

    select,
    input[type="checkbox"],input[type="date"],input[type="time"]{
      width: 100%;
      padding: 10px;
      border: 1px solid #ccc;
      border-radius: 4px;
    }

    button{
      background-color: #e0c2b2;
      color: #fff;
      padding: 10px 20px;
      border: none;
      border-radius: 5px;
      cursor: pointer;
      font-weight: bold;
    }

    

    /* Style for the worker checkboxes */
    .worker-list {
      display: flex;
      flex-wrap: wrap;
    }

    .worker-item {
      margin-right: 10px;
      margin-bottom: 10px;
      display: flex;
      align-items: center;
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
  <div class="assign-form">
    <form  action="process.php" method="POST">
      <label >Select Task:</label>
      <select name='task'>
          <option>Select</option>
          <?php
          while ($row = mysqli_fetch_assoc($data)) {
            echo '<option>' . $row['task_name'] . '</option>';
          }
          ?>
        </select>
      <br><br>
      <label>Date:</label>
      <input type="Date" name="date" required>
      <br><br>
      <label for="task_time">Select Task Time:</label>
        <input type="time" id="start_time" name="start_time" required>
        <br><br>
      <label>Select workers</label><br>
       <div class="worker-list">
<?php
session_start();
$Supervisor = $_SESSION['name'];

// Assuming you have a 'team' table with 'workers' column
$query = "SELECT DISTINCT u.name AS worker_name FROM team t
JOIN user u ON t.workers = u.name
WHERE t.name = ? AND u.status = 'Active'";
$stmt = mysqli_prepare($conn, $query);

if ($stmt) {
    // Bind the parameter
    mysqli_stmt_bind_param($stmt, "s", $Supervisor);
    
    // Execute the statement
    mysqli_stmt_execute($stmt);

    // Get the result
    $result = mysqli_stmt_get_result($stmt);

    if ($result) {
        // Workers are assigned
        while ($row = mysqli_fetch_assoc($result)) {
            echo '<div class="worker-item">';
            echo '<input type="checkbox" name="worker[]" value="' . $row['worker_name'] . '"> ' . $row['worker_name'] . '<br>';
            echo '</div>';
        }
    } else {
        // No workers assigned
        echo '<p>No workers assigned.</p>';
    }

    // Close the statement
    mysqli_stmt_close($stmt);
} else {
    // Error in preparing the statement
    echo "Error: " . mysqli_error($conn);
}

// Close the connection
mysqli_close($conn);
?>


      </div><br>

      <button type="submit"  name="submit">Assign</button>
    </form>
  </div>


</center>

</body>
</html>
