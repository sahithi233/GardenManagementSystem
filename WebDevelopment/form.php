<?php
// Establish a database connection

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Retrieve user ID and action
    $userId = $_POST['userId'];
    $action = $_POST['action'];

    // Perform a database update to change the user's status
    $conn = mysqli_connect("localhost", "root", "", "gms");

    if (!$conn) {
        echo json_encode(['success' => false, 'message' => 'Database connection failed']);
    } else {
        if ($action === 'activate') {
            // SQL query to activate the user
            $sql = "UPDATE users SET status = 'active' WHERE id = $userId";
        } elseif ($action === 'deactivate') {
            // SQL query to deactivate the user
            $sql = "UPDATE users SET status = 'inactive' WHERE id = $userId";
        }

        // Check if the database update was successful
        if (mysqli_query($conn, $sql)) {
            echo json_encode(['success' => true, 'message' => 'Account status updated successfully']);
        } else {
            echo json_encode(['success' => false, 'message' => 'Failed to update account status']);
        }

        // Close the database connection
        mysqli_close($conn);
    }
}
?>
