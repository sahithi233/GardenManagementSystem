<? php 
 $conn = mysqli_connect("localhost", "root","","gms");
if(isset($_POST['rate'])){
  $jobId=$_POST['job_id'];
  $rating=$_POST['rating'];


  
  ?>

<<!DOCTYPE html>
<html>
<head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title></title>
</head>
<body>
<form class='rating-form' >
<label for='rating'>Rate Supervisor:</label>
<select id='rating' name='rating'>
<option value='1'>1 (Poor)</option>
<option value='2'>2 (Fair)</option>
<option value='3'>3 (Average)</option>
<option value='4'>4 (Good)</option>
<option value='5'>5 (Excellent)</option>
</select>
<button>Rate</button>
</form>
</body>
</html>
