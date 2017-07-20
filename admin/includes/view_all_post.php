
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
              $cat_id=$row["post_id"];
              $post_image=$row["post_image"];
                echo '<tr>
                        <td>'.$row["post_id"].'</td>
                        <td>'.$row["post_author"].'</td>
                        <td>'.$row["post_title"].'</td>
                        <td>'.$row["post_catagory_id"].'</td>
                        <td>'.$row["post_status"].'</td>';
                  echo "<td> <img width=130 src='../images/$post_image'></td>"; // bo pshandany rsmy naw databaseaka
                  echo '<td>'.$row["post_tags"].'</td>
                        <td>'.$row["post_comment_count"].'</td>
                        <td>'.$row["post_date"].'</td>';
                  echo   "<td><a href='posts.php?delete={$cat_id}'>Delete</a></td>
                      </tr>";
            }
          }
        ?>

        <?php
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
