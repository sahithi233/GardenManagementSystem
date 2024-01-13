<?php
$conn = mysqli_connect("localhost", "root", "", "gms");

header('Content-Type: application/json');
// Start a session (if not already started)
session_start();

// Initialize a response array
$response = array('status' => false, 'message' => '');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve the form fields
    $oldPassword = $_POST["oldPassword"];
    $newPassword = $_POST["newPassword"];
    $confirmNewPassword = $_POST["confirmNewPassword"];

    // Check if the "id" session variable is set
    if (isset($_GET["id"])) {
        $id = $_GET["id"];
        
        // Query the database to retrieve the old password for the user
        $query = "SELECT Password FROM user WHERE id = $id";
        $result = mysqli_query($conn, $query);

        if ($result) {
            $row = mysqli_fetch_assoc($result);
            $dbOldPassword = $row['Password'];

            // Check if the old password matches the one in the database
            if ($oldPassword === $dbOldPassword) {
                // Check if the new password and confirm password match
                if ($newPassword === $confirmNewPassword) {
                    // Query the database to update the user's password
                    $query = "UPDATE user SET Password = '$newPassword' WHERE id = $id";
                    $result = mysqli_query($conn, $query);

                    if ($result) {
                        // Password changed successfully
                        $response['status'] = true;
                        $response['message'] = 'Password changed successfully';
                    } else {
                        // Error updating password
                        $response['message'] = 'Error updating password: ' . mysqli_error($conn);
                    }
                } else {
                    // Password and confirm password do not match
                    $response['message'] = 'New password and confirm password do not match.';
                }
            } else {
                // Old password is incorrect
                $response['message'] = 'Old password is incorrect.';
            }
        } else {
            // Error retrieving old password
            $response['message'] = 'Error retrieving old password: ' . mysqli_error($conn);
        }
    } else {
        // "id" session variable not set
        $response['message'] = 'User session ID not set';
    }
}

// Return the response as JSON
echo json_encode($response);
?>
