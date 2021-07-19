
<?php include('../config/constants.php') ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/admin.css">
    <title>Login </title>
</head>
<body>

    <div class="login">
    <h1 class="center">Login</h1>
    <br><br>

    <?php
  
    if(isset($_SESSION['login'])){
        echo $_SESSION['login'];
        unset($_SESSION['login']);
    }
    if(isset($_SESSION['no-login-message'])){
        echo $_SESSION['no-login-message'];
        unset($_SESSION['no-login-message']);
    }
    
     ?>

<br><br>
<!-- login start here -->
<form action="" method="POST"  class="center">
    Username:<br>
    <input type="text" name="username" placeholder="Enter username"><br><br>
    Password:<br>
    <input type="password" name="password" placeholder="password"><br><br>
    <input type="submit" name="submit" value="Login" class="btn-color">
    <br><br>
</form>


<!-- end of login -->

     <p class="center">Created by <a href="#">KIRAN</a></p>
    </div>
        
</body>
</html>


<?php

if(isset($_POST['submit'])){
    // get data from login form
   echo $username=mysqli_real_escape_string($conn,$_POST['username']);
   echo $raw_password=md5($_POST['password']);
   $password=mysqli_real_escape_string($conn,$raw_password);
// check user exist
    $sql="SELECT * FROM tbl_admin WHERE username='$username' AND password='$password'";
    // execute
    $res=mysqli_query($conn,$sql);

    $count=mysqli_num_rows($res);
  
    if($count==1){
        $_SESSION['login']="<div class='success center'>Login Success<div>";
        $_SESSION['user']=$username; // check user logged in or not 

        // redirect
        header('location:'.SITEURL.'admin/');
    }else{
        $_SESSION['login']="<div class='error center'>Login Fail<div>";

          // redirect
          header('location:'.SITEURL.'admin/login.php');
    }
}

?>