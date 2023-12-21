<?php
session_start();
$conn = mysqli_connect("localhost", "root", "", "gms");

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['id'])) {
    $notificationId = $_POST['id'];

    $deleteQuery = "DELETE FROM notifications WHERE id = $notificationId";
    $deleteResult = mysqli_query($conn, $deleteQuery);

    if ($deleteResult) {
        // Redirect to the referring page after successful deletion
        header("location: ".$_SERVER['HTTP_REFERER']);
        exit();
    }
}

// If the script reaches here, it means there was an error or an invalid request
die("Error deleting notification.");
?>
