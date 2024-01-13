<?php
$apiKey = '50c217cd4f8f827bd3c22174920d9404'; // Replace with your OpenWeatherMap API key
$city = 'Chennai';
$country = 'IN'; // Country code for India

$apiUrl = "https://api.openweathermap.org/data/2.5/weather?q={$city},{$country}&appid={$apiKey}";

$ch = curl_init($apiUrl);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
$response = curl_exec($ch);

if ($response === false) {
    $output = array('error' => 'Error: cURL request failed');
} else {
    $data = json_decode($response);

    if ($data === null || isset($data->cod) && $data->cod !== 200) {
        $output = array('error' => 'Error: ' . (isset($data->message) ? $data->message : 'Unknown error'));
    } else {
        $temperature = $data->main->temp - 273.15; // Convert from Kelvin to Celsius
        $weatherDescription = $data->weather[0]->description;

        // Create an associative array with the data
        $output = array(
            'city' => $city,
            'temperature' => $temperature,
            'weather' => $weatherDescription
        );
    }
}

curl_close($ch);

// Convert the associative array to JSON
echo json_encode($output);
?>
