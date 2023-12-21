<?php
$conn = mysqli_connect("localhost", "root", "", "gms");

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$selectedLocation = 'location2'; // Replace with the actual location

$query = "SELECT u.mobile_no
          FROM user u
          JOIN team t ON u.name = t.workers
          WHERE t.location = '$selectedLocation'";

$result = mysqli_query($conn, $query);

if ($result) {
    while ($row = mysqli_fetch_assoc($result)) {
        echo "Mobile Number: " . $row['mobile_no'] . "<br>";
    }
} else {
    echo "Error executing query: " . mysqli_error($conn);
}

mysqli_close($conn);
?>
