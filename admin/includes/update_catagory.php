<form class="" action="" method="post">

    <div class="form-group">
      <label for="cat_title">Edit Catagory </label>

      <?php
        if(isset($_GET['edit']))
        {
          $edit_cat_id=$_GET['edit'];

          $sql="SELECT * FROM catagory WHERE id = $edit_cat_id ";
          $select_edit_catagory=mysqli_query($connection,$sql);
          while ($row=mysqli_fetch_assoc($select_edit_catagory))
          {
            $cat_id=$row['id'];
            $cat_title=$row['title'];
        ?>
          <input value="<?php if(isset($cat_title)) {  echo $cat_title; } ?>" class="form-control" type="text" name="cat_title">

      <?php }  } ?>

      <?php
        if(isset($_POST['update_catagory']))
        {
          $update_cat_id=$_POST['cat_title'];
          $update_sql="UPDATE catagory SET title = '{$update_cat_id}'
                        WHERE id= {$cat_id}";
          $up_quey=mysqli_query($connection,$update_sql);
          if(!$up_quey)
          {
            die("QUERY FAILED" . mysqli_error($connection));
          }
        }
       ?>

    </div>

    <div class="form-group">
      <input class="btn btn-primary" type="submit" name="update_catagory" value="Update Catagory">
    </div>

</form>  <!-- Edit Form  -->
