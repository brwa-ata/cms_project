<?php
    if (isset($_POST['checkBoxArray']))
    {

        foreach ($_POST['checkBoxArray'] as $checkBox_id_Value)
        {
            $bulk_options=$_POST['bulk_options'];
            switch ($bulk_options)
            {
                case 'publish':
                    $sql="UPDATE posts SET post_status='$bulk_options'
                          WHERE post_id=$checkBox_id_Value";
                    $update_to_publish=mysqli_query($connection,$sql);
                    break;

                case  'draft':
                    $sql="UPDATE posts SET post_status='$bulk_options'
                          WHERE post_id=$checkBox_id_Value";
                    $update_to_publish=mysqli_query($connection,$sql);
                    break;

                case 'delete':
                    $delete_sql="DELETE FROM posts WHERE post_id= $checkBox_id_Value";
                    $delete_posts=mysqli_query($connection,$delete_sql);
                    if (!$delete_posts)
                        die("QUERY FAILED " . mysqli_error($connection));
                    break;

                case 'clone':
                    $sql="SELECT * FROM posts WHERE post_id=$checkBox_id_Value";
                    $select_post_query=mysqli_query($connection,$sql);
                    if(!$select_post_query)
                    {
                        echo "FIRST";
                        die("QUERY FAILED ". mysqli_error($connection));
                    }

                    while ($row = mysqli_fetch_array($select_post_query))
                    {

                        $post_author      = $row["post_author"];
                        $post_user        = $row["post_user"];
                        $post_title       = $row["post_title"];
                        $post_catagory_id = $row["post_catagory_id"];
                        $post_status      = $row["post_status"];
                        $post_image       = $row["post_image"];
                        $post_tags        = $row["post_tags"];
                        $post_content     = $row["post_content"];
                        $post_date        = $row["post_date"];

                        if (empty($post_tags))
                        {
                            $post_tags="No tags";
                        }
                    }

                    $query="INSERT INTO posts(post_catagory_id,post_title,post_author,post_user,post_date,post_image,post_content,post_tags,post_status)
                            VALUES ($post_catagory_id,'$post_title','$post_author','$post_user',NOW(),'$post_image','$post_content ','$post_tags','$post_status')";

                    $copy_query=mysqli_query($connection,$query);
                    if (!$copy_query)
                    {

                        die("QUERY FAILED " . mysqli_error($connection));
                    }

                    break;


            }
        }

    }


?>
<form action="" method="post">
    <table class="table table-bordered table-hover">


            <div class="col-xs-4" id="bulkOptionContainer">
                <select class="form-control" name="bulk_options">
                    <option value="">_</option>
                    <option value="publish">Publish</option>
                    <option value="draft">Draft</option>
                    <option value="clone">Clone</option>
                    <option value="delete">Delete</option>
                </select>
            </div>

            <div class="col-xs-4">
                <input type="submit" name="submit" class="btn btn-success" value="Apply">
                <a href="posts.php?source=add_post" class="btn btn-primary">Add New</a>
            </div>

        <thead>
            <thead>
               <tr>
                   <th><input type="checkbox" id="selectAllBoxes"></th>
                  <th>Id</th>
                  <th>User</th>
                  <th>Title</th>
                  <th>Category</th>
                  <th>Status</th>
                  <th>Image</th>
                  <th>Tags</th>
                  <th>Comments</th>
                  <th>Date</th>
                   <th>Delete</th>
                   <th>Edit</th>
                   <th>Views</th>

               </tr>
            </thead>
        </thead>

        <tbody>
            <?php
              $sql="SELECT * FROM posts ORDER BY post_id DESC ";
              $show_query=mysqli_query($connection,$sql);
              if(!$show_query)
              {
                die("QUERY FAILED ". mysqli_error($connection));
              }
              else
              {
                while ($row=mysqli_fetch_assoc($show_query))
                {
                  $post_id            =$row["post_id"];
                  $post_author        =$row["post_author"];
                  $post_user          =$row['post_user'];
                  $post_title         =$row["post_title"];
                  $post_catagory_id   =$row["post_catagory_id"];
                  $post_status        =$row["post_status"];
                  $post_image         =$row["post_image"];
                  $post_tags          =$row["post_tags"];
                  $post_comment_count =$row["post_comment_count"];
                  $post_date          =$row["post_date"];
                  $post_view_count    =$row['post_view_count'];

                     echo '<tr>';
                     ?>

        <td><input name="checkBoxArray[]" value="<?php echo $post_id; ?>" type="checkbox" class="checkbox"></td>


                    <?php
                          echo ' <td>'.$post_id.'</td>';

                          if (!empty($post_author))
                          {
                              echo "<td>$post_author</td>";
                          }
                          elseif(!empty($post_user))
                          {
                              echo "<td>$post_user</td>";
                          }


                          echo  '<td>'.$post_title.'</td>';

                            // bo henany nawy catagoryiaka la tabley catagory
                            $sql="SELECT * FROM catagory WHERE id=$post_catagory_id";
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
                                }
                              }
                      echo    '<td>'.$cat_title.'</td>';
                      echo    '<td>'.$post_status.'</td>';
                      echo     "<td> <img width=130 src='../images/$post_image'></td>"; // bo pshandany rasmy naw databaseaka
                      echo     '<td>'.$post_tags.'</td>';

                      $query="SELECT * FROM comments WHERE comment_post_id= $post_id";
                      $send_comment_query=mysqli_query($connection,$query);

                      $row=mysqli_fetch_assoc($send_comment_query);
                      $comment_post_id=$row['comment_post_id'];
                      $count_comment=mysqli_num_rows($send_comment_query);

                      echo "<td><a href='view_post_comment.php?post_id=$comment_post_id'>$count_comment</a></td>";

                      echo '  <td>'.$post_date.'</td>';
                      ?>

                    <form action="" method="post">
                        <input type="hidden" name="post_id" value="<?php echo $post_id; ?>">
                        <?php
                              echo '<td><input class="btn btn-danger" type="submit" name="delete" value="Delete"></td>';
                        ?>
                    </form>

                     <?php
                      //echo    "<td><a href='posts.php?delete={$post_id}'>Delete</a></td>";// bo away ba $_GET btwanyn (id)y har postek war bgrin
                      echo    "<td><a class='btn btn-info' href='posts.php?source=edit_posts&p_id={$post_id}'>Edit</a></td>"; //(source) chwnka la posts.php bakarman henawa =edit_posts chwnka la case waman danawa gar source yaksan bw bama
                      echo    "<td><a href='posts.php?delete_view={$post_id}'>{$post_view_count}</a></td>";                                               // ba bcheta pagey edit_posts (&) chwnka $_GET esta 2 key haya (p_id) bo away (id)y postaka warbgrun
                      echo    "</tr>";                                                                  // kawata esta bam shewaya ka (edit)man krd achyna pagey editawa ka atwanin edit bkayn bo aw posta



                }
              }
            ?>
        </tbody>
    </table>
</form>

<?php // DELETE POSTS
    if(isset($_POST['delete'])) // am delete hy (key)akaya ==> ?delete
    {
      $delete_cat_id=$_POST['delete'];
      $query2="DELETE FROM posts WHERE post_id = {$delete_cat_id} ";
      $delete_query=mysqli_query($connection,$query2);
      if(!$delete_query)
      {
        die("QUERY FAILED " . mysqli_error($connection));
      }
      header("Location: posts.php");// bo refresh krdnaway pageaka
    }
?>

<?php // DELETE VIEWS
    if (isset($_GET['delete_view']))
    {
        $view_post_id=$_GET['delete_view'];
        $sql="UPDATE posts SET post_view_count=0 WHERE post_id=$view_post_id";
        $erase_views=mysqli_query($connection,$sql);
        if (!$erase_views)
        {
            die("QUERY FAILED ". mysqli_error($connection));
        }
        header("Location: posts.php");
    }

?>

