<?php
// Establish a database connection
$conn = mysqli_connect("localhost", "root", "", "gms");

// Check if the connection was successful
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// Create an array to store the results
$results = array();
$supervisor = $_GET['supervisor'];

// Create a prepared statement
$stmt = mysqli_prepare($conn, "SELECT DISTINCT u.name AS worker_name, u.role, u.mobile_no, u.dob
FROM team t
JOIN user u ON t.workers = u.name
WHERE t.name = ? AND u.status = 'Active'");


// Check if the statement was prepared successfully
if ($stmt) {
    // Bind the parameter
    mysqli_stmt_bind_param($stmt, "s", $supervisor);

    // Execute the statement
    mysqli_stmt_execute($stmt);

    // Bind the result variable
    mysqli_stmt_bind_result($stmt, $workerName, $role, $mobileNo, $dob);


    // Fetch the results
   while (mysqli_stmt_fetch($stmt)) {
    // Add each row to the results array
    $results[] = array(
        'workers' => $workerName,
        'role' => $role,
        'mobile_no' => $mobileNo,
        'dob' => $dob
    );
    }

    // Close the statement
    mysqli_stmt_close($stmt);
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
