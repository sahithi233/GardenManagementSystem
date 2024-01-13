<?php
$conn = mysqli_connect("localhost", "root", "", "gms");

$sql = "SELECT * FROM team";
$data = mysqli_query($conn, $sql);

// Create an array to store the results
$teamData = array();

while ($row = mysqli_fetch_assoc($data)) {
    // Append each row to the array
    $teamData[] = $row;
}

// Convert the array to JSON
$jsonData = json_encode($teamData);

// Set the appropriate content type for JSON
header('Content-Type: application/json');

// Output the JSON data
echo $jsonData;

// Close the database connection
mysqli_close($conn);
?>
