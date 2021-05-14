<?php
include('../config/constants.php');
// echo "hello";
// check wather id and image is set or not
if( isset($_GET['id']) AND isset($_GET['image_name'])) {
    // echo "hello";
    $id=$_GET['id'];
    $image_name=$_GET['image_name'];

    if($image_name!=""){
        // remove image
        $path="../images/Category/".$image_name;
        $remove=unlink($path);

        // if fail to remove image
        if($remove==false){
            // set session message
            $_SESSION['remove']="<div class='error'>fail  to remove Image</div>";
            // redirect
            header('location:'.SITEURL.'admin/manage-category.php');
            // stop process
            die();
        }
    }

    // Delete data from database
    $sql="DELETE FROM tbl_category WHERE id=$id";

    // execute the query
    $res=mysqli_query($conn,$sql);

    // check deleted or not from DB
    if($res==true){
        //  set success message
        $_SESSION['delete']="<div class='success'>Deleted successfully</div>";
        header('location:'.SITEURL.'admin/manage-category.php');

    }else{
        //  set fail message
        $_SESSION['delete']="<div class='error'>Fail to Delete</div>";
        header('location:'.SITEURL.'admin/manage-category.php');
    }
 
} else {
    // redirect to manage category page
    header('loaction:'.SITEURL.'admin/manage-category.php');
}

?>
