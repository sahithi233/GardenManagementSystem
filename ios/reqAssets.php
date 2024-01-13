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
        $tool = mysqli_real_escape_string($conn, $_POST['tool']);
        $quantity = mysqli_real_escape_string($conn, $_POST['quantity']);
        // SQL query to insert the employee into the database
$supervisor = $_GET['name'];
$query="INSERT INTO assets(asset,supervisor,quantity,status) VALUES ('$tool','$supervisor','$quantity','pending')";

        // Execute the query
        if (mysqli_query($conn, $query)) {
            // If the insertion is successful, update the response with success status
             $response['status'] = true;
            $response['message'] = 'Asset requested successfully';
        } else {
            // If there's an error with the query, update the response with a failure message
            $response['message'] = 'Failed to request Asset';
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
