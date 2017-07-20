<?php
  if(isset($_POST['create_post']))
  {
    $post_title=$_POST['title'];
    $post_author=$_POST['author'];
    $post_catagory_id=$_POST['post_catagory_id'];
    $post_status=$_POST['post_status'];

    $post_image=$_FILES['post_image']['name']; // BO CHOOSEKRDNY IMG BAKAR DE
    $post_image_temp=$_FILES['post_image']['tmp_name']; // TEMPORARY LOCATION DRWST AKA LA NAW SERVER

    $post_tags=$_POST['post_tags'];
    $post_content=$_POST['post_content'];
    $post_date=date('d-m-y');
    $post_comment_count=4;

    move_uploaded_file($post_image_temp,"../images/$post_image"); // BO UPLOAD KRDNY IMAGE BAKAR YAT

    $sql="INSERT INTO posts(post_catagory_id,post_title,post_author,post_date,
        post_image,post_content,post_tags,post_comment_count,post_status)
          VALUES({$post_catagory_id},'{$post_title}','{$post_author}',
            NOW(),'{$post_image}','{$post_content}','{$post_tags}',
            '{$post_comment_count}','{$post_status}')";

          $create_post_query=mysqli_query($connection,$sql);
          if(!$create_post_query)
          {
            die("QUERY FAILED " . mysqli_error($connection));
          }

  }
?>
<form  action="" method="post" enctype="multipart/form-data">

  <div class="form-group">
    <label for="title">Post Title</label>
    <input type="text" class="form-control" name="title">
  </div>

  <div class="form-group">
    <label for="post_catagory_id">Post Catagory</label>
    <input type="text" class="form-control" name="post_catagory_id">
  </div>

  <div class="form-group">
    <label for="author">Post Author</label>
    <input type="text" class="form-control" name="author">
  </div>

  <div class="form-group">
    <label for="post_status">Post Status</label>
    <input type="text" class="form-control" name="post_status">
  </div>

  <div class="form-group">
    <label for="post_image">Post Image</label>
    <input type="file" name="post_image">
  </div>

  <div class="form-group">
    <label for="post_tags">Post Tags</label>
    <input type="text" class="form-control" name="post_tags">
  </div>

  <div class="form-group">
    <label for="post_content">Post Content</label>
    <textarea type="text" class="form-control" name="post_content" id="" cols="30" rows="10">
    </textarea>
  </div>

  <div class="form-group">
    <input class="btn btn-primary" type="submit" name="create_post" value="Publish Post">
  </div>

</form>
