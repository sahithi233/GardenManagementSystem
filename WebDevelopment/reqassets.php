<?php
$conn = mysqli_connect("localhost", "root","","gms");
session_start();
$sql= "SELECT * FROM tool ";
$data= mysqli_query($conn,$sql);
if(isset($_POST['submit'])){
  $tool=$_POST['tool_name'];
  $quantity=$_POST['quantity'];
 
$supervisor = $_SESSION['name'];
$query="INSERT INTO assets(asset,supervisor,quantity,status) VALUES ('$tool','$supervisor','$quantity','pending')";

  $result = mysqli_query($conn,$query);

  if($result)
  {
    echo "Data inserted sucessfully";
    header("location: sdashboard.php");
  }
}

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
a{
  text-decoration: none;
  color: white;
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

    form {
      margin-bottom: 20px;
    }

    label {
      display: flex;
      font-weight: bold;
    }

    select,
    input{
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
<center>
  <div class="assign-form">
    <form  action="reqassets.php" method="POST">
      <label >Select Asset:</label>
      <select name='tool_name'>
          <option>Select</option>
          <?php
          while ($row = mysqli_fetch_assoc($data)) {
            echo '<option>' . $row['tool_name'] . '</option>';
          }
          ?>
        </select>
      <br>
      
      <br>
      <label for="location-input">Quantity:</label>
      <input type="text"  name="quantity" required>

      <br>
<br>      

      <button type="submit"  name="submit" >Request</button>
    </form>
  </div>
</center>



</body>
</html>
