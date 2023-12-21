<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles.css">
    <title>Supervisor Dashboard</title>
      <style >
    /* Reset default margin and padding */
body, h1, h2, h3, ul, li, p {
  margin: 0;
  padding: 0;
}

body {
  font-family: Arial, sans-serif;
}

header {
  background-color: #E0C2B2;
  color: #fff;
  padding: 10px;
  display: flex;
}

h1{
  padding-left: 10px;
}
nav ul {
  list-style: none;
  text-align: right;
  background-color: #f0f0f0;
  padding: 10px;
}

nav li {
  margin-right: 20px;
  text-align: center;
  display: inline-block;
}

nav a {
  text-decoration: none;
  color: #333;
  font-weight: bold;
}
 .weather-container {
            max-width: 400px;
            margin: 0 auto;
            padding: 20px;
            background-color: #fff;
            border-radius: 5px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }

        h1 {
            font-size: 24px;
        }

        p {
            font-size: 18px;
        }

        .error {
            color: red;
        }
        table {
  width: 100%;
  border-collapse: collapse;
}

table, th, td {
  border: 1px solid #ccc;
}

th, td {
  padding: 10px;
  text-align: left;
}

th {
  background-color: #f0f0f0;
}
</style>
</head>
<body>
  <header>
    <img src="growise.jpg" height="30px" width="40px">
    <h1>GROWISE</h1>
  </header>
  <nav>
    <ul>
      <li><a href="bell.php"><img src="bell.svg"></a></li>
      <li><a href="assigntask.php">Assign Task</a></li>
      <li><a href="sjobs.php">Jobs</a></li>
      <li><a href="assets.php">Assets</a></li>
      <li><a href="sleaderboard.php">Leaderbooard</a></li>
      <li><a href="sprofile.php">Profile</a></li>
      <li><a href="logout.php">Logout</a></li>
    </ul>
  </nav>
<?php
$conn = mysqli_connect("localhost", "root", "", "gms");

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

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

// Display another table for the current month
// Query to retrieve week-wise average ratings for the current month
$currentMonthQuery = "SELECT
                        worker AS worker_name,
                        WEEK(date, 3) AS week_number,
                        COALESCE(AVG(rating), 0) AS average_rating
                    FROM
                        jobs
                    WHERE
                        MONTH(date) = $currentMonth AND YEAR(date) = $currentYear
                    GROUP BY
                        worker_name, week_number
                    ORDER BY
                        week_number";

// Execute the query for the current month
$currentMonthResult = mysqli_query($conn, $currentMonthQuery);

if ($currentMonthResult) {
    // Output the HTML table for the current month
    echo "<h2>$currentMonth,$currentYear</h2>";
    echo "<table border='1'  style='text-align:center;'>";
    echo "<tr><th>Sl. No</th><th>Worker Name</th>";

    // Fetch the distinct week numbers for the current month
    $currentMonthDistinctWeeksQuery = "SELECT DISTINCT WEEK(date, 3) AS week_number FROM jobs WHERE MONTH(date) = $currentMonth AND YEAR(date) = $currentYear ORDER BY week_number";
    $currentMonthDistinctWeeksResult = mysqli_query($conn, $currentMonthDistinctWeeksQuery);

    if ($currentMonthDistinctWeeksResult) {
        while ($weekRow = mysqli_fetch_assoc($currentMonthDistinctWeeksResult)) {
            echo "<th>Week " . $weekRow['week_number'] . "</th>";
        }

        mysqli_free_result($currentMonthDistinctWeeksResult);
    }

    echo "</tr>";

    $currentMonthWeeklyData = array();

    while ($row = mysqli_fetch_assoc($currentMonthResult)) {
        $workerName = $row['worker_name'];
        $weekNumber = $row['week_number'];
        $averageRating = $row['average_rating'];

        if (!isset($currentMonthWeeklyData[$workerName])) {
            $currentMonthWeeklyData[$workerName] = array(
                'worker_name' => $workerName,
                'weeks' => array(),
            );
        }

        // Update the corresponding week in the $currentMonthWeeklyData array
        $currentMonthWeeklyData[$workerName]['weeks'][$weekNumber] = $averageRating;
    }

    // Display the final table using the $currentMonthWeeklyData array
    $slNo = 1;
    foreach ($currentMonthWeeklyData as $rowData) {
        echo "<tr>";
        echo "<td>" . $slNo++ . "</td>";
        echo "<td>" . $rowData['worker_name'] . "</td>";

        // Display the average rating for each week
        foreach ($rowData['weeks'] as $weekNumber => $averageRating) {
            echo "<td>" . $averageRating . "</td>";
        }

        echo "</tr>";
    }

    echo "</table>";

    // Free the result set for the current month
    mysqli_free_result($currentMonthResult);
} else {
    echo "Error: " . mysqli_error($conn);
}


mysqli_close($conn);
?>
<br>
<!-- Display form to select month and year -->
<form method="post" action="">
    <label for="month">Select Month:</label>
    <select name="month" id="month">
        <?php
        foreach ($distinctMonths as $monthData) {
            $monthNumber = $monthData['month'];
            echo "<option value='$monthNumber'" . ($monthNumber == $selectedMonth ? " selected" : "") . ">$monthNumber</option>";
        }
        ?>
    </select>

    <label for="year">Select Year:</label>
    <input type="text" name="year" id="year" placeholder="Enter Year" value="<?php echo $selectedYear; ?>" required>

    <input type="submit" name="submit" value="Show Data">
</form>

<?php

    $conn = mysqli_connect("localhost", "root","","gms");

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// Query to retrieve distinct months present in the database
$distinctMonthsQuery = "SELECT DISTINCT MONTH(date) AS month FROM jobs";
$distinctMonthsResult = mysqli_query($conn, $distinctMonthsQuery);

if ($distinctMonthsResult) {
    $distinctMonths = mysqli_fetch_all($distinctMonthsResult, MYSQLI_ASSOC);
    mysqli_free_result($distinctMonthsResult);
} else {
    echo "Error: " . mysqli_error($conn);
}

// Query to retrieve week-wise average ratings for the selected month and year
$sql = "SELECT
            worker AS worker_name,
            WEEK(date, 3) AS week_number,
            COALESCE(AVG(rating), 0) AS average_rating
        FROM
            jobs
        WHERE
            MONTH(date) = $selectedMonth AND YEAR(date) = $selectedYear
        GROUP BY
            worker_name, week_number
        ORDER BY
            week_number";

// Execute the query for the selected month and year
$result = mysqli_query($conn, $sql);

if ($result) {
    // Output the HTML table for the selected month and year
    echo "<h2>Month $selectedMonth, Year $selectedYear Data</h2>";
    echo "<table border='1'>";
    echo "<tr><th>Sl. No</th><th>Worker Name</th>";

    // Fetch the distinct week numbers for the selected month and year
    $distinctWeeksQuery = "SELECT DISTINCT WEEK(date, 3) AS week_number FROM jobs WHERE MONTH(date) = $selectedMonth AND YEAR(date) = $selectedYear ORDER BY week_number";
    $distinctWeeksResult = mysqli_query($conn, $distinctWeeksQuery);

    if ($distinctWeeksResult) {
        while ($weekRow = mysqli_fetch_assoc($distinctWeeksResult)) {
            echo "<th>Week " . $weekRow['week_number'] . "</th>";
        }

        mysqli_free_result($distinctWeeksResult);
    }

    echo "</tr>";

    $weeklyData = array();

    while ($row = mysqli_fetch_assoc($result)) {
        $workerName = $row['worker_name'];
        $weekNumber = $row['week_number'];
        $averageRating = $row['average_rating'];

        if (!isset($weeklyData[$workerName])) {
            $weeklyData[$workerName] = array(
                'worker_name' => $workerName,
                'weeks' => array(),
            );
        }

        // Update the corresponding week in the $weeklyData array
        $weeklyData[$workerName]['weeks'][$weekNumber] = $averageRating;
    }

    // Display the final table using the $weeklyData array
    $slNo = 1;
    foreach ($weeklyData as $rowData) {
        echo "<tr>";
        echo "<td>" . $slNo++ . "</td>";
        echo "<td>" . $rowData['worker_name'] . "</td>";

        // Display the average rating for each week
        foreach ($rowData['weeks'] as $weekNumber => $averageRating) {
            echo "<td>" . $averageRating . "</td>";
        }

        echo "</tr>";
    }

    echo "</table>";
} else {
    echo "Error: " . mysqli_error($conn);
}
?>



</center>
</body>
</html>
