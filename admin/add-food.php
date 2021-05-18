<?php include('./partial/menu.php'); ?>

<div class="main-content">
    <div class="wrapper">
    <h1>Add food</h1>

    <br><br>
    <?php
      if(isset($_SESSION['upload'])){
          echo $_SESSION['upload'];
          unset($_SESSION['upload']);
      }

    ?>

    <form action="" method="POST" enctype="multipart/form-data">

    <table class="tbl-full">
    <tr>
        <td>Title:</td>
        <td><input type="text" name="title" placeholder="title of the food"></td>
    </tr>
    <tr>
        <td>Description:</td>
        <td><textarea name="description"  cols="30" rows="5" placeholder="description of food"></textarea></td>
    </tr>
    <tr>
        <td>Price:</td>
        <td><input type="number" name="price" ></td>
    </tr>
    <tr>
        <td>Select image:</td>
        <td><input type="file" name="image"></td>
    </tr>
    <tr>
        <td>Category:</td>
        <td><select name="category">
        
         <?php
            // php code to display category
            // sql query
            $sql="SELECT * FROM tbl_category WHERE active='Yes'";
            // excute
            $res=mysqli_query($conn,$sql);
            // Count the row to check we get the value or not
            $count=mysqli_num_rows($res);

            if($count>0){
                // we have category
                while($row=mysqli_fetch_assoc($res)){
                    // get the details of category
                    $id=$row['id'];
                    $title=$row['title'];
                    ?>
                     <option value="<?php echo $id; ?>"><?php echo $title; ?></option>

                    <?php
                }
            }else{
                // we dont have category
                ?>
                <option value=0>No category found</option>
                <?php
            }


          ?>
          
        </select></td>
    </tr>
    <tr>
        <td>Featured:</td>
        <td>
            <input type="radio" name="featured" value="Yes">Yes
            <input type="radio" name="featured" value="No">No
        </td>
    </tr>
    <tr>
        <td>Active:</td>
        <td>
            <input type="radio" name="active" value="Yes">Yes
            <input type="radio" name="active" value="No">No
       </td>
    </tr>
    <tr>
        <td colspan="2"><input type="submit" name="submit" value="Add food" class="btn-second"></td>
    </tr>
    
    </table>

    
    </form>

  <?php 
    // check whether the button  clicked or not
    if(isset($_POST['submit'])){
        // add food in database
        // echo"Clicked";
        // get the date from form
        $title=$_POST['title'];
        $description=$_POST['description'];
        $price=$_POST['price'];
        $category=$_POST['category'];
        // check whether radio button for featured and active are checked or not
        if(isset($_POST['featured'])){
            $featured=$_POST['featured'];
        }else{
            $featured="NO";
        }

        if(isset($_POST['active'])){
            $active=$_POST['active'];
        }else{
            $active="NO";
        }

        // upload the image is selected
        // check image buttton is selected or not
        if(isset($_FILES['image']['name'])){
            // get the details  of selected image
            $image_name=$_FILES['image']['name'];
            // upload if image is selected
            if($image_name!=""){
                // image is selected
                // rename image
                // get the extension of image
                $ext=end(explode('.',$image_name));
                
                // create a new name of image
                $image_name="Food_name_".rand(000,999).'.'.$ext;

                // upload the image
                // get src path and destination path
                // source path is current location of image
                $src=$_FILES['image']['tmp_name'];
                // destination path
                $dst="../images/food/".$image_name;

                // finally upload image
                $upload=move_uploaded_file($src,$dst);

                // check image upload working or not
                if($upload==false){
                    // failed to upload image and redirect
                   $_SESSION['upload']="<div class='error'>failed to upload image</div>";
                header('location:'.SITEURL.'admin/add-food.php');
                   //    stop process
                    die();
                }

            }
        }else{
            $image_name="";
        }
        // insert into database
        // create sql query
        $sql2="INSERT INTO tbl_food SET
        title='$title',
        description='$description',
        price=$price,
        image_name='$image_name',
        category_id='$category',
        featured='$featured',
        active='$active'";

        // excute the query
        $res2=mysqli_query($conn, $sql2);
        // check data inserted or not
        if($res2 == true){
            // data inserted successfully
          $_SESSION['add']="<div class='success'>Food added successfully</div>";
          header('location:'.SITEURL.'admin/manage-food.php');
        }else{
            $_SESSION['add']="<div class='error'>Fail to  add food</div>";
            header('location:'.SITEURL.'admin/manage-food.php');
            // fail
        }
        //  redirct
    }

  ?>

    </div>
</div>

<?php include('./partial/footer.php');?>