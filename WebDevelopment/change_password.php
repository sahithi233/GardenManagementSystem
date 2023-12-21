<?php
$conn = mysqli_connect("localhost", "root", "", "gms");

// Start a session (if not already started)
session_start();

// Initialize the message variable
$message = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Check if the form fields are set and not empty
    if (isset($_POST["OldPassword"]) && isset($_POST["NewPassword"]) && isset($_POST["ConfirmNewPassword"])) {
        $oldPassword = $_POST["OldPassword"];
        $newPassword = $_POST["NewPassword"];
        $confirmNewPassword = $_POST["ConfirmNewPassword"];

        // Assuming you have a database connection in $conn, and the user ID is stored in $_SESSION["id"]
        $userId = $_SESSION["id"];

        // Query the database to get the user's current password
        $getPasswordQuery = "SELECT Password FROM user WHERE id = $userId";
        $getPasswordResult = mysqli_query($conn, $getPasswordQuery);

        if ($getPasswordResult) {
            $row = mysqli_fetch_assoc($getPasswordResult);
            $currentPassword = $row['Password'];

            // Check if the entered old password matches the current password
            if ($oldPassword === $currentPassword) {
                // Check if the new password and confirm password match
                if ($newPassword === $confirmNewPassword) {
                    // Query the database to update the user's password
                    $updatePasswordQuery = "UPDATE user SET Password = '$newPassword' WHERE id = $userId";
                    $updatePasswordResult = mysqli_query($conn, $updatePasswordQuery);

                    if ($updatePasswordResult) {
                        // Password changed successfully
                        $message = "Password changed successfully.";
                    } else {
                        // Error updating password
                        $message = "Error updating password: " . mysqli_error($conn);
                    }
                } else {
                    // Password and confirm password do not match
                    $message = "New Password and Confirm Password do not match";
                }
            } else {
                // Old password does not match the current password
                $message = "Old Password is incorrect";
                echo '<script>
                        function showAlert(message) {
                            var popup = document.createElement("div");
                            popup.className = "popup";
                            popup.innerHTML = "<p>" + message + "</p>";
                            document.body.appendChild(popup);
                            setTimeout(function () {
                                document.body.removeChild(popup);
                            }, 5000);  // Remove the popup after 5 seconds
                        }
                        showAlert("' . $message . '");
                    </script>';
            }
        } else {
            // Error getting current password
            $message = "Error getting current password: " . mysqli_error($conn);
        }
    }
}
?>

<!-- Your HTML table goes here -->


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
  display: inline-block;
  margin: 100px;
  width: 80%;
  height: 50%;
  border: 1px solid #ccc;
  padding: 20px;
}
    .popup {
        position: fixed;
        bottom: 20px;
        left: 50%;
        transform: translateX(-50%);
        background-color: #f44336;
        color: white;
        padding: 15px;
        border-radius: 10px;
        box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.2);
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
      <li><a href="profile.php">PROFILE</a></li>
      <li><a href="logout.php">LOG OUT</a></li>
    </ul>
  </nav>
<form id="add-employee-form" method="POST">
      
      <label >Old Password:</label>
      <input type="text" name="OldPassword" required>
      <label for="mob_no">New Password:</label>
      <input type="text" name="NewPassword" required>
      <label for="mob_no">Confirm New Password:</label>
      <input type="text" name="ConfirmNewPassword" required>
      <input type="submit" name="submit" value="Submit">

    </form>
<div id="passwordChangeMessage">
    <?php echo $message; ?>
</div>
<script>
    // Close the modal when clicking the close button
    document.getElementById("closeModal").onclick = function () {
        document.getElementById("myModal").style.display = "none";
    };

    // Close the modal when clicking outside the modal
    window.onclick = function (event) {
        var modal = document.getElementById("myModal");
        if (event.target === modal) {
            modal.style.display = "none";
        }
    };
</script>
</body>
</html>
