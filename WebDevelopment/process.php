<?php
session_start();
$conn = mysqli_connect("localhost", "root", "", "gms");

if (isset($_POST['submit'])) {
    $task = $_POST['task'];
    $date = $_POST['date'];
    $start_time = $_POST['start_time'];
    $supervisor = $_SESSION['name'];

    function generateJobID()
    {
        $characters = '0123456789';
        $jobID = '';

        for ($i = 0; $i < 5; $i++) {
            $jobID .= $characters[rand(0, strlen($characters) - 1)];
        }

        return $jobID;
    }

    $uniqueJobID = generateJobID();
    echo "Unique Job ID: $uniqueJobID";

    if (isset($_POST['worker']) && is_array($_POST['worker'])) {
        foreach ($_POST['worker'] as $worker) {
            $sql = "INSERT INTO jobs(job_id, task, status, worker, supervisor, date, start_time) VALUES ('$uniqueJobID', '$task', 'upcoming', '$worker', '$supervisor', '$date', '$start_time')";
            
            $data = mysqli_query($conn, $sql);
            
            if (!$data) {
                echo "Error: " . $sql . "<br>" . mysqli_error($conn);
            }
        }

        if ($data) {
            // Get the last inserted job ID
            $job_id = mysqli_insert_id($conn);
            // Update the status for the specific job ID
            $update_sql = "UPDATE jobs SET status = 'upcoming' WHERE job_id = '$uniqueJobID'";
            mysqli_query($conn, $update_sql);
            
            // Redirect to the dashboard
            header("location: sdashboard.php");
        } else {
            echo "Error inserting data.";
        }
    }
}
?>
