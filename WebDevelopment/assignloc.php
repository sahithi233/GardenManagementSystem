<?php
$conn = mysqli_connect("localhost", "root", "", "gms");
$sq = "SELECT name FROM user  where role = 'supervisor' ";
$dat = mysqli_query($conn, $sq);
?>
<?php
$conn = mysqli_connect("localhost", "root","","gms");

  $sql="SELECT  * FROM team" ;
    $data = mysqli_query($conn,$sql);

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="styles.css">
  <title>Garden Management System</title>
  <style>
    /* Reset default margin and padding */
    body, h1, h2, h3, ul, li, p {
      margin: 0;
      padding: 0;
    }

    a {
      text-decoration: none;
    }

    body {
      font-family: Arial, sans-serif;
      background-color: #fff;
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
    header img {
      margin-right: 10px;
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
      font-size: 16px;
      font-weight: bold;
    }

    nav a:hover {
      color: #e0c2b2;
    }
    a{
      text-decoration: none;
      color: white;
    }
    .assign-form {
      width: 80%;
      margin: 20px auto;
      background-color: #fff;
      padding: 20px;
      border-radius: 10px;
      box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    }
    .employee-table{
      width: 83%;
    }
    .form-group {
      margin-bottom: 20px;
    }

    label {
      display: flex;
      font-weight: bold;
    }

    select,
    input[type="checkbox"] {
      width: 100%;
      padding: 10px;
      border: 1px solid #ccc;
      border-radius: 4px;
    }

    input[type="submit"] {
      background-color: #e0c2b2;
      color: #fff;
      padding: 10px 20px;
      border: none;
      border-radius: 5px;
      cursor: pointer;
      font-weight: bold;
    }

    

    /* Style for the worker checkboxes */
    .worker-list {
      display: flex;
      flex-wrap: wrap;
    }
table {
  width: 100%;
  border-collapse: collapse;
}

table, th, td {
  border: 1px solid #ccc;
  background-color: white;
}

th, td {
  padding: 10px;
  text-align: left;
}

th {
  background-color: #fff;
}
 .highlight {
            background-color: #f0f0f0 ;
            font-weight: bold;
        }

a{
  text-decoration: none;
  color: white;
}
/* Style for the search bar */
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

    .worker-item {
      margin-right: 10px;
      margin-bottom: 10px;
      display: flex;
      align-items: center;
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
      <li><a href="jobs.php">Jobs</a></li>
      <li><a href="mbell.php"><img src="bell.svg"></a></li>
      <li><a href="profile.php">PROFILE</a></li>
      <li><a href="logout.php">LOG OUT</a></li>
    </ul>
  </nav>
  <center>
    <div class="assign-form">
      <form action="process_form.php" method="post">
        <div class="form-group">
          <label for="location-select">Select Supervisor</label>
          <select id="location-select" name="supervisor">
            <?php
          while ($row = mysqli_fetch_assoc($dat)) {
            echo '<option>' . $row['name'] . '</option>';
          }
          ?>
          </select>
        </div>

        <div class="form-group">
          <label>Select workers:</label>
          <div class="worker-list">
            <?php
            $query = "SELECT id, name
FROM user
WHERE role = 'worker' AND NOT EXISTS (
    SELECT 1
    FROM team
    WHERE team.workers = user.name
)";
            $result = mysqli_query($conn, $query);

            while ($row = mysqli_fetch_assoc($result)) {
              echo '<div class="worker-item">';
              echo '<input type="checkbox" name="worker[]" value="' . $row['name'] . '"> ' . $row['name'];
              echo '</div>';
            }
            ?>
          </div>
        </div>

        <div class="form-group">
          <label for="location-input">Assign Location:</label>
          <select name='location'>
            <option>Select</option>
            <?php
            // Assuming you have an 'items' table with 'id' and 'name' columns
            $sqlquery = "SELECT  place_name FROM places ";
            $dat= mysqli_query($conn, $sqlquery);

            while ($row = mysqli_fetch_assoc($dat)) {
              echo '<option>' . $row['place_name'] . '</option>';
            }
            ?>
          </select>
        </div>

        <input type="submit" name="submit" value="Assign">
      </form>
    </div>


<div class="employee-table">
        <div class="search-bar">
            <span class="search-icon">&#128269;</span>
            <input type="text" id="search-input" class="search-input" placeholder="Search...">
        </div>
        <br>
        <div id="content">
           <table id="content">
    <thead>
        <tr>
            <th>Sl.No</th>
            <th>Supervisor</th>
            <th>Location</th>
            <th>Worker</th>
            <th>Remove</th>
        </tr>
    </thead>
    <tbody>
        <?php
        while ($row = mysqli_fetch_assoc($data)) {
            echo "<tr>";
            echo "<td>" . $row['team_id'] . "</td>";
            echo "<td>" . $row['name'] . "</td>";
            echo "<td>" . $row['location'] . "</td>";
            echo "<td>" . $row['workers'] . "</td>";
            echo "<td><button onclick='removeRow(" . $row['team_id'] . ")'>Remove</button></td>";
            echo "</tr>";
        }
        ?>
    </tbody>
</table>

<script>
    function removeRow(teamId) {
        // Confirm the deletion with the user
        if (confirm("Are you sure you want to remove this row?")) {
            // Send an AJAX request to delete the row
            var xhr = new XMLHttpRequest();
            xhr.onreadystatechange = function () {
                if (xhr.readyState == 4 && xhr.status == 200) {
                    // Reload the page or update the table based on your requirements
                    location.reload();
                }
            };
            xhr.open("POST", "remove_row.php", true);
            xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
            xhr.send("team_id=" + teamId);
        }
    }
</script>

        </div>
    </div>
 </center>   
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
<script>
    document.addEventListener("DOMContentLoaded", function () {
        const searchInput = document.getElementById("search-input");
        const rows = document.querySelectorAll("#content tbody tr");

        searchInput.addEventListener("input", function () {
            const query = searchInput.value.toLowerCase();

            // Loop through rows and toggle visibility based on the search query
            rows.forEach((row) => {
                const itemText = row.textContent.toLowerCase();
                const isVisible = itemText.includes(query);
                row.style.display = isVisible ? "table-row" : "none";
            });
        });
    });
</script>
<script>
    document.addEventListener("DOMContentLoaded", function () {
        const searchInput = document.getElementById("search-input");
        const rows = document.querySelectorAll("#content tbody tr");

        searchInput.addEventListener("input", function () {
            const query = searchInput.value.toLowerCase();

            // Loop through rows and toggle visibility based on the search query
            rows.forEach((row) => {
                const itemText = row.textContent.toLowerCase();
                const isVisible = itemText.includes(query);
                row.style.display = isVisible ? "table-row" : "none";
            });

            // Remove the "highlight" class if the search query is empty
            if (query === "") {
                rows.forEach((row) => {
                    row.classList.remove("highlight");
                });
            }
        });
    });
</script>
</body>
</html>
