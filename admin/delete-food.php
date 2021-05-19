<?php 
include('../config/constants.php');

if(isset($_GET['id']) && isset($_GET['image_name'])){
    // process to delete
    
    $id=$_GET['id'];
    $image_name=$_GET['image_name'];

    if($image_name!=""){
        $path="../images/food/".$image_name;
        // remove img
        $remove=unlink($path);

        if($remove==false){
            // fail
            $_SESSION['upload']="<div class='error'>unable to remove img</div>";
            header('location:'.SITEURL.'admin/manage-food.php');
            die();
        }
    }
    $sql="DELETE FROM tbl_food WHERE id=$id";
    $res=mysqli_query($conn,$sql);
    if($res==true){
        //    delete
        $_SESSION['delete']="<div class='success'>Deleted successfully</div>";
        header('location:'.SITEURL.'admin/manage-food.php');
    }else{
        // fail to delete
        $_SESSION['delete']="<div class='error'>Fail to Delete</div>";
        header('location:'.SITEURL.'admin/manage-food.php');
    }


}else{
    // redirect to manage
    echo "redirect";
    $_SESSION['unauthorize']="<div class='error'>Unauthorize access</div>";
    header('location:'.SITEURL.'admin/manage-food.php');
    
}


?>
