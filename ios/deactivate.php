<?php
// Assuming you have already established a database connection ($conn)

$conn = mysqli_connect("localhost", "root", "", "gms");

// Check if the connection was successful
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// Create an array to store the results

// Initialize a response array
$response = array('status' => false, 'message' => '');


// Check if it's a POST request and the required parameters are set
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['user_id']) && isset($_POST['action'])) {
    $userId = $_POST['user_id'];
    $action = $_POST['action'];

    // Perform the status update based on the submitted form data
    // You should replace this with your actual database update logic
    $updateQuery = "UPDATE user SET status = '$action' WHERE id = $userId";
    $result = mysqli_query($conn, $updateQuery);

    if ($result) {
        // Status updated successfully
        $response['status'] = true;
        $response['message'] = 'Deactivated or activated successfully';
    } else {
        // Error updating status
        $response['message'] = 'Failed to update status: ' . mysqli_error($conn);
    }
} else {
    // Invalid request or missing parameters
    $response['message'] = 'Invalid request or missing parameters';
}

// Return the response as JSON
echo json_encode($response);
?>
