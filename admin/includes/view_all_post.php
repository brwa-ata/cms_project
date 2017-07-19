
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
                        <td>'.$row["post_date"].'</td>
                      </tr>';
            }
          }
        ?>

    </tbody>
</table>
