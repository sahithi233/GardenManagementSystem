<?php
    $conn = mysqli_connect("localhost", "root", "", "gms");
    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Create an array to store places
    $places = array();

    // Retrieve places from the database
    $sql = "SELECT * FROM places";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $place = array(
                'place_id' => $row['place_id'],
                'place_name' => $row['place_name']
            );
            $places[] = $place;
        }
    } else {
        echo json_encode(array('message' => 'No places found.'));
    }

    // Close the database connection
    $conn->close();

    // Encode the places array as JSON and output it
    echo json_encode($places);
?>
