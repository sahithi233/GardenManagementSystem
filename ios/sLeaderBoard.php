<?php
$conn = mysqli_connect("localhost", "root", "", "gms");

$response = array(); // Initialize the response array

if ($conn) {
    // Get the current month and year
    $currentMonth = date('n');
    $currentYear = date('Y');

    // Fetch data for the current month
    $currentMonthData = fetchData($conn, $currentMonth, $currentYear);

    // Convert data to the specified JSON format
    $formattedData = array();
    foreach ($currentMonthData as $workerName => $weeks) {
        $formattedData[] = array(
            'worker' => $workerName,
            'week' => $weeks,
        );
    }

    // Create the final response
    $response = array(
        'status' => true,
        'message' => 'Data fetched successfully',
        'data' => $formattedData,
    );

    mysqli_close($conn);
} else {
    // Handle the case where the database connection fails
    $response['status'] = false;
    $response['message'] = 'Connection failed: ' . mysqli_connect_error();
}

function fetchData($conn, $month, $year)
{
    // Calculate the starting date of the last 4 weeks from the current date
    $startDate = date('Y-m-d', strtotime('-3 weeks'));

    // Query to retrieve week-wise average ratings for the last 4 weeks
    $sql = "SELECT
                worker AS worker_name,
                WEEK(date, 3) AS week_number,
                COALESCE(AVG(rating), 0) AS average_rating
            FROM
                jobs
            WHERE
                MONTH(date) = $month AND YEAR(date) = $year
                AND date >= '$startDate'
            GROUP BY
                worker_name, week_number
            ORDER BY
                week_number DESC";

    // Execute the query for the selected month and year
    $result = mysqli_query($conn, $sql);

    $data = array();

    if ($result) {
        while ($row = mysqli_fetch_assoc($result)) {
            $workerName = $row['worker_name'];
            $weekNumber = $row['week_number'];
            $averageRating = $row['average_rating'];

            if (!isset($data[$workerName])) {
                $data[$workerName] = array();
            }

            // Update the corresponding week in the $data array
            $data[$workerName][$weekNumber] = number_format($averageRating, 1);
        }

        // Free the result set
        mysqli_free_result($result);
    } else {
        $data = array();
    }

    return $data;
}


echo json_encode($response, JSON_PRETTY_PRINT);
?>
