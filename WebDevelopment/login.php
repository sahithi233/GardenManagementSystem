<?php
$conn = mysqli_connect("localhost", "root", "", "gms");
session_start();

if (isset($_POST['submit'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $status = "Active";

    $query = "SELECT * FROM user WHERE Username='$username' AND Password='$password' AND status = '$status'";
    $result = mysqli_query($conn, $query);

    if ($result) {
        $row = mysqli_fetch_array($result);

        if ($row) {
            $user = $row;
            $_SESSION['id'] = $user['id'];
            $_SESSION['name'] = $user['name'];

            if ($user['role'] == "Admin") {
                header('location: adashboard.php');
            } elseif ($user['role'] == "Manager") {
                header('location: mdashboard.php');
            } elseif ($user['role'] == "Supervisor") {
                header('location: sdashboard.php');
            }
        } else {
            // Invalid username or password
            echo '<script>
                function showAlert(message) {
                    alert(message);
                    document.cookie = "alert_shown=true; expires=" + new Date(new Date().getTime() + 10 * 1000).toUTCString();
                }
                showAlert("Invalid username or password");
            </script>';
        }
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <!-- ===== Iconscout CSS ===== -->
    <link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.0/css/line.css">
    <!-- <link rel="stylesheet" type="text/css" href="styleindex.css"> -->

    <!-- ===== CSS ===== -->
         <style>
            /* ===== Google Font Import - Poformsins ===== */
@import url('https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap');

*{
    margin: 0;
    padding: 0;
    box-sizing: border-box;
    font-family: 'Poppins', sans-serif;
}

body{
    height: 100vh;
    display: flex;
    align-items: center;
    justify-content: center;

}

.container{
    position: relative;
    max-width: 430px;
    width: 100%;

    overflow: hidden;
    margin: 0 20px;
}

.container .forms{
    display: flex;
    align-items: center;
    height: 440px;
    width: 200%;
    transition: height 0.2s ease;
}


.container .form{
    width: 50%;
    padding: 30px;
    background-color: #fff;
    transition: margin-left 0.18s ease;
}

.container.active .login{
    margin-left: -50%;
    opacity: 0;
    transition: margin-left 0.18s ease, opacity 0.15s ease;
}

.container .signup{
    opacity: 0;
    transition: opacity 0.09s ease;
}
.container.active .signup{
    opacity: 1;
    transition: opacity 0.2s ease;
}

.container.active .forms{
    height: 600px;
}
.container .form .title{
    position: relative;
    font-size: 27px;
    font-weight: 600;
}

.form .title::before{
    content: '';
    position: absolute;
    left: 0;
    bottom: 0;
    height: 3px;
    width: 30px;
    background-color: #e0c2b2;
    border-radius: 25px;
}

.form .input-field{
    position: relative;
    height: 50px;
    width: 100%;
    margin-top: 30px;
}

.input-field input{
    position: absolute;
    height: 100%;
    width: 100%;
    padding: 0 35px;
    border: none;
    outline: none;
    font-size: 16px;
    border-bottom: 2px solid #ccc;
    border-top: 2px solid transparent;
    transition: all 0.2s ease;
}

.input-field input:is(:focus, :valid){
    border-bottom-color: #e0c2b2;

}

.input-field i{
    position: absolute;
    top: 50%;
    transform: translateY(-50%);
    color: #999;
    font-size: 23px;
    transition: all 0.2s ease;
}

.input-field input:is(:focus, :valid) ~ i{
    color: #999;
}

.input-field i.icon{
    left: 0;
}
.input-field i.showHidePw{
    right: 0;
    cursor: pointer;
    padding: 10px;
}


.form .text{
    color: #333;
    font-size: 14px;
}



.form .button{
    margin-top: 35px;
}

.form .button input{
    border: none;
    color: #fff;
    font-size: 17px;
    font-weight: 500;
    letter-spacing: 1px;
    border-radius: 6px;
    background-color: #e0c2b2;
    
    transition: all 0.3s ease;
}



         </style>
    <style>
        label {
 display: flex;
  font-weight: bold;
  text-align: right;
  margin-right: 10px;
}

input{
 
  padding: 5px;
  border: 1px solid #ccc;
  border-radius: 4px;
  margin-left: 10px;
}</style>
</head>
<body>
   
    
    <div class="divider"></div>
    <div id="divimg">
        
    </div>

    
    <img src="growise.jpg" style="float: left; margin-right: 100px; margin-top: 35px; margin-left: 70px">
    

    

    <!-- new login form  -->
    <div class="container">
        <div class="forms">
            <div class="form login">
                <span class="title">Login</span>

                <form action="" method="POST">
                    <div class="input-field">
                        <input type="text" name="username" placeholder="Username" required>
                        <i class="uil uil-envelope icon"></i>
                    </div>
                    <div class="input-field">
                        <input type="password" class="password"  name="password" placeholder="Password" required>
                        <i class="uil uil-lock icon"></i>
                        <i class="uil uil-eye-slash showHidePw"></i>
                    </div>


                    <div class="input-field button">
                        <input type="submit"  name="submit" value="Login">
                    </div>
                </form>

            </div>

          
        </div>
    </div>
</div>
<script>
    const container = document.querySelector(".container"),
  pwShowHide = document.querySelectorAll(".showHidePw"),
  pwFields = document.querySelectorAll(".password"),
  signUp = document.querySelector(".signup-link"),
  login = document.querySelector(".login-link");

//   js code to show/hide password and change icon
pwShowHide.forEach(eyeIcon =>{
    eyeIcon.addEventListener("click", ()=>{
        pwFields.forEach(pwField =>{
            if(pwField.type ==="password"){
                pwField.type = "text";

                pwShowHide.forEach(icon =>{
                    icon.classList.replace("uil-eye-slash", "uil-eye");
                })
            }else{
                pwField.type = "password";

                pwShowHide.forEach(icon =>{
                    icon.classList.replace("uil-eye", "uil-eye-slash");
                })
            }
        }) 
    })
})

// js code to appear signup and login form
signUp.addEventListener("click", ( )=>{
    container.classList.add("active");
});
login.addEventListener("click", ( )=>{
    container.classList.remove("active");
});




window.onload = function () {
    // Check if the cookie is set
    var alertShown = document.cookie.replace(/(?:(?:^|.*;\s*)alert_shown\s*=\s*([^;]*).*$)|^.*$/, "$1");

    // If the cookie is not set, show the alert
    if (alertShown !== "true") {
        showAlert("Your alert message here");

        // Set a cookie to remember that the alert has been shown
        document.cookie = "alert_shown=true; expires=" + new Date(new Date().getTime() + 10 * 1000).toUTCString();
    }
};


 </script> 
</body>
</html>