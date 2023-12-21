<?php
$conn = mysqli_connect("localhost", "root","","gms");

  $sql="SELECT  * FROM jobs" ;
    $data = mysqli_query($conn,$sql);
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


.task {
  display: flex;
  justify-content: space-between;
  align-items: center;
  border: 1px solid #ddd;
  padding: 20px;
  margin-bottom: 20px;
}

.task-info {
  flex-grow: 1;
  margin-right: 20px;
}



button {
  background-color: #e0c2b2;
  color: #fff;
  padding: 10px 20px;
  border: none;
  border-radius: 5px;
  cursor: pointer;
}
a{
  text-decoration: none;
  color: white;
}

nav a {
  text-decoration: none;
  color: #333;
  font-weight: bold;
}
.x{
  width: 60%;
  display:flex;
  margin-left:20%;
  flex-direction:column;
  
}

section{
width: 90%;
height:100%;
margin: 10px;
text-align: center;
 border: 0px solid #ccc; 
  padding-top: 10px;
  padding-bottom: 10px;
  border-width: 40%;
  border-radius: 20px;
  box-shadow:
    0 0 0 1px white,
    0.3em 0.3em 1em rgba(78, 65,65,0.6)
}

p{
  display: flex;
}

strong{
  display: flex;
}
</style>
</head>
<body>
  <header>
    <img src="growise.jpg" height="30px" width="40px">
    <h1><a href="sdashboard.php">GROWISE</h1>
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
  <center>
       <div class="task-list">
    <h1>Task Status</h1><br><br>
    <label for="viewSelect">View:</label>
    <select id="viewSelect" onchange="filterTasks()">
        <option value="all">All</option>
        <option value="upcoming">Upcoming</option>
        <option value="pending">Pending</option>
        <option value="completed">Completed</option>
    </select><br>
    </center>
   <div class="task" data-status="completed">
<div class="x">
<?php
$tasks = array(); // Initialize an empty array to store tasks

while ($row = mysqli_fetch_assoc($data)) {
    $task = "<section class='task'>";
    $task .= "<div class='task-info'>";
    $task .= "<p><strong>Job ID:</strong> " . $row['job_id'] . "</p>";
    $task .= "<p><strong>Worker Name:</strong> " . $row['worker'] . " </p>";
    $task .= "<p><strong>Date:</strong> " . $row['date'] . "</p>";
    $task .= "<p><strong>Status:</strong> " . $row['status'] . "</p>";
    $task .= "</div>";

    // Add a form for rating (hidden by default)
    $task .= "<form class='rating-form' action='rating.php' method='post'>";
    $jid = $row['job_id'];
    $workerName = $row['worker'];

    // Include the job ID and worker name as hidden inputs
    $task .= "<input type='hidden' name='job_id' value='$jid'>";
    $task .= "<input type='hidden' name='worker' value='$workerName'>";

    $task .= "<label for='rating'><strong>Rate worker:</strong></label>";
    $task .= "<select id='rating' name='rating'>";
    $task .= "<option value='1'>1 (Poor)</option>";
    $task .= "<option value='2'>2 (Fair)</option>";
    $task .= "<option value='3'>3 (Average)</option>";
    $task .= "<option value='4'>4 (Good)</option>";
    $task .= "<option value='5'>5 (Excellent)</option>";
    $task .= "</select>";
    $task .= "<br><br>";
    $task .= "<button type='submit' name='submit'>Complete</button>";

    $task .= "</form>";
    $task .= "</section>";

    // Add the task to the array
    array_unshift($tasks, $task);
}

// Display the tasks
foreach ($tasks as $task) {
    echo $task;
}
?>

</div>



<script>
    function filterTasks() {
        const viewSelect = document.getElementById('viewSelect');
        const status = viewSelect.value.toLowerCase(); // Convert to lowercase for consistency

        const tasks = document.querySelectorAll('.task');

        tasks.forEach(task => {
            const taskStatus = task.getAttribute('data-status');

            if (status === 'all' || taskStatus === status) {
                task.style.display = 'block';
            } else {
                task.style.display = 'none';
            }
        });
    }
</script>


</div>


</body>
</html>
