<?php
$conn = mysqli_connect("localhost", "root", "", "gms");

if (!$conn) {
    $response = array(
        'status' => 'error',
        'message' => 'Connection failed: ' . mysqli_connect_error()
    );
} else {
    // Get the current month and year
    $currentMonth = date('n');
    $currentYear = date('Y');

    // Check if the form is submitted
    if (isset($_POST['submit'])) {
        $selectedMonth = $_POST['month'];
        $selectedYear = $_POST['year'];
    } else {
        // If not submitted, use the current month and year
        $selectedMonth = $currentMonth;
        $selectedYear = $currentYear;
    }

    // Fetch data for the current month
    $currentMonthData = fetchData($conn, $currentMonth, $currentYear);

    // Fetch data for the selected month and year
    $selectedMonthData = fetchData($conn, $selectedMonth, $selectedYear);

    // Convert data to JSON
    $currentMonthJson = json_encode($currentMonthData);
    $selectedMonthJson = json_encode($selectedMonthData);

    $response = array(
        'status' => 'success',
        'message' => 'Data fetched successfully',
        'currentMonth' => $currentMonthJson,
        'selectedMonth' => $selectedMonthJson
    );

    mysqli_close($conn);
}

function fetchData($conn, $month, $year)
{
    // Query to retrieve week-wise average ratings for the selected month and year
    $sql = "SELECT
                worker AS worker_name,
                WEEK(date, 3) AS week_number,
                COALESCE(AVG(rating), 0) AS average_rating
            FROM
                jobs
            WHERE
                MONTH(date) = $month AND YEAR(date) = $year
            GROUP BY
                worker_name, week_number
            ORDER BY
                week_number";

    // Execute the query for the selected month and year
    $result = mysqli_query($conn, $sql);

    $data = array();

    if ($result) {
        while ($row = mysqli_fetch_assoc($result)) {
            $workerName = $row['worker_name'];
            $weekNumber = $row['week_number'];
            $averageRating = $row['average_rating'];

            if (!isset($data[$workerName])) {
                $data[$workerName] = array(
                    'worker_name' => $workerName,
                    'weeks' => array(),
                );
            }

            // Update the corresponding week in the $data array
            $data[$workerName]['weeks'][$weekNumber] = $averageRating;
        }

        // Free the result set
        mysqli_free_result($result);
    } else {
        $data = array();
        $response['status'] = 'error';
        $response['message'] = 'Error: ' . mysqli_error($conn);
    }

    return $data;
}
?>
