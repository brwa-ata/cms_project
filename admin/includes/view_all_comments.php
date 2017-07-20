
<table class="table table-bordered table-hover">
    <thead>
    <thead>
    <tr>
        <th>Id</th>
        <th>Author</th>
        <th>Comment</th>
        <th>Email</th>
        <th>Status</th>
        <th>In Response to</th>
        <th>Date</th>
        <th>Approve</th>
        <th>Un approve</th>

    </tr>
    </thead>
    </thead>

    <tbody>
    <?php
    $sql="SELECT * FROM comments";
    $select_comment=mysqli_query($connection,$sql);
    if(!$select_comment)
    {
        die("QUERY FAILED ". mysqli_error($connection));
    }
    else
    {
        while ($row=mysqli_fetch_assoc($select_comment))
        {
            $comment_id=$row["comment_id"];
            $comment_post_id=$row["comment_post_id"];
            $comment_author=$row["comment_author"];
            $comment_content=$row["comment_content"];
            $comment_email=$row["comment_email"];
            $comment_status=$row["comment_status"];
            $comment_date=$row["comment_date"];
            echo '<tr>
                        <td>'.$comment_id.'</td>
                        <td>'.$comment_author.'</td>
                        <td>'.$comment_content.'</td>';

            // bo henany nawy catagoryiaka la tabley catagory
/*            $sql="SELECT * FROM catagory WHERE id=$post_catagory_id";
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

                    echo    '<td>'.$cat_title.'</td>';
                }
            }
  */

            echo    '<td>'.$comment_email.'</td>';
            echo    '<td>'.$comment_status.'</td>
                     <td>Some Title</td>
                     <td>'.$comment_date.'</td>';

            echo   "<td><a href='posts.php?delete='>Approve</a></td>";
            echo   "<td><a href='posts.php?delete='>Unapprove</a></td>";

            echo   "<td><a href='posts.php?delete='>Delete</a></td>";// bo away ba $_GET btwanyn (id)y har postek war bgrin
            echo   "<td><a href='posts.php?source=edit_posts&p_id='>Edit</a></td>";
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
