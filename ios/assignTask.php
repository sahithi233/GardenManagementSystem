<?php
// Set the appropriate content type for JSON
header('Content-Type: application/json');

// Initialize the response array
$response = array('status' => false, 'message' => '');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $conn = mysqli_connect("localhost", "root", "", "gms");

    if (!$conn) {
        $response['message'] = 'Database connection failed';
    } else {
        $task = mysqli_real_escape_string($conn, $_POST['task']);
        $date = mysqli_real_escape_string($conn, $_POST['date']);
        $start_time = mysqli_real_escape_string($conn, $_POST['start_time']);
        $workers = $_POST['workers']; // Note that "workers" should be an array.

    $supervisor = $_GET['name'];
           function generateJobID() {
            $characters = '0123456789';
            $jobID = '';

            for ($i = 0; $i < 5; $i++) {
                $jobID .= $characters[rand(0, strlen($characters) - 1)];
            }

            return $jobID;
        }

        $uniqueJobID = generateJobID();

        if (is_array($workers) && !empty($workers)) {
            // Initialize an empty array to store the escaped worker data
            $escapedWorkers = array();

            foreach ($workers as $worker) {
                // Escape each worker value and store it in the escapedWorkers array
                
                $sql = "INSERT INTO jobs(job_id, task, status, worker, supervisor, date, start_time) VALUES ('$uniqueJobID', '$task', 'upcoming', '$worker', '$supervisor', '$date', '$start_time')";
                $result = mysqli_query($conn, $sql);

                if (!$result) {
                    $response['message'] = 'Failed to insert data into the team table';
                    break; // Exit the loop if an error occurs
                }
            }

            if (empty($response['message'])) {
                $response['status'] = true;
                $response['message'] = 'Data inserted successfully';
            }
        } else {
            $response['message'] = 'No worker data provided';
        }

        // Close the database connection
        mysqli_close($conn);
    }
} else {
    $response['message'] = 'Invalid request method';
}

// Return the entire response as JSON
echo json_encode($response);
?>