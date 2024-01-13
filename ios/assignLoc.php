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
        $supervisor = mysqli_real_escape_string($conn, $_POST['name']);
        $location = mysqli_real_escape_string($conn, $_POST['location']);
        $workers = $_POST['workers']; // Note that "workers" should be an array.
        $manager = $_GET['manager'];
        if (is_array($workers) && !empty($workers)) {
            // Initialize an empty array to store the escaped worker data
            $escapedWorkers = array();

            foreach ($workers as $worker) {
                // Escape each worker value and store it in the escapedWorkers array
                $escapedWorker = mysqli_real_escape_string($conn, $worker);
                $escapedWorkers[] = $escapedWorker;

                $sql = "INSERT INTO team(manager, name, location, workers) VALUES ('$manager','$supervisor', '$location', '$escapedWorker')";
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