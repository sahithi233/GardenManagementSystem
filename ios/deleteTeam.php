<?php

// Establish a database connection
$conn = mysqli_connect("localhost", "root", "", "gms");

// Check if the connection was successful
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// Check if the request method is POST
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Check if the 'id' parameter is set
    if (isset($_POST['id'])) {
        $id = mysqli_real_escape_string($conn, $_POST['id']);

        // SQL query to delete a record based on the team_id
        $query = "DELETE FROM team WHERE team_id = '$id'";
        $result = mysqli_query($conn, $query);

        // Check if the query was successful
        if ($result) {
            $response = array('status' => true, 'message' => 'Record deleted successfully');
        } else {
            $response = array('status' => false, 'message' => 'Failed to delete record: ' . mysqli_error($conn));
        }
    } else {
        $response = array('status' => false, 'message' => 'Missing required parameter: id');
    }
} else {
    $response = array('status' => false, 'message' => 'Invalid request method');
}

// Close the database connection
mysqli_close($conn);

// Set the response content type to JSON
header("Content-Type: application/json");

// Encode the response array as JSON and echo it
echo json_encode($response);

?>
