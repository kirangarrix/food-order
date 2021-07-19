<?php include('./partial/menu.php'); ?>

<?php 

// id is set or not

if(isset($_GET['id'])){
  // get all details
    $id=$_GET['id'];
    // sql query to get the selected
    $sql2="SELECT * FROM tbl_food  WHERE id=$id";
    // execute the query
    $res2=mysqli_query($conn,$sql2);

    // get the value based on query executed
    $row2=mysqli_fetch_assoc($res2);

    // get the individual data of selected food
    $title=$row2['title'];
    $description=$row2['description'];
    $price=$row2['price'];
    $current_image=$row2['image_name'];
    $current_category=$row2['category_id'];
    $featured=$row2['featured'];
    $active=$row2['active'];


}else{
  // redirect to manage
 header('location:'.SITEURL.'admin/manage-food.php');

}


?>



<div class="main-content">
   <div class="wrapper">
   <h1>Update food</h1>
   <br><br>

   <form action="" method="POST" enctype="multipart/form-data">
     <table class="tbl-30">
     <tr>
     <td>Title:</td>
     <td>
     <input type="text" name="title" value="<?php echo $title; ?>">
     </td>
     </tr>

     <tr>
     <td>Description:</td>
     <td>
     <textarea name="description"  cols="30" rows="5"><?php echo $description; ?></textarea>
     </td>
     </tr>
     
     <tr>
     <td>Price:</td>
     <td><input type="number" name="price" value="<?php echo $price; ?>"></td>
     </tr>
      
      <tr>
      <td>Current Image:</td>
      <td>
             <?php 
             if($current_image == ""){
              //  image not available
             echo"<div class='error'>Image not available</div>";

             }else{
              //  image available
              ?>
                   <img src="<?php echo SITEURL; ?>images/food/<?php echo $current_image; ?>" alt="<?php echo $title; ?>" width="150px">
              <?php

             }
             ?>
      </td>
      </tr>

      <tr>
      <td>select new image</td>
      <td>
      <input type="file" name="image">
      </td>
      </tr>

      <tr>
      <td>Category:</td>
      <td>
      <select name="category">
        
        <?php
          //  query to get active category
         $sql="SELECT * FROM tbl_category WHERE active='Yes'";
          // execute query
          $res=mysqli_query($conn, $sql);

          // Excute the query
          $count=mysqli_num_rows($res);

          if($count>0){
                  // category available

                  while($row=mysqli_fetch_assoc($res)){
                    $category_title=$row['title'];
                    $category_id=$row['id'];

                    // echo "<option value='$category_id'>$category_title</option> ";
                    ?>
                        <option  <?php if($current_category==$category_id){ echo "selected";} ?>  value="<?php echo $category_id ?>"><?php echo $category_title; ?></option>  
                    <?php

                  }
          }else{
                // category not available
                echo "<option value='0'>category not available</option> ";
          }

         ?>

      <option value="0">Test category</option>
      </select>
      </td>
      </tr>

      <tr>
      <td>Featured:</td>
      <td>
      <input <?php if($featured=="Yes"){ echo "checked";} ?> type="radio" name="featured" value="Yes">Yes
      <input <?php if($featured=="No"){ echo "checked";} ?> type="radio" name="featured" value="No">No
      </td>
      </tr>

      
      <tr>
      <td>Active:</td>
      <td>
      <input  <?php if($active=="Yes"){ echo "checked";} ?> type="radio" name="active" value="Yes">Yes
      <input <?php if($active=="No"){ echo "checked";} ?> type="radio" name="active" value="No">No
      </td>
      </tr>


      <tr>
      <td>
         <input type="hidden" name="id"  value="<?php echo $id; ?>">
         <input type="hidden" name="current_image"  value="<?php echo $current_image; ?>">
         <input type="submit" name="submit" value="Update food" class="btn-second">
      </td>
      </tr>
        
     </table>
   </form>

   <!-- update -->

   <?php
        

        if(isset($_POST['submit'])){
         
          // echo "button clicked";

          // get all the details from form
          $id=$_POST['id'];
          $title=$_POST['title'];
          $description=$_POST['description'];
          $price=$_POST['price'];
          $current_image=$_POST['current_image'];
          $category=$_POST['category'];
          $featured=$_POST['featured'];
          $active=$_POST['active'];

          // check upload image clicked or not
          if(isset($_FILES['image']['name'])){
            $image_name=$_FILES['image']['name']; //new image name

            // check file is available or not
            if($image_name!==""){
              // image is available
              // rename the image
              $ext=end(explode('.',$image_name));//get extention of image
              $image_name="Food-name".rand(0000, 9999).'.'.$ext; //this will be renamed image

              // get path and source path]
              $src_path=$_FILES['image']['tmp_name'];//source
              $dest_path="../images/food/".$image_name;//destination

              $upload=move_uploaded_file($src_path,$dest_path);

              // check image uploaded or not
              if($upload==false){
                //fail upload
                $_SESSION['upload']="<div class='error'>Fail to upload new image</div>";
                //redirect to manage food
                header('location:'.SITEURL.'admin/manage-food.php');
                // stop process
                die();
              }
              // remove current image if available
              if($current_image!==""){
                // Current image is available
                // remove image
                $remove_path="../images/food/".$current_image;

                $remove=unlink($remove_path);
                // check image removed or not
                if($remove==false){
                  // fail to remove image
                  $_SESSION['remove-failed']="<div class='error'>Fail to remove current image</div>";
                  // redirect to mangae food
                  header('location:'.SITEURL.'admin/manage-food.php');
                  // stop process
                  die();

                }
              }else{
                $image_name=$current_image; //default image when image is not selected
              }
            }
          }else{
            $image_name=$current_image;  //default image when Button is not clicked
          }

          // Sql upadate food query
          $sql3="UPDATE tbl_food SET title='$title',description='$description',price='$price',image_name='$image_name',category_id='$category',featured='$featured',
          active='$active' WHERE id=$id";
          // execute the query
          $res3=mysqli_query($conn,$sql3);

          // check qry execute or not
          if($res3==true){
                    // qry executed
                    $_SESSION['update']="<div class='success'>Food updated successfully</div>";
                    header('location:'.SITEURL.'admin/manage-food.php');
                    
          }else{
            // fail to execute update food
            $_SESSION['update']="<div class='error'>Fail to update food</div>";
            header('location:'.SITEURL.'admin/manage-food.php');
          }

        }


   ?>
   
   </div>
</div>

<?php include('./partial/footer.php'); ?>