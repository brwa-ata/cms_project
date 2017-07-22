<?php
    if(isset($_GET['p_id']))
    {
      $p_id=$_GET['p_id'];

      $sql="SELECT * FROM posts WHERE post_id=$p_id";
      $select_posts_by_id=mysqli_query($connection,$sql);
      if(!$select_posts_by_id)
      {
        die("QUERY FAILED ". mysqli_error($connection));
      }
      else
      {
        while ($row=mysqli_fetch_assoc($select_posts_by_id))
        {
          $post_id=$row["post_id"];
          $post_author=$row["post_author"];
          $post_title=$row["post_title"];
          $post_catagory_id=$row["post_catagory_id"];
          $post_status=$row["post_status"];
          $post_image=$row["post_image"];
          $post_content=$row['post_content'];
          $post_tags=$row["post_tags"];
          $post_comment_count=$row["post_comment_count"];
          $post_date=$row["post_date"];
        }
      }
      if(isset($_POST['update_post']))
      {
        $post_author=$_POST['author'];
        $post_title=$_POST['title'];
        $post_catagory_id=$_POST['post_catagory'];
        $post_status=$_POST['post_status'];
        $post_image=$_FILES['image']['name'];// bo wargrtnaway image ha abe $_FILES bakar be
        $post_image_temp=$_FILES['image']['tmp_name'];
        $post_content=$_POST['post_content'];
        $post_tags=$_POST['post_tags'];

        move_uploaded_file($post_image_temp,"../images/$post_image");

        if(empty($post_image)) // labar away imageaka keshay tya bw darna akawt
        {
          $qury="SELECT * FROM posts WHERE post_id= $p_id "; // boya la regay am queryiawa
          $select_image=mysqli_query($connection,$sql); // esta imageaka la katy update krdnawaya darakawe

            while ($row=mysqli_fetch_array($select_image))
            {
              $post_image=$row['post_image'];
            }

        }
        $update_query="UPDATE posts SET
                       post_title = '{$post_title}' ,
                       post_catagory_id = '{$post_catagory_id}' ,
                       post_date = NOW() ,
                       post_author = '{$post_author}' ,
                       post_status = '{$post_status}' ,
                       post_tags = '{$post_tags}' ,
                       post_content = '{$post_content}' ,
                       post_image = '{$post_image}' 
                        WHERE post_id= {$p_id} ";
          $ex_update_query=mysqli_query($connection,$update_query);
          if(!$ex_update_query)
          {
            die("QUERY FAILED " . mysqli_error($connection));
          }
          
          echo "<p class='bg-success'>Post Updated. <a href='../post.php?p_id={$p_id}'>View post</a></p>";

      }
    }
?>

<form  action="" method="post" enctype="multipart/form-data">

  <div class="form-group">
    <label for="title">Post Title</label>
    <input value="<?php echo $post_title; ?>" type="text" class="form-control" name="title">
  </div>

  <div class="form-group">
      <select class="" name="post_catagory">

        <?php
          $sql="SELECT * FROM catagory ";
          $select_catagory=mysqli_query($connection,$sql);
          if(!$select_catagory)
          {
            die("QUERY FAILED" .mysqli_error($connection));
          }
          else
          {
              while ($row=mysqli_fetch_assoc($select_catagory))
              {
                $cat_id=$row['id'];
                $cat_title=$row['title'];
                echo "<option value='$cat_id'>$cat_title</opstion>";
              }
          }
        ?>
      </select>
  </div>

  <div class="form-group">
    <label for="author">Post Author</label>
    <input value="<?php echo $post_author; ?>" type="text" class="form-control" name="author">
  </div>

<div class="form-group">
    <select name="post_status" id="">
        <option value="<?php echo $post_status; ?>"> <?php echo $post_status; ?> </option>

        <?php
            if ($post_status == 'publish')
            {
                echo "<option value='draft'>daft</option>";
            }
            else
            {
                echo "<option value='publish'>publish</option>";
            }
        ?>
    </select>
</div>


  <div class="form-group">
    <img  width="400" src="../images/<?php echo $post_image; ?>" alt="">
    <input type="file" name="image" >
  </div>



  <div class="form-group">
    <label for="post_tags">Post Tags</label>
    <input value="<?php echo $post_tags; ?>" type="text" class="form-control" name="post_tags">
  </div>

  <div class="form-group">
    <label for="post_content">Post Content</label>
    <textarea  type="text" class="form-control" name="post_content" id="" cols="30" rows="10"><?php echo $post_content; ?>

    </textarea>
  </div>

  <div class="form-group">
    <input class="btn btn-primary" type="submit" name="update_post" value="Update Post">
  </div>

</form>
