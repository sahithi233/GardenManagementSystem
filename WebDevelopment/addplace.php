
<?php
$conn = mysqli_connect("localhost", "root","","gms");
if(isset($_POST['submit'])){
  $place=$_POST['place'];

$sql="INSERT INTO places(place_name) VALUES ('$place')";

  $data = mysqli_query($conn,$sql);

  if($data)
  {
  echo "Data inserted sucessfully";
   header("location: adashboard.php");
  }
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  
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

nav li {
  margin-right: 20px;
  text-align: center;
  display: inline-block;
}

nav a {
  
  color: #333;
  font-weight: bold;
}

a{
  color: white;
  text-decoration: none;
}
button {
  background-color: #e0c2b2;
  color: #fff;
  padding: 10px 20px;
  border: none;
  border-radius: 5px;
  cursor: pointer;

}
form{
width: 30%;
height:100px;
margin: 100px;
border: 0px solid #ccc; 
padding-top: 80px;
padding-bottom: 80px;
border-width: 40%;
border-radius: 20px;
box-shadow:
0 0 0 2px white,
0.3em 0.3em 1em rgba(78, 65,65,0.6);

}
  </style>


</head>
<body>
  <header>
    <img src="growise.jpg" height="30px" width="40px">
    <h1><a href="adashboard.php">GROWISE</h1>
  </header>
  <nav>
    <ul>
      <li><a href="addemp.php">ADD USERS</a></li>
      <li><a href="profile.php">PROFILE</a></li>
      <li><a href="logout.php">LOG OUT</a></li>
    </ul>
  </nav>
  <center>
    <span class="border-0">
 <form action="" method="post" >
 <h2>New Place</h2><br>
  
  <div class="form-group">
   <label>Place Name:</label>
    <input type="text" name="place" required> <br><br>
<button type="submit" name="submit">Add Place</button>
 
  </div>

   
       </form>
     </span>
 </center>
</body>
</html>
