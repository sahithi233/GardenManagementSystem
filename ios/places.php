<?php
// Establish a database connection
$conn = mysqli_connect("localhost", "root", "", "gms");

// Check if the connection was successful
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// Create an array to store the results
$places = array();

// Retrieve places from the database
$sql = "SELECT * FROM places";
$result = mysqli_query($conn, $sql);

// Check if the query was successful
if ($result) {
    while ($row = mysqli_fetch_assoc($result)) {
        // Add each row to the $places array
        $places[] = $row;
    }
    // Free the result set
    mysqli_free_result($result);
}

// Close the database connection
mysqli_close($conn);

// Set the response content type to JSON
header("Content-Type: application/json");

// Encode the $places array as JSON and echo it
echo json_encode($places);
?>
