
<table class="table table-bordered table-hover">
    <thead>
    <thead>
    <tr>
        <th>Id</th>
        <th>username</th>
        <th>Firstname</th>
        <th>Lastname</th>
        <th>Email</th>
        <th>Role</th>



    </tr>
    </thead>
    </thead>

    <tbody>
    <?php
    $sql="SELECT * FROM users";
    $select_users=mysqli_query($connection,$sql);
    if(!$select_users)
    {
        die("QUERY FAILED ". mysqli_error($connection));
    }
    else
    {
        while ($row=mysqli_fetch_assoc($select_users))
        {
            $user_id=$row["user_id"];
            $username=$row["username"];
            $user_password=$row["user_password"];
            $user_firstname=$row["user_firstname"];
            $user_lastname=$row["user_lastname"];
            $user_email=$row["user_email"];
            $user_image=$row["user_image"];
            $user_role=$row["user_role"];

            echo '<tr>
                        <td>'.$user_id.'</td>
                        <td>'.$username.'</td>
                        <td>'.$user_firstname.'</td>';

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

            echo    '<td>'.$user_lastname.'</td>';
            echo    '<td>'.$user_email.'</td>';
            echo    '<td>'.$user_role.'</td>';

/*
            $sql="SELECT * FROM posts WHERE post_id= $comment_post_id";
            $select_post_id_query=mysqli_query($connection,$sql);
            while ($row=mysqli_fetch_assoc($select_post_id_query))
            {
                $post_id=$row['post_id'];
                $post_title=$row['post_title'];
                echo '<td><a href="../post.php?p_id='.$post_id.'" >'.$post_title.'</a></td>';
            }

*/
                     
                     


            echo   "<td><a href='comments.php?approve='>Approve</a></td>";
            echo   "<td><a href='comments.php?unapprove='>Unapprove</a></td>";

            echo   "<td><a href='comments.php?delete='>Delete</a></td>";// bo away ba $_GET btwanyn (id)y har postek war bgrin
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


