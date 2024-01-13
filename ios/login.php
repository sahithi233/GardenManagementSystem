<?php
error_reporting(0);
$conn = mysqli_connect("localhost", "root", "", "gms");

// Get user input
$Username = $_GET['Username'];
$Password = $_GET['Password'];
$status = "Active";

// Database query
$loginqry = "SELECT id,Username,Password,role,name,status FROM user WHERE Username = '$Username' AND Password = '$Password' AND status = '$status'";
$qry = mysqli_query($conn, $loginqry);

// Prepare the response
$response = [];

if (mysqli_num_rows($qry) > 0) {
    $userArray = [];
    while ($userObj = mysqli_fetch_assoc($qry)) {
        $userArray[] = $userObj;
    }
    $response['status'] = true;
    $response['message'] = "Login Successfully";
    $response['data'] = $userArray;
} else {
    $response['status'] = false;
    $response['message'] = "Login Failed";
}

// Set the HTTP response headers
header('Content-Type: application/json; charset=UTF-8');

// Send the JSON response
echo json_encode($response);
?>