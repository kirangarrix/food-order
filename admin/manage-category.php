<?php include('./partial/menu.php'); ?>
 <!-- Main Section -->
 <div class="main-content">
    <div class="wrapper">
     <h1>Manage Category</h1>
     <br><br>
     
              <?php
               
               if(isset($_SESSION['add'])){
                 echo $_SESSION['add'];
                 unset($_SESSION['add']);
               }
               if(isset($_SESSION['remove'])){
                echo $_SESSION['remove'];
                unset($_SESSION['remove']);
              }
              if(isset($_SESSION['delete'])){
                echo $_SESSION['delete'];
                unset($_SESSION['delete']);
              }
              if(isset($_SESSION['no-category-found'])){
                echo $_SESSION['no-category-found'];
                unset($_SESSION['no-category-found']);
              }
              if(isset($_SESSION['update'])){
                echo $_SESSION['update'];
                unset($_SESSION['update']);
              }
              if(isset($_SESSION['upload'])){
                echo $_SESSION['upload'];
                unset($_SESSION['upload']);
              }
              if(isset($_SESSION['failed-remove'])){
                echo $_SESSION['failed-remove'];
                unset($_SESSION['failed-remove']);
              }



               ?>
     <br><br>
     <!-- Button -->
     <a href="<?php echo SITEURL; ?>admin/add-category.php" class="btn-color">Add Category</a>
     <br><br><br>
     <table class="tbl-full">
      <tr>
        <th>S.N</th>
        <th>Title</th>
        <th>Image</th>
        <th>Active</th>
        <th>Actions</th>
      </tr>

      <?php

      // sql query to get values
      $sql="SELECT * FROM tbl_category";

      // execute
      $res=mysqli_query($conn ,$sql);

      // count rows
      $count=mysqli_num_rows($res);

      // create serial number variable
      $sn=1;

      // check we get the data or not
      if($count>0){
        // we have data in database
              while($row=mysqli_fetch_assoc($res)){
                $id=$row['id'];
                $title=$row['title'];
                $image_name=$row['image_name'];
                $featured=$row['featured'];
                $active=$row['active'];

                ?>
                
                            <tr>
                              <td><?php echo $sn++; ?></td>
                              <td><?php echo $title; ?></td>

                              <td>

                              <?php 
                              // chech weather img availablr or not
                              if(!empty($image_name)){
                              //  display img
                              ?>

                              <img src="<?php echo SITEURL;  ?>images/category/<?php echo $image_name; ?>" width="100px" >
                              
                             <?php


                              }else{
                                // display error msg
                              echo "<div class='error'>No image added</div>";                
                              }
                               ?>
                              
                              </td>
                              
                              <td><?php echo $featured; ?></td>
                              <td><?php echo $active; ?></td>
                              <td>
                                <a href="<?php  echo SITEURL; ?>admin/update-category.php?id=<?php echo $id ?>" class="btn-second">Update</a>
                                <a href="<?php echo SITEURL; ?>admin/delete-category.php?id=<?php echo $id; ?>&image_name=<?php echo $image_name; ?>" class="btn-red">Delete</a>
                              </td>
                            </tr>
                            
              


                    <?php
                  }
          
    
    
      }else {
        
        // we dont have data im database
        // we will display message
        ?>
        <tr>
        <td colspan="6"><div class="error">No Category added</div></td>
        </tr>
        <?php
        
      }

      ?>
                  </table>
                    
                    
                   </div>
                </div>




  <!-- End of Main Section -->

<?php include('./partial/footer.php'); ?>