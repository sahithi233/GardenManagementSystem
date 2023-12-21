<?php
$conn = mysqli_connect("localhost", "root", "", "gms");

if (isset($_POST['submit'])) {
    $username = $_POST['username'];
    $role = $_POST['role'];
    $name = $_POST['name'];
    $dob = $_POST['dob'];
    $mobno = $_POST['mob_no'];
    $Active = "Active";

    // Check if the mobile number is exactly 10 digits
    if (strlen($mobno) !== 10 || !ctype_digit($mobno)) {
        echo '<script>alert("Mobile number should be exactly 10 digits and contain only numbers!")</script>';
    } else {
        // Check if the user with the same username already exists
        $checkQuery = "SELECT * FROM user WHERE Username = '$username'";
        $checkResult = mysqli_query($conn, $checkQuery);

        if (mysqli_num_rows($checkResult) > 0) {
            // User with the same username already exists, display an error message
            echo '<script>alert("User with the same username already exists!")</script>';
        } else {
            // Insert the new user data
            $sql = "INSERT INTO user(Username, Password, role, name, dob, mobile_no, status) 
                    VALUES ('$username','123','$role','$name','$dob','$mobno','$Active')";
            $data = mysqli_query($conn, $sql);

            if ($data) {
                echo '<script>alert("Employee added successfully!")</script>';
            } else {
                echo '<script>alert("Error adding employee!")</script>';
            }
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="styles.css">
  <title> Admin Dashboard</title>
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
form {
  margin: 30px;
  margin-left: 200px;
  margin-right: 200px;
  height: 60%;
  border: 1px solid #ccc;
  padding: 20px;

  box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
}

label {
  display: block;
  margin-bottom: 10px;
}

input, select {
  width: 100%;
  padding: 10px ;
  margin-bottom: 15px;
  border: 1px solid #ccc;
  border-radius: 5px;
}

input[type="submit"] {
  background-color: #e0c2b2;
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
    <h1><a href="adashboard.php"style="text-decoration:none;">GROWISE</h1>
  </header>
  <nav>
    <ul>
      <li><a href="addemp.php">ADD USERS</a></li>
      <li><a href="profile.php">PROFILE</a></li>
      <li><a href="logout.php">LOG OUT</a></li>
    </ul>
  </nav>

<form id="add-employee-form" method="POST">
      
      <label for="employee-name">Employee Name:</label>
      <input type="text" id="employee-name" name="name" required>
      <label for="dob">Date of Birth:</label>
      <input type="Date" name="dob" required>
      <label for="mob_no">Mobile no:</label>
      <input type="big int" name="mob_no" required>
      <label for ="role">Role</label>
      <select id="role" name="role">
                <option value="other"></option>
        <option value="Supervisor">Supervisor</option>
        <option value="Worker">Worker</option>
        <option value="Manager">Manager</option>
      </select>
      <label for ="username">Username</label>
            <input type="text" name="username" placeholder="Enter Username" >
      <input type="submit" name="submit" value="Add Employee">

    </form>


</body>
</html>
