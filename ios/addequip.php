<?php
// Set the appropriate content type for JSON
header('Content-Type: application/json');

// Initialize the response array with a default status
$response['status'] = false;

// Check if the request method is POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Establish a database connection
    $conn = mysqli_connect("localhost", "root", "", "gms");

    if (!$conn) {
        // If the connection fails, update the response and return an error message
        $response['message'] = 'Database connection failed';
    } else {
        // Retrieve and sanitize data from the POST request
        $tool_name = mysqli_real_escape_string($conn, $_POST['tool_name']);
        $quantity = mysqli_real_escape_string($conn, $_POST['quantity']);

        // Check if the tool with the same name already exists
        $checkSql = "SELECT * FROM tool WHERE tool_name = '$tool_name'";
        $checkResult = mysqli_query($conn, $checkSql);

        if (mysqli_num_rows($checkResult) > 0) {
            // If the tool already exists, update its quantity
            $updateSql = "UPDATE tool SET quantity = quantity + '$quantity' WHERE tool_name = '$tool_name'";
            if (mysqli_query($conn, $updateSql)) {
                $response['status'] = true;
                $response['message'] = 'Quantity updated successfully';
            } else {
                $response['message'] = 'Failed to update quantity';
            }
        } else {
            // If the tool doesn't exist, insert a new record
            $insertSql = "INSERT INTO tool (tool_name, quantity) VALUES ('$tool_name', '$quantity')";
            if (mysqli_query($conn, $insertSql)) {
                $response['status'] = true;
                $response['message'] = 'Tool added successfully';
            } else {
                $response['message'] = 'Failed to add Tool';
            }
        }

        // Close the database connection
        mysqli_close($conn);
    }
} else {
    // If the request method is not POST, return a message indicating the invalid request method
    $response['message'] = 'Invalid request method';
}

// Return the entire response as JSON
echo json_encode($response);
?>
