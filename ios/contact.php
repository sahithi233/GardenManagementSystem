<?php
// Set the appropriate content type for JSON
header('Content-Type: application/json');

$conn = mysqli_connect("localhost", "root", "", "gms");

if (!$conn) {
    echo json_encode(['status' => false, 'message' => 'Connection failed: ' . mysqli_connect_error()]);
} else {
    // Define the message you want to send
    $message = $_POST['message'];
    $supervisor = mysqli_real_escape_string($conn, $_POST['supervisor']); // Sanitize input

    // Insert a notification for the specified supervisor with the given message into a notifications table
    $insert_sql = "INSERT INTO notifications (supervisor, message) VALUES ('$supervisor', '$message')";
    $inserted = mysqli_query($conn, $insert_sql);

    if ($inserted) {
        echo json_encode(['status' => true, 'message' => 'Notification sent successfully']);
    } else {
        echo json_encode(['status' => false, 'message' => 'Failed to send notification']);
    }

    // Close the database connection
    mysqli_close($conn);
}
?>
