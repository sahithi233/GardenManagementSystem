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
            margin-top: 60px;
            padding: 20px;
            background-color: #fff;
            border-radius: 5px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }

       
        p {
            font-size: 18px;
        }

        .error {
            color: red;
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
    <section class="weather">
        <h2>Weather of the Day</h2>
        <div id="weather-info">
          <div class="weather-container">
       <?php
$apiKey = '50c217cd4f8f827bd3c22174920d9404'; // Replace with your OpenWeatherMap API key
$city = 'Thandalam';
$country = 'IN'; // Country code for India

$apiUrl = "https://api.openweathermap.org/data/2.5/weather?q={$city},{$country}&appid={$apiKey}";

$ch = curl_init($apiUrl);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
$response = curl_exec($ch);

if ($response === false) {
    echo '<p class="error">Error: cURL request failed</p>';
} else {
    $data = json_decode($response);

    if ($data === null || isset($data->cod) && $data->cod !== 200) {
        echo '<p class="error">Error: ' . (isset($data->message) ? $data->message : 'Unknown error') . '</p>';
    } else {
        $temperature = $data->main->temp - 273.15; // Convert from Kelvin to Celsius
        $weatherDescription = $data->weather[0]->description;

        // Mapping between weather descriptions and image URLs
        $imageMap = array(
            'clear sky' => 'url_to_clear_sky_image.jpg',
            'few clouds' => 'url_to_few_clouds_image.jpg',
            'scattered clouds' => 'url_to_scattered_clouds_image.jpg',
            'broken clouds' => 'url_to_broken_clouds_image.jpg',
            'shower rain' => 'url_to_shower_rain_image.jpg',
            // Add more mappings as needed
        );

        // Default image URL if no mapping is found
        $defaultImageUrl = 'url_to_default_image.jpg';

        // Get the image URL based on the weather description
        $imageUrl = isset($imageMap[strtolower($weatherDescription)]) ? $imageMap[strtolower($weatherDescription)] : $defaultImageUrl;

        echo "<h1>City: {$city}</h1>";
        echo "<p>Temperature: {$temperature} °C</p>";
        echo "<p>Weather: {$weatherDescription}</p>";
    }
}

curl_close($ch);
?>

    </div>
        </div>
    </section>
    <!-- Other sections of the supervisor dashboard -->


</body>
</html>
