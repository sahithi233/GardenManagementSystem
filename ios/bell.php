<?php
$conn = mysqli_connect("localhost", "root", "", "gms");

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Create an array to store notifications
$notifications = array();

// Retrieve notifications from the database
$sql = "SELECT * FROM notifications";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $notification = array(
            'message' => $row['message']
        );
        $notifications[] = $notification;
    }
} else {
    echo json_encode(array('message' => 'No notifications found.'));
}

// Close the database connection
$conn->close();

// Encode the notifications array as JSON and output it
echo json_encode($notifications);
?>
