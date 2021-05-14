<?php include('./partial/menu.php'); ?>

<div class="main-content">
<div class="wrapper">
   <h1>Update Category</h1>

   <br><br>


   <?php 
     
     if(isset($_GET['id'])){
      //   get id and all other details
         // echo"getting data";
         $id=$_GET['id'];
         // create sql query for other details
         $sql="SELECT * FROM tbl_category WHERE id=$id";

         // execute the query
         $res=mysqli_query($conn, $sql);

         // count the rows weather id is valid or not
         $count=mysqli_num_rows($res);

         if($count==1){
            // get all data
            $row=mysqli_fetch_assoc($res);
            $title=$row['title'];
            $current_image=$row['image_name'];
            $featured=$row['featured'];
            $active=$row['active'];

         }else{
            // redirect with msg
            $_SESSION['no-category-found']="<div class='error'>Category not found</div>";
            header('location:'.SITEURL.'admin/manage-category.php');
            
         }

     }else{
      //   redirect to manage category
      header('location:'.SITEURL.'admin/manage-category.php');
     }
 
   ?>
    <form action="" method="POST" enctype="multipart/form-data">
   <table class="full">
        <tr>
        <td>Title:</td>
        <td><input type="text" name="title" value="<?php echo $title ?>"></td>
        </tr>
        
        <tr>
        <td>Currenr Image:</td>
        <td>
           <?php
              if($current_image!=""){
               //   Display the image
               ?>
               <img src="<?php echo SITEURL; ?>images/category/<?php echo $current_image; ?>" alt="" width="150px">

               <?php
              }else{
               //   Display image
                echo "<div class='error'>Image not Added</div>";
              }
           ?>
        </td>
        </tr>
        
        <tr>
        <td> New Image</td>
        <td><input type="file" name="image"></td>
        </tr>

        <tr>
        <td>Featured:</td>
        <td><input <?php if($featured=="Yes"){echo "checked";} ?> type="radio" name="featured" value="Yes">Yes
        <input <?php if($featured=="No"){echo "checked";} ?> type="radio" name="featured" value="No">No</td>
        </tr>
        
        <tr>
        <td>Active:</td> 
        <td><input <?php if($active=="Yes"){echo "checked";} ?> type="radio" name="active" value="Yes">Yes
        <input <?php if($active=="No"){echo "checked";} ?> type="radio" name="active" value="No">No</td>
        
        </tr>
        
        <tr>
        <td>
        <input type="hidden" name="current_image" value="<?php echo $current_image; ?>">
        <input type="hidden" name="id" value="<?php echo $id; ?>">
        <input type="submit" name="submit" value="Update" class="btn-second">
        </td>
        </tr>
   </table>
   </form>
   <?php
   if(isset($_POST['submit'])){
      // echo "clicked";
      $title=$_POST['title'];
      $id=$_POST['id'];
      $current_image=$_POST['current_image'];
      $featured=$_POST['featured'];
      $active=$_POST['active'];

      // Update new image if selected
      // check image is selected or not
      if(isset($_FILES['image']['name'])){
         // Get image details
         $image_name=$_FILES['image']['name'];

         // check image is available or not
         if($image_name!=""){
            // image available
            // Upload new image

            
                  //  auto rename image
                  // get extenton for jpg,png,jpeg
                  $ext=end(explode('.',$image_name));
                  // rename now
                  $image_name="Food_Category_".rand(000,999).'.'.$ext;
                  $source_path=$_FILES['image']['tmp_name'];
                  $destination_path="../images/Category/".$image_name;

                  // finally upload the images
                  $upload=move_uploaded_file($source_path,$destination_path);

                  //  check image uploaded or not
                  // if image not uploaded redirect
                  if($upload==false){

                    $_SESSION['upload']="<div class='error'>fail to upload image</div>";
                    // redirect
                    header('location:'.SITEURL.'admin/manage-category.php');
                    // stop the process
                    die();

                  }
                  // Remove current image
                  if($current_image!=""){
                     $remove_path="../images/Category/".$current_image;
                     $remove=unlink($remove_path);
                     // check image is removed or not
                     if($remove==false){
                        $_SESSION['failed-remove']="<div class='error'>Fail to remove Currentimage<div>";
                        header('location:'.SITEURL.'admin/manage-category.php');
                        die();//stop process
                    }

                  }
                

         }else{
            $image_name=$current_image;
         }
      }else{
         $image_name=$current_image;
      }


      // update database
      $sql2="UPDATE tbl_category SET
      title='$title',
      image_name='$image_name',
      featured='$featured',
      active='$active'
      WHERE  id=$id";
   //   execute the Query
      $res=mysqli_query($conn,$sql2);
      // redirect and check $res

      if($res==true){
         // Category updated
         $_SESSION['update']="<div class='success'>Category updated successfully</div>";
         header('location:'.SITEURL.'admin/manage-category.php');
      }else{
         // fail to update
         $_SESSION['update']="<div class='error'>Category fail to update</div>";
         header('location:'.SITEURL.'admin/manage-category.php');
      }
   }
   ?>
</div>
</div>



<?php include('./partial/footer.php'); ?>

