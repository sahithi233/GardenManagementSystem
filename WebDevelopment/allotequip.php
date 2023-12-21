<?php
$conn = mysqli_connect("localhost", "root", "", "gms");

if (isset($_POST['submit'])) {
    $tool_name = $_POST['supervisor'];
    $tool = $_POST['asset'];
    $quantity = $_POST['quantity'];

    // Check if there is sufficient quantity in the tool table
    $checkQuantityQuery = "SELECT quantity FROM tool WHERE tool_name='$tool'";
    $checkQuantityResult = mysqli_query($conn, $checkQuantityQuery);

    if ($checkQuantityResult) {
        $row = mysqli_fetch_assoc($checkQuantityResult);
        $availableQuantity = $row['quantity'];

        // Check if there is enough quantity to be allotted
        if ($quantity <= $availableQuantity) {
            // Check if the tool is already assigned to the supervisor
            $checkQuery = "SELECT * FROM assets WHERE supervisor='$tool_name' AND asset='$tool'";
            $checkResult = mysqli_query($conn, $checkQuery);

            if ($checkResult) {
                // If the tool is already assigned, update the quantity
                if (mysqli_num_rows($checkResult) > 0) {
                    $updateQuery = "UPDATE assets SET quantity = quantity + $quantity WHERE supervisor='$tool_name' AND asset='$tool'";
                    $updateResult = mysqli_query($conn, $updateQuery);

                    if ($updateResult) {
                        // Quantity updated successfully

                        // Decrease the tool quantity in the tools table
                        $decreaseQuery = "UPDATE tool SET quantity = quantity - $quantity WHERE tool_name='$tool'";
                        $decreaseResult = mysqli_query($conn, $decreaseQuery);

                        if ($decreaseResult) {
                            // Tool quantity decreased successfully
                            header("location: mdashboard.php");
                        } else {
                            // Error decreasing tool quantity
                            echo "Error decreasing tool quantity: " . mysqli_error($conn);
                        }
                    } else {
                        // Error updating quantity
                        echo "Error updating quantity: " . mysqli_error($conn);
                    }
                } else {
                    // If the tool is not assigned, insert a new record
                    $insertQuery = "INSERT INTO assets(supervisor, asset, quantity) VALUES ('$tool_name', '$tool', '$quantity')";
                    $insertResult = mysqli_query($conn, $insertQuery);

                    if ($insertResult) {
                        // Data inserted successfully

                        // Decrease the tool quantity in the tools table
                        $decreaseQuery = "UPDATE tool SET quantity = quantity - $quantity WHERE tool_name='$tool'";
                        $decreaseResult = mysqli_query($conn, $decreaseQuery);

                        if ($decreaseResult) {
                            // Tool quantity decreased successfully
                            header("location: mdashboard.php");
                        } else {
                            // Error decreasing tool quantity
                            echo "Error decreasing tool quantity: " . mysqli_error($conn);
                        }
                    } else {
                        // Error inserting data
                        echo "Error inserting data: " . mysqli_error($conn);
                    }
                }
            } else {
                // Error checking existing assignments
                echo "Error checking existing assignments: " . mysqli_error($conn);
            }
        } else {
            // Display an error message if there is insufficient quantity
            echo "Error: '";

    echo "<script type='text/javascript'>alert(' Insufficient quantity available for tool $tool ');</script>";
        }
    } else {
        // Error checking available quantity
        echo "Error checking available quantity: " . mysqli_error($conn);
    }
}
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
select,
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
          <label for="location-select">Select Supervisor</label>
          <select id="location-select" name="supervisor">
            <?php

$sql = "SELECT name FROM user  where role = 'supervisor' ";
$data = mysqli_query($conn, $sql);
          while ($row = mysqli_fetch_assoc($data)) {
            echo '<option>' . $row['name'] . '</option>';
          }
          ?>
          </select>
        </div>
        <div class="form-group">
          <label for="location-select">Select Tool</label>
          <select id="location-select" name="asset">
            <?php

$sql = "SELECT tool_name FROM  tool  ";
$data = mysqli_query($conn, $sql);
          while ($row = mysqli_fetch_assoc($data)) {
            echo '<option>' . $row['tool_name'] . '</option>';
          }
          ?>
          </select>
        </div>
  <div class="form-group">
    <label for="quantity">Quantity</label>
    <input type="text" id="quantity" name="quantity" required>
  </div>
  <button type="submit" name="submit">Add</button>
</form>

 </center>
</body>
</html>
