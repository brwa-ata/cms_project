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
          $update_cat_title=$_POST['cat_title'];

            $query=mysqli_prepare($connection,"UPDATE catagory SET title = ? WHERE id= ? ") ;

            mysqli_stmt_bind_param($query,'si',$update_cat_title,$cat_id);
            mysqli_stmt_execute($query);

          if(!$query)
          {
            die("QUERY FAILED" . mysqli_error($connection));
          }

          header("Location: catagories.php");
        }
       ?>

    </div>

    <div class="form-group">
      <input class="btn btn-primary" type="submit" name="update_catagory" value="Update Catagory">
    </div>

</form>  <!-- Edit Form  -->
