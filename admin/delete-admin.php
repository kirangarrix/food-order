<?php 
include('../config/constants.php');
//get the id of admin to be detele
 echo $id=$_GET['id'];
//create sql query to delete admin
$sql="DELETE FROM tbl_admin WHERE id=$id";
//execute the query
$res=mysqli_query($conn,$sql);
// check query exexuted sucessfull or not
if($res==true){
    // echo "Admin deletd";
    $_SESSION['delete']="<div class='success'>Admin deleted successfully</div>";
    header('location:'.SITEURL.'admin/manage-admin.php');
}else{
    //  echo "Fail to delete";
    $_SESSION['delete']="<div class='error'>Fail to delete  admin...try again</div>";
    header('location:'.SITEURL.'admin/manage-admin.php');
}
//redirect to manage admin

?>