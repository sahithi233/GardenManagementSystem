<?php
// Establish a database connection
$conn = mysqli_connect("localhost", "root", "", "gms");

// Check if the connection was successful
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// Create an array to store the results
$results = array();

// Query to retrieve data from the USER table
$sql = "SELECT name FROM user WHERE role = 'supervisor'";
$result = mysqli_query($conn, $sql);

// Check if the query was successful
if ($result) {
    while ($row = mysqli_fetch_assoc($result)) {
        // Add each row to the results array
        $results[] = $row;
    }
    // Free the result set
    mysqli_free_result($result);
}

// Close the database connection
mysqli_close($conn);

// Create a response array
$response = array();

if (!empty($results)) {
    // If there are results, set a success status and message
    $response["status"] = true;
    $response["message"] = "Data retrieved successfully";
    $response["data"] = $results; // Include the data in the response
} else {
    // If no data is retrieved, set a failure status and message
    $response["status"] = false;
    $response["message"] = "No data available";
}

// Set the response content type to JSON
header("Content-Type: application/json");

// Encode the response array as JSON and echo it
echo json_encode($response);
?>
