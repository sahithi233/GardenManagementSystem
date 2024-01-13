<?php
$conn = mysqli_connect("localhost", "root", "", "gms");

if (!$conn) {
    // Handle the case where the database connection fails
    $response = array('status' => false, 'message' => 'Connection failed: ' . mysqli_connect_error());
} else {
    $id = $_POST['id'];

    // Delete the asset from the database
    $deleteQuery = "UPDATE assets SET status = 'approved' WHERE id = ?";
    $stmt = mysqli_prepare($conn, $deleteQuery);

    // Bind parameters and execute the statement
    mysqli_stmt_bind_param($stmt, "i", $id);
    $result = mysqli_stmt_execute($stmt);

    if ($result) {
        // Asset deleted successfully
        $response = array('status' => true, 'message' => 'Asset Approved successfully');
    } else {
        // Error deleting asset
        $response = array('status' => false, 'message' => 'Error Approving asset: ' . mysqli_error($conn));
    }
}

// Close the database connection
mysqli_close($conn);

// Set the response content type to JSON
header('Content-Type: application/json');

// Encode the response array as JSON and echo it
echo json_encode($response);
?>
