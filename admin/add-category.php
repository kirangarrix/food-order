<?php include('./partial/menu.php'); ?>


        <div class="main-conetent">
            <div class="warpper">
              <h1>Add Category</h1>
               <br><br>

               <?php
               
               if(isset($_SESSION['add'])){
                 echo $_SESSION['add'];
                 unset($_SESSION['add']);
               }
               if(isset($_SESSION['upload'])){
                echo $_SESSION['upload'];
                unset($_SESSION['upload']);
              }




               ?>

               <br><br>

               <!-- Form started -->
             <form action="" method="POST" enctype="multipart/form-data">

             <table class="tbl-full">
             <tr>
             <td>Title :</td>
             <td><input type="text" name="title" placeholder="title"></td>
             </tr>
             <tr>
             <td>Select image:</td>
             <td><input type="file" name="image"></td>
             </tr>

             <tr>
             <td>Featured :</td>
             <td>
             <input type="radio" name="featured" value="Yes">Yes
             <input type="radio" name="featured" value="No">No
             </td>
             </tr>

             <tr>
             <td>Active :</td>
             <td>
             <input type="radio" name="active" value="Yes">Yes
             <input type="radio" name="active" value="No">No
             </td>
             </tr>

             <tr>
             <td colspan="2">
             <input type="submit" value="Add category" name="submit" class="btn-second">
             </td>
             </tr>
             </table>
             
             </form>
               <!-- form end -->


               <?php
            //    if submit button clicked 
            if(isset($_POST['submit'])){
                
              // get values from form
              $title=$_POST['title'];
              // if radio button clicked
             if(isset($_POST['featured'])){
                $featured=$_POST['featured'];
             }else{
               $featured="No";
             }
             if(isset($_POST['active'])){

              $active=$_POST['active'];

             }else{
              $active="No";
            }

            //check weather image is selected or not
            // print_r($_FILES['image']);

            // die(); //break the code here
            if(isset($_FILES['image']['name'])){
              //upload the image
              // to upload image we need image name and source path and destination
               $image_name=$_FILES['image']['name'];

              //  upload image if selected only
              if($image_name!=""){
                 
              
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
                    header('location:'.SITEURL.'admin/add-category.php');
                    // stop the process
                    die();

                  }
             }
            }else{
              // DONT Upload IMAGE and set image name is blanck
              $image_name="";
            }
            // cerate sql for category
               $sql="INSERT INTO tbl_category SET
               title='$title',featured='$featured',
               image_name='$image_name',
               active='$active'
                ";
               //execute the query
               $res=mysqli_query($conn,$sql);
              //  check the query is excuted
              if($res==true){
                //query is excuted added
                $_SESSION['add']="<div class='success'>Category added successfully</div>";
                // redirect 
                header('location:'.SITEURL.'admin/manage-category.php');
                
              }else{
                // fail to execute

                $_SESSION['add']="<div class='error'>Fail  to add Category</div>";
                // redirect 
                header('location:'.SITEURL.'admin/add-category.php');
              }
            }


               ?>

            </div>
        </div>



<?php include('./partial/footer.php');?>