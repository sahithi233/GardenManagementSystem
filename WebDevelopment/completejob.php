<?php
$conn = mysqli_connect("localhost", "root", "", "gms");

if (isset($_POST['submit'])) {
    // Retrieve the job ID, worker name, and rating
    $jobid = $_POST['job_id'];
    $supervisor = $_POST['supervisor'];
    $rating = $_POST['rating'];

    // Update the user rating
    $updateUserRating = "UPDATE user SET rating = '$rating' WHERE name = '$supervisor'";
    $resultUserRating = mysqli_query($conn, $updateUserRating);

    // Update the job status to completed and set the end time if it's NULL
    $updateJobStatus = "UPDATE jobs SET status = 'completed' WHERE job_id = '$jobid'";
    $resultJobStatus = mysqli_query($conn, $updateJobStatus);
    $resultUserRating = mysqli_query($conn, $updateUserRating);
if (!$resultUserRating) {
    die("Error updating user rating: " . mysqli_error($conn));
}

$resultJobStatus = mysqli_query($conn, $updateJobStatus);
if (!$resultJobStatus) {
    die("Error updating job status: " . mysqli_error($conn));
}
    if ($resultUserRating && $resultJobStatus) {
        header("location: mdashboard.php");
    } else {
        header("location: jobs.php");
    }
}
?>
