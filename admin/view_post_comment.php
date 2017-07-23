
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
        <th>Delete</th>

    </tr>
    </thead>
    </thead>

    <tbody>
    <?php

    if ($_GET['post_id'])
    {
        $the_comment_id=$_GET['post_id'];
    }
    $sql="SELECT * FROM comments WHERE comment_post_id = $the_comment_id";
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
            echo    '<td>'.$comment_status.'</td>';


            $sql="SELECT * FROM posts WHERE post_id= $comment_post_id";
            $select_post_id_query=mysqli_query($connection,$sql);
            while ($row=mysqli_fetch_assoc($select_post_id_query))
            {
                $post_id=$row['post_id'];
                $post_title=$row['post_title'];
                echo '<td><a href="../post.php?p_id='.$post_id.'" >'.$post_title.'</a></td>';
            }


                     
                     
                     
            echo '  <td>'.$comment_date.'</td>';

            echo   "<td><a href='comments.php?approve=$comment_id'>Approve</a></td>";
            echo   "<td><a href='comments.php?unapprove=$comment_id'>Unapprove</a></td>";

            echo   "<td><a href='comments.php?delete=$comment_id'>Delete</a></td>";// bo away ba $_GET btwanyn (id)y har postek war bgrin
            echo    "</tr>";
        }
    }

    ?>

    </tbody>
</table>

    <?php


    if(isset($_GET['approve']))
    {
        $approve_id=$_GET['approve'];
        $query2="UPDATE comments SET comment_status= 'approved'  WHERE comment_id =$approve_id";
        $delete_query=mysqli_query($connection,$query2);
        if(!$delete_query)
        {
            die("QUERY FAILED " . mysqli_error($connection));
        }
        header("Location: comments.php");// bo refresh krdnaway pageaka
    }

    if(isset($_GET['unapprove']))
    {
        $unapprove_id=$_GET['unapprove'];
        $query2="UPDATE comments SET comment_status= 'unapproved'  WHERE comment_id =$unapprove_id";
        $delete_query=mysqli_query($connection,$query2);
        if(!$delete_query)
        {
            die("QUERY FAILED " . mysqli_error($connection));
        }
        header("Location: comments.php");// bo refresh krdnaway pageaka
    }

    // DELETE COMMENT
    if(isset($_GET['delete'])) // am delete hy (key)akaya ==> ?delete
    {
        $delete_comment_id=$_GET['delete'];
        $query2="DELETE FROM comments WHERE comment_id =$delete_comment_id";
        $delete_query=mysqli_query($connection,$query2);
        if(!$delete_query)
        {
            die("QUERY FAILED " . mysqli_error($connection));
        }
        header("Location: comments.php");// bo refresh krdnaway pageaka
    }
    ?>


