<?php include('./partial/menu.php'); ?>
<div class="main-content">
<div class="wrapper">
<h1>Change Password</h1>
<br><br>

<?php
if(isset($_GET['id'])){
$id=$_GET['id'];
} 
?>    

<form action="" method="POST" >
<table class="tbl-full">
<tr>
<td>Current password</td>
<td>
<input type="password" name="current_password" placeholder="current password">
</td>
</tr>
<tr>
<td>New Password</td>
<td><input type="password" name="new_password" placeholder="new password"></td>
</tr>
<tr>
<td>Confirm Password</td>
<td><input type="text" name="confirm_password" placeholder="confirm password"></td>
</tr>
<tr>
<td colspan="2">
<input type="hidden" name="id" value="<?php echo $id; ?>">
<input type="submit" name="submit" value="Change password" class="btn-color">
</td>
</tr>
</table>
</form>

</div>
</div>

<?php
if(isset($_POST['submit'])){
    // echo "Clicked";
    $id=$_POST['id'];
    // get data from form
    $current_password=md5($_POST['current_password']);
    $new_password=md5($_POST['new_password']);
    $confirm_password=md5($_POST['confrim_password']);
    // check weather the users with current id and current password match
    $sql="SELECT * FROM tbl_admin WHERE id=$id  AND password='$current_password'";
//    execute the query
    $res=mysqli_query($conn,$sql);

    if($res==true){
        // weather data available or not
        $count=mysqli_num_rows($res);
        if($count==1){
            // user exist
            // echo "User found";
            //password check
            if($confirm_password==$new_password){
                //update password
                $sql2="UPDATE tbl_admin SET password='$new_password'
                WHERE id=$id";
                //execute query
                $res2=mysqli_query($conn,$sql2);
                // check 
                if($res2==true){
                    // display sucess
                        $_SESSION['change-pwd']="<div class='success'>Password change successfully</div>";
                        //redirect
                        header('location:'.SITEURL.'admin/manage-admin.php');
                }else{
                    // display error
                     $_SESSION['change-pwd']="<div class='error'>Fail to change password</div>";
            //redirect
            header('location:'.SITEURL.'admin/manage-admin.php');
                }
                
            }else{
                // redirect to page
                 $_SESSION['pwd-not-match']="<div class='error'>Password did not match</div>";
            //redirect
            header('location:'.SITEURL.'admin/manage-admin.php');
            }
        }else{
            // user not exist
            $_SESSION['user-not-found']="<div class='error'>User not found..</div>";
            //redirect
            header('location:'.SITEURL.'admin/manage-admin.php');
        }
    }
    //check weather new passowrd and confirm password match

}
?>

<?php include('./partial/footer.php'); ?>
      