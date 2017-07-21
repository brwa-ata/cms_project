
<table class="table table-bordered table-hover">
    <thead>
        <thead>
           <tr>
              <th>Id</th>
              <th>Author</th>
              <th>Title</th>
              <th>Catagory</th>
              <th>Statuis</th>
              <th>Image</th>
              <th>Tags</th>
              <th>Comments</th>
              <th>Date</th>
               <th>Delete</th>
               <th>Edit</th>

           </tr>
        </thead>
    </thead>

    <tbody>
        <?php
          $sql="SELECT * FROM posts";
          $show_query=mysqli_query($connection,$sql);
          if(!$show_query)
          {
            die("QUERY FAILED ". mysqli_error($connection));
          }
          else
          {
            while ($row=mysqli_fetch_assoc($show_query))
            {
              $post_id=$row["post_id"];
              $post_author=$row["post_author"];
              $post_title=$row["post_title"];
              $post_catagory_id=$row["post_catagory_id"];
              $post_status=$row["post_status"];
              $post_image=$row["post_image"];
              $post_tags=$row["post_tags"];
              $post_comment_count=$row["post_comment_count"];
              $post_date=$row["post_date"];

                 echo '<tr>
                        <td>'.$post_id.'</td>
                        <td>'.$post_author.'</td>
                        <td>'.$post_title.'</td>';

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
                  echo "<td> <img width=130 src='../images/$post_image'></td>"; // bo pshandany rasmy naw databaseaka
                  echo '<td>'.$post_tags.'</td>
                        <td>'.$post_comment_count.'</td>
                        <td>'.$post_date.'</td>';
                  echo   "<td><a href='posts.php?delete={$post_id}'>Delete</a></td>";// bo away ba $_GET btwanyn (id)y har postek war bgrin
                  echo   "<td><a href='posts.php?source=edit_posts&p_id={$post_id}'>Edit</a></td>";
                  echo    "</tr>";//(source) chwnka la posts.php bakarman henawa =edit_posts chwnka la case waman danawa gar source yaksan bw bama
                                  // ba bcheta pagey edit_posts (&) chwnka $_GET esta 2 key haya (p_id) bo away (id)y postaka warbgrun
                                  // kawata esta bam shewaya ka (edit)man krd achyna pagey editawa ka atwanin edit bkayn bo aw posta
            }
          }
        ?>

        <?php // DELETE POSTS
            if(isset($_GET['delete'])) // am delete hy (key)akaya ==> ?delete
            {
              $delete_cat_id=$_GET['delete'];
              $query2="DELETE FROM posts WHERE post_id = {$delete_cat_id} ";
              $delete_query=mysqli_query($connection,$query2);
              if(!$delete_query)
              {
                die("QUERY FAILED " . mysqli_error($connection));
              }
              header("Location: posts.php");// bo refresh krdnaway pageaka
            }
        ?>

    </tbody>
</table>
