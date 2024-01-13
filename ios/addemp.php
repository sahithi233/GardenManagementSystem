<?php
// Set the appropriate content type for JSON
header('Content-Type: application/json');

// Initialize the response array with a default status
 $response['status'] = false;
// Check if the request method is POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Establish a database connection
    $conn = mysqli_connect("localhost", "root", "", "gms");

    if (!$conn) {
        // If the connection fails, update the response and return an error message
        $response['message'] = 'Database connection failed';
    } else {
        // Retrieve and sanitize data from the POST request
        $Username = mysqli_real_escape_string($conn, $_POST['Username']);
        $Password = mysqli_real_escape_string($conn, $_POST['Password']);
        $role = mysqli_real_escape_string($conn, $_POST['role']);
        $name = mysqli_real_escape_string($conn, $_POST['name']);
        $dob = mysqli_real_escape_string($conn, $_POST['dob']);
        $mobile_no = mysqli_real_escape_string($conn, $_POST['mobile_no']);


  $sql="INSERT INTO user(Username, Password, role, name, dob, mobile_no,status) VALUES ('$Username','$Password','$role','$name','$dob','$mobile_no','Active')";
  
        // Execute the query
        if (mysqli_query($conn, $sql)) {
            // If the insertion is successful, update the response with success status
             $response['status'] = true;
            $response['message'] = 'Employee added successfully';
        } else {
            // If there's an error with the query, update the response with a failure message
            $response['message'] = 'Failed to add employee';
        }

        // Close the database connection
        mysqli_close($conn);
    }
} else {
    // If the request method is not POST, return a message indicating the invalid request method
    $response['message'] = 'Invalid request method';
}

// Return the entire response as JSON
echo json_encode($response);
?>
