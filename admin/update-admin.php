<?php include('./partial/menu.php'); ?>

<div class="main-content">
 <div class="wrapper">
  <h1>Upadate Admin</h1>
  <br><br>
<?php
//get the id of selected admin
$id=$_GET['id'];
//sql query
$sql="SELECT * FROM tbl_admin WHERE id=$id";
//execute
$res=mysqli_query($conn,$sql);
//check query is executed or not
if($res==true){
    //check whether data is available
    $count=mysqli_num_rows($res);
    //check we have admin data
    if($count==1){
        //get values
    //    echo "admin available";
    $row=mysqli_fetch_assoc($res);
    $full_name=$row['full_name'];
    $username=$row['username'];
    }else{
        //redirect
        header('location:'.SITEURL.'admin/manage-admin.php');
    }
} 
?>

  <form action="" method="POST">
  <table id="tbl">
  <tr>
  <td>FullName:</td>
  <td><input type="text" name="full_name" value="<?php echo $full_name; ?>"></td>
  </tr>
  <tr>
  <td>Username:</td>
  <td><input type="text" name="username" value="<?php echo $username; ?>"></td>
  </tr>
  <tr>
  <td colspan="2" >
  <input type="hidden" name="id" value="<?php echo $id; ?>">
  <input type="submit" name="submit" value="Update Admin" class="btn-second"></td>
  </tr>
  </table>
  </form>
 </div>
</div>

<?php
if(isset($_POST['submit'])){
    // echo "Button clicked";
    // get all the value from form update
    $id=$_POST['id'];
    $full_name=$_POST['full_name'];
    $username=$_POST['username'];

    //crate sql for update value
    $sql="UPDATE tbl_admin SET
    full_name='$full_name',
    username='$username'
    WHERE id='$id'
    ";
    // execute the query
    $res=mysqli_query($conn,$sql);

    //check query is executed or not
    if($res==true){
       $_SESSION['update']="<div class='success'>Admin updated successfully</div>";
       //redirect
       header('location:'.SITEURL.'admin/manage-admin.php');
    }else{
       $_SESSION['update']="<div class='success'>Admin updated Fail try again...</div>";
       header('location:'.SITEURL.'admin/manage-admin.php');
    }
     
}

?>


<?php include('./partial/footer.php'); ?>