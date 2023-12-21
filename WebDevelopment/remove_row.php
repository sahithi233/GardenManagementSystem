<?php
// remove_row.php

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['team_id'])) {
    $conn = mysqli_connect("localhost", "root", "", "gms");

    $teamId = mysqli_real_escape_string($conn, $_POST['team_id']);

    $sql = "DELETE FROM team WHERE team_id = '$teamId'";
    $result = mysqli_query($conn, $sql);

    // Return a response (you can customize this based on your needs)
    if ($result) {
        echo "Row removed successfully";
    } else {
        echo "Error removing row: " . mysqli_error($conn);
    }

    mysqli_close($conn);
}
?>
