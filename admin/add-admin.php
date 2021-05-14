<?php include('./partial/menu.php'); ?>
<div class="main-content">
    <div class="wrapper">
        <h1>Add admin</h1>
        <br>
        <br>
        <form action="" method="POST" >
            <table id="tbl">
                <tr>
                    <td>Full name:</td>
                    <td><input type="name" name="fullname" placeholder="enter name"></td>
                </tr>
                <tr>
                    <td>Username</td>
                    <td><input type="text" name="username" placeholder="user"></td>
                </tr>
                <tr>
                    <td>Password</td>
                    <td><input type="password" name="password" placeholder="password"></td>
                </tr>
                <tr>
                    <td colspan="2" >
                        <input type="submit" value="Add admin" name="submit" class="btn-second">
                    </td>
                </tr>
            </table>
        </form>
</div>
</div>
<?php include('./partial/footer.php'); ?>

<?php
if(isset($_POST['submit'])){
    // echo"button clicked";
    $full_name=$_POST['fullname'];
    $username=$_POST['username'];
    $password=md5($_POST['password']);  //password encryp

    // sql query to save data
    $sql="INSERT INTO tbl_admin SET
    full_name='$full_name',
    username='$username',
    password='$password' 
    ";
   //execute
    $res=mysqli_query($conn,$sql)or die(mysqli_error());

    if($res==true){
        // echo"data inserted";
        $_SESSION['add']="admin added successfull";
        header("location:".SITEURL.'admin/manage-admin.php');


    }else{
        //   echo "data failed";
        $_SESSION['add']="fail to add admin";
        header("location:".SITEURL.'admin/add-admin.php');
    }
}
?>