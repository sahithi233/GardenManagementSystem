<?php
$conn = mysqli_connect("localhost", "root", "", "gms");

$response = array('status' => false, 'message' => '');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $tool_name = $_POST['supervisor'];
    $tool = $_POST['asset'];
    $quantity = $_POST['quantity'];

    // Check if the entered quantity is greater than the existing quantity in the tool table
    $checkQuantityQuery = "SELECT quantity FROM tool WHERE tool_name='$tool'";
    $checkQuantityResult = mysqli_query($conn, $checkQuantityQuery);

    if ($checkQuantityResult) {
        $row = mysqli_fetch_assoc($checkQuantityResult);
        $existingQuantity = $row['quantity'];

        // Check if the entered quantity is less than or equal to the existing quantity
        if ($quantity <= $existingQuantity) {
            // Check if the tool is already assigned to the supervisor
            $checkQuery = "SELECT * FROM assets WHERE supervisor='$tool_name' AND asset='$tool'";
            $checkResult = mysqli_query($conn, $checkQuery);

            if ($checkResult) {
                // If the tool is already assigned, update the quantity
                if (mysqli_num_rows($checkResult) > 0) {
                    $updateQuery = "UPDATE assets SET quantity = quantity + $quantity WHERE supervisor='$tool_name' AND asset='$tool'";
                    $updateResult = mysqli_query($conn, $updateQuery);

                    if ($updateResult) {
                        // Quantity updated successfully

                        // Decrease the tool quantity in the tools table
                        $decreaseQuery = "UPDATE tool SET quantity = quantity - $quantity WHERE tool_name='$tool'";
                        $decreaseResult = mysqli_query($conn, $decreaseQuery);

                        if ($decreaseResult) {
                            // Tool quantity decreased successfully
                            $response['status'] = true;
                            $response['message'] = 'Tool allotted successfully';
                        } else {
                            // Error decreasing tool quantity
                            $response['message'] = 'Error decreasing tool quantity: ' . mysqli_error($conn);
                        }
                    } else {
                        // Error updating quantity
                        $response['message'] = 'Error updating quantity: ' . mysqli_error($conn);
                    }
                } else {
                    // If the tool is not assigned, insert a new record
                    $insertQuery = "INSERT INTO assets(supervisor, asset, quantity) VALUES ('$tool_name', '$tool', '$quantity')";
                    $insertResult = mysqli_query($conn, $insertQuery);

                    if ($insertResult) {
                        // Data inserted successfully

                        // Decrease the tool quantity in the tools table
                        $decreaseQuery = "UPDATE tool SET quantity = quantity - $quantity WHERE tool_name='$tool'";
                        $decreaseResult = mysqli_query($conn, $decreaseQuery);

                        if ($decreaseResult) {
                            // Tool quantity decreased successfully
                            $response['status'] = true;
                            $response['message'] = 'Tool assigned and quantity decreased successfully';
                        } else {
                            // Error decreasing tool quantity
                            $response['message'] = 'Error decreasing tool quantity: ' . mysqli_error($conn);
                        }
                    } else {
                        // Error inserting data
                        $response['message'] = 'Error inserting data: ' . mysqli_error($conn);
                    }
                }
            } else {
                // Error checking existing assignments
                $response['message'] = 'Error checking existing assignments: ' . mysqli_error($conn);
            }
        } else {
            // Quantity being allotted is more than the existing quantity
            $response['message'] = 'Error: Quantity being allotted is more than the existing quantity';
        }
    } else {
        // Error checking existing quantity
        $response['message'] = 'Error checking existing quantity: ' . mysqli_error($conn);
    }
}

// Return the response as JSON
echo json_encode($response);
?>
