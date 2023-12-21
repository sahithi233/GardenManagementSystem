<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="styles.css">
  <title>Admin Dashboard</title>
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
a{
  text-decoration: none;
  color: white;
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

section {
            margin-bottom: 30px;
            padding: 20px;
            border: 1px solid #ddd;
            background-color: white;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }
section h2{
  text-align: center;
}
/* ... Your existing CSS styles ... */

.employee-table {
  margin-top: 20px;
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

.search-bar {
  width: 100%;
    position: relative;
    display: flex;
    align-items: center;
}

/* Style for the search icon */
.search-icon {
    font-size: 20px; /* Adjust the size of the search icon */
    margin-right: 10px; /* Adjust the spacing between the icon and input */
    color: #333; /* Icon color */
}

/* Style for the search input */
.search-input {
    padding: 10px; /* Adjust the padding inside the input */
    border: 1px solid #ccc; /* Border color */
    border-radius: 5px; /* Rounded corners */
    font-size: 16px; /* Adjust the font size */
    width: 200px; /* Adjust the width of the input */
    outline: none; /* Remove the outline when focused */
}

/* Style for the placeholder text inside the input */
.search-input::placeholder {
    color: #999; /* Placeholder text color */
}



 .highlight {
            background-color: #f0f0f0 ;
            font-weight: bold;
        }

  </style>
</head>
<body>
  <header>
    <img src="growise.jpg" height="30px" width="40px">
    <h1><a href="adashboard.php"style="text-decoration:none;">GROWISE</h1>
  </header>
  <nav>
    <ul>
      <li><a href="addemp.php"style="text-decoration:none;">ADD USERS</a></li>
      <li><a href="profile.php"style="text-decoration:none;">PROFILE</a></li>
      <li><a href="logout.php"style="text-decoration:none;">LOG OUT</a></li>
    </ul>
  </nav>
     <div class="employee-table">
      <div class="search-bar">
            <span class="search-icon">&#128269;</span>
            <input type="text" id="search-input" class="search-input" placeholder="Search...">
</div><br>
<div id="content">
      <table>
        <thead>
          <tr>
            <th>Sl.No</th>
            <th>Job id</th>
            <th>Task</th>
            <th>Supervisor Incharge</th>
            <th>date</th>
            <th>Start time</th>
            <th>End date</th>
            <th>End time</th>
          </tr>
        </thead>
        <tbody>
                    <!-- Loop through the data retrieved from the database -->
                    <?php
                    $conn = mysqli_connect("localhost", "root","","gms");

  $sql="SELECT  * FROM jobs" ;
    $data = mysqli_query($conn,$sql);

                    $S_No = 1;
                    while ($row = mysqli_fetch_assoc($data)) {
                        echo "<tr>";
                        echo "<td>" . $S_No. "</td>";
                        echo "<td>" . $row['job_id'] . "</td>";
                        echo "<td>" . $row['task'] . "</td>";
                        echo "<td>". $row['supervisor'] .  "</td>";
                        echo "<td>" . $row['date'] . "</td>";
                        echo "<td>" . $row['start_time'] . "</td>";
                        echo "<td>" . $row['end_date'] . "</td>";
                        echo "<td>" . $row['end_time'] . "</td>";
                        echo "</tr>";

                        $S_No++;
                    }
                    ?>
                </tbody>
      </table>
    </div>
</div>
  <script>
        document.addEventListener("DOMContentLoaded", function () {
            const searchInput = document.getElementById("search-input");
            const content = document.querySelectorAll("#content tbody tr");

            searchInput.addEventListener("input", function () {
                const query = searchInput.value.toLowerCase();

                // Loop through content and highlight matching items
                content.forEach((row) => {
                    const itemText = row.textContent.toLowerCase();
                    if (itemText.includes(query)) {
                        row.classList.add("highlight");
                    } else {
                        row.classList.remove("highlight");
                    }
                });
            });
        });
    </script>
</body>
</html>
