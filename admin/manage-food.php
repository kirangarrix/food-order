<?php include('./partial/menu.php'); ?>
 <!-- Main Section -->
 <div class="main-content">
    <div class="wrapper">
     <h1>Manage Food</h1>
     <br>
     <!-- Button -->
     <a href="<?php echo SITEURL ?>admin/add-food.php" class="btn-color">Add food</a>
     <br><br><br>
     <?php
         if(isset($_SESSION['add'])){
           echo $_SESSION['add'];
           unset($_SESSION['add']);
         }
         if(isset($_SESSION['delete'])){
          echo $_SESSION['delete'];
          unset($_SESSION['delete']);
        }
        if(isset($_SESSION['upload'])){
          echo $_SESSION['upload'];
          unset($_SESSION['upload']);
        }
        if(isset($_SESSION['unauthorize'])){
          echo $_SESSION['unauthorize'];
          unset($_SESSION['unauthorize']);
        }
        if(isset($_SESSION['update'])){
          echo $_SESSION['update'];
          unset($_SESSION['update']);
        }
     ?>
     <table class="tbl-full">
      <tr>
        <th>S.N</th>
        <th>Title</th>
        <th>Price</th>
        <th>Image</th>
        <th>Featured</th>
        <th>Active</th>
        <th>Action</th>
      </tr>
  
   <?php
    // create sql query to get all the food
    $sql="SELECT * FROM tbl_food";
    // execute the query
    $res=mysqli_query($conn,$sql);
    // count to check whether we have food or not
    $count=mysqli_num_rows($res);

    // create variable 
    $sn=1;

    if($count>0){
      // we have food in database
      while($row=mysqli_fetch_assoc($res)){
         $id=$row['id'];
         $title=$row['title'];
         $price=$row['price'];
         $image_name=$row['image_name'];
         $featured=$row['featured'];
         $active=$row['active'];
         ?>
    
            <tr>
              <td><?php echo $sn++; ?></td>
              <td><?php echo $title; ?></td>
              <td><?php echo $price; ?></td>
              <td><?php 
                      if($image_name==""){
                       echo  "<div class='error'>Image not added</div>";
                      }else{
                        ?>
                        <img src="<?php echo SITEURL; ?>images/food/<?php echo $image_name; ?>" width="100px">
                        <?php
                      }
                     ?></td>
              <td><?php echo $featured; ?></td>
              <td><?php echo $active; ?></td>
              <td>
                <a href="<?php echo SITEURL ?>admin/update-food.php?id=<?php echo $id ?>" class="btn-second">Update</a>
                <a href="<?php echo SITEURL ?>admin/delete-food.php?id=<?php echo $id; ?>&image_name=<?php echo $image_name; ?>" class="btn-red">Delete</a>
              </td>
            </tr>
          
         <?php
      }

    }else{
      // food is not added in database
      echo"<tr><td colspan='7' class='error'>Food not added yet</td><tr>";
    }
   ?>      
    </table>
    
     
    </div>
  </div>

  <!-- End of Main Section -->

<?php include('./partial/footer.php'); ?>