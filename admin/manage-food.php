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
     ?>
     <table class="tbl-full">
      <tr>
        <th>S.N</th>
        <th>Fullname</th>
        <th>Username</th>
        <th>Action</th>
      </tr>
      <tr>
        <td>1</td>
        <td>ullas kiran</td>
        <td>user@admin</td>
        <td>
          <a href="#" class="btn-second">Update</a>
          <a href="#" class="btn-red">Delete</a>
        </td>
      </tr>
      <tr>
        <td>2</td>
        <td>ullas kiran</td>
        <td>user@admin</td>
        <td>
        <a href="#" class="btn-second">Update</a>
          <a href="#" class="btn-red">Delete</a>
        </td>
      </tr>
      <tr>
        <td>3</td>
        <td>ullas kiran</td>
        <td>user@admin</td>
        <td>
        <a href="#" class="btn-second">Update</a>
          <a href="#" class="btn-red">Delete</a>
        </td>
      </tr>
      <tr>
        <td>4</td>
        <td>ullas kiran</td>
        <td>user@admin</td>
        <td>
        <a href="#" class="btn-second">Update</a>
          <a href="#" class="btn-red">Delete</a>
        </td>
      </tr>
    </table>
    
     
    </div>
  </div>

  <!-- End of Main Section -->

<?php include('./partial/footer.php'); ?>