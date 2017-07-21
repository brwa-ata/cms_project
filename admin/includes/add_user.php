<?php
  if(isset($_POST['create_user']))
  {
    $post_title=$_POST['title'];
    $post_author=$_POST['author'];
    $post_catagory_id=$_POST['post_catagory'];
    $post_status=$_POST['post_status'];

    $post_image=$_FILES['post_image']['name']; // BO CHOOSEKRDNY IMG BAKAR DE
    $post_image_temp=$_FILES['post_image']['tmp_name']; // TEMPORARY LOCATION DRWST AKA LA NAW SERVER

    $post_tags=$_POST['post_tags'];
    $post_content=$_POST['post_content'];
    $post_date=date('d-m-y');


    move_uploaded_file($post_image_temp,"../images/$post_image"); // BO UPLOAD KRDNY IMAGE BAKAR YAT

    $sql="INSERT INTO posts(post_catagory_id,post_title,post_author,post_date,
        post_image,post_content,post_tags,post_status)
          VALUES({$post_catagory_id},'{$post_title}','{$post_author}',
            NOW(),'{$post_image}','{$post_content}','{$post_tags}',
            '{$post_status}')";

          $create_post_query=mysqli_query($connection,$sql);
          if(!$create_post_query)
          {
            die("QUERY FAILED " . mysqli_error($connection));
          }

  }
?>
<form  action="" method="post" enctype="multipart/form-data">

    <div class="form-group">
        <label for="author">Firstname</label>
        <input type="text" class="form-control" name="user_firstname">
    </div>

    <div class="form-group">
        <label for="post_status">Lastname</label>
        <input type="text" class="form-control" name="user_lastname">
    </div>

    <select name="user_role" id="">
        <option value="subscriber">Select Role</option>
        <option value="admin">Admin</option>
        <option value="subscriber">Subscriber</option>
    </select>




                <!--  <div class="form-group">
                    <label for="post_image"></label>
                    <input type="file" name="post_image">
                  </div>
                -->


  <div class="form-group">
    <label for="post_tags">Username</label>
    <input type="text" class="form-control" name="username">
  </div>

  <div class="form-group">
    <label for="post_content">Email</label>
    <input type="email" class="form-control" name="user_email">
  </div>

    <div class="form-group">
        <label for="post_content">Password</label>
        <input type="password" class="form-control" name="user_password">
    </div>

  <div class="form-group">
    <input class="btn btn-primary" type="submit" name="create_user" value="Add user">
  </div>

</form>
