
<?php
$conn = mysqli_connect("localhost", "root","","gms");
if(isset($_POST['submit'])){
  $supervisor=$_POST['supervisor'];
  $location=$_POST['location'];
  $worker=$_POST['worker'];
  $manager=$_SESSION['name'];
/* echo $supervisor;
 echo $location;
 echo $worker;
}
  */ 
if (isset($_POST['worker']) && is_array($_POST['worker'])) {
  foreach ($_POST['worker'] as $worker) {
$sql="INSERT INTO team(manager, name, location, workers) VALUES ('$manager','$supervisor','$location','$worker')";

  $data = mysqli_query($conn,$sql);
}
  if($data)
  {
 //   echo "Data inserted sucessfully";
    header("location: mdashboard.php");
  }
}
}
?>