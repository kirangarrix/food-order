<?php
// access control
// check usr is logged in ot not
if(!isset($_SESSION['user']))
{
    // user not logged in
    $_SESSION['no-login-message']="<div class='error center'>Please login and access admin</div>";
    header('location:'.SITEURL.'admin/login.php');
}

?>