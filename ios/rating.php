<?php
$conn = mysqli_connect("localhost", "root", "", "gms");

$response = array(); // Initialize the response array

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Retrieve the job ID, worker name, and rating
    $job_id = $_POST['iii'];
    $workerName = $_POST['name'];
    $rating = $_POST['rating'];

    // Insert the rating into the ratings table
    

    // Update the status and end time in the jobs table
    $updateJobQuery = "UPDATE jobs SET status = 'pending',rating = '$rating', end_time = NOW() WHERE iii='$job_id'";
    $updateJobResult = mysqli_query($conn, $updateJobQuery);

    if ($updateJobResult) {
        // Success
        $response['status'] = true;
        $response['message'] = "Update successful";
    } else {
        // Error handling
        $response['status'] = false;
        $response['message'] = "Error: " . mysqli_error($conn);
    }
} else {
    // Handle the case where the form is not submitted
    $response['status'] = false;
    $response['message'] = "Form not submitted";
}

// Close the database connection
mysqli_close($conn);

// Set the response content type to JSON
header("Content-Type: application/json");

// Encode the response array as JSON and echo it
echo json_encode($response);
?>
