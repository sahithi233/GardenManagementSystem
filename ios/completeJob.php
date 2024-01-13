<?php
$conn = mysqli_connect("localhost", "root", "", "gms");

$response = array(); // Initialize the response array

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Retrieve the job ID, worker name, and rating
    $jid = $_POST['job_id'];
    $Supervisor = $_POST['name'];
    $rating = $_POST['rating'];
    $manager = $_GET['manager'];

    // Get the current date and time
    $currentDate = date('Y-m-d');
    $currentTime = date('H:i:s');

    // Update the database with the rating, end_date, and end_time for this worker
    $insertRatingQuery = "INSERT INTO ratings (job_id, Supervisor, rating) VALUES ('$jid', '$Supervisor', '$rating')";
    $updateJobQuery = "UPDATE jobs SET status = 'completed', manager = '$manager', end_date = '$currentDate', end_time = '$currentTime' WHERE job_id = '$jid'";

    $result = mysqli_query($conn, $insertRatingQuery);
    $data = mysqli_query($conn, $updateJobQuery);

    if ($result && $data) {
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
