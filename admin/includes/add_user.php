<?php
  if(isset($_POST['create_user']))
  {

    $user_firstname=$_POST['user_firstname'];
    $user_lastname=$_POST['user_lastname'];
    $user_role=$_POST['user_role'];

    $user_image=$_FILES['image']['name']; // BO CHOOSEKRDNY IMG BAKAR DE
    $user_image_temp=$_FILES['image']['tmp_name']; // TEMPORARY LOCATION DRWST AKA LA NAW SERVER

    $username=$_POST['username'];
    $user_email=$_POST['user_email'];
    $user_password=$_POST['user_password'];
  //  $post_date=date('d-m-y');


    move_uploaded_file($user_image_temp,"../images/$user_image"); // BO UPLOAD KRDNY IMAGE BAKAR YAT

    $sql="INSERT INTO users(username,user_password,user_firstname,user_lastname,user_email,user_image,user_role) 
          VALUES ('$username','$user_password','$user_firstname','$user_lastname','$user_email','$user_image','$user_role')";

          $add_user_query=mysqli_query($connection,$sql);
          if(!$add_user_query)
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


     <div class="form-group">
        <label for="user_image"></label>
        <input type="file" name="image">
      </div>


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
