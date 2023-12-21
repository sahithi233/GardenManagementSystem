<?php
$conn = mysqli_connect("localhost", "root", "", "gms");

if (isset($_POST['submit'])) {
    // Retrieve the job ID, worker name, and rating
    $jid = $_POST['job_id'];
    $workerName = $_POST['worker'];
    $rating = $_POST['rating'];

    // Update the database with the rating, status, end_time, and end_date for this job
    $query = "UPDATE jobs 
              SET status = 'pending', 
                  end_time = NOW(), 
                  end_date = CURRENT_DATE, 
                  rating = '$rating' 
              WHERE job_id = '$jid'";

    $result = mysqli_query($conn, $query);

    if ($result) {
        // Success
        header("location: sdashboard.php");
    } else {
        // Error handling
        echo "Error: " . mysqli_error($conn);
    }
}

mysqli_close($conn);
?>
