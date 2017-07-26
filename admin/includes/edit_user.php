<?php

if (isset($_GET['u_id'])) {
    $the_user_id = $_GET['u_id'];

    $query = "SELECT * FROM users WHERE user_id=$the_user_id";
    $get_query = mysqli_query($connection, $query);
    if (!$get_query) {
        die("QUERY FAILED" . mysqli_error($connection));
    } else
        {
        while ($row = mysqli_fetch_assoc($get_query))
        {
            $user_firstname = $row['user_firstname'];
            $user_lastname = $row['user_lastname'];
            $user_role = $row['user_role'];
            $user_image = $row['user_image'];
            $username = $row['username'];
            $user_email = $row['user_email'];
            $user_password = $row['user_password'];
        }
    }

    if (isset($_POST['edit_user'])) {

        $user_firstname = $_POST['user_firstname'];
        $user_lastname = $_POST['user_lastname'];
        $user_role = $_POST['user_role'];
        // $user_image=$_POST['user_image'];
        $username = $_POST['username'];
        $user_email = $_POST['user_email'];
        $user_password = $_POST['user_password'];

        // wrgrtnaway nrxa randomaka bo encrypt krdn
        // ama bo awaya kate password update akaynawa passwordaka dwbara encrypt bkretawa
        // chwnka garwa nakayn awa passwordaka har wakw xoy la dbyaka save abe babe encrypt

        if (!empty($user_password))
        {
            $sql2 = "SELECT randSalt FROM users";
            $ex = mysqli_query($connection, $sql2);
            if (!$ex) {
                die("QUERY FAILED " . mysqli_error());
            }
            $row = mysqli_fetch_array($ex);
            $salt = $row['randSalt'];
            $hashed_password = crypt($user_password, $salt);


            $sql = "UPDATE users SET  
          username='$username',
          user_firstname='$user_firstname',
          user_lastname='$user_lastname',
          user_role='$user_role',
          user_email='$user_email',
          user_password='$hashed_password'   
          WHERE user_id=$the_user_id";
            $update_user_query = mysqli_query($connection, $sql);
            if (!$update_user_query) {
                die("QUERY FAILED " . mysqli_error($connection));
            } else {
                echo "Updated successfully";
            }
        }
        else
        {
            $sql = "UPDATE users SET  
          username='$username',
          user_firstname='$user_firstname',
          user_lastname='$user_lastname',
          user_role='$user_role',
          user_email='$user_email'   
          WHERE user_id=$the_user_id";
            $update_user_query = mysqli_query($connection, $sql);
            if (!$update_user_query) {
                die("QUERY FAILED " . mysqli_error($connection));
            } else {
                echo "Updated successfully";
            }
        }

    }
}
else
{
    header("Location: index.php");
}

?>
<form  action="" method="post" enctype="multipart/form-data">

    <div class="form-group">
        <label for="author">Firstname</label>
        <input value="<?php echo $user_firstname; ?>" type="text" class="form-control" name="user_firstname">
    </div>

    <div class="form-group">
        <label for="post_status">Lastname</label>
        <input value="<?php echo $user_lastname; ?>" type="text" class="form-control" name="user_lastname">
    </div>

    <select name="user_role" id="">
        <option value="<?php echo $user_role; ?>"><?php echo $user_role; ?></option>
        <?php
            if ($user_role=='Admin')
            {
                echo '<option value="subscriber">Subscriber</option>';
            }
            else
            {
                echo '<option value="Admin">Admin</option>';
            }
        ?>
    </select>

<!--
    <div class="form-group">
        <label for="user_image"></label>
        <input value="<?php echo $db_user_image; ?>" type="file" name="user_image">
    </div>
-->

    <div class="form-group">
        <label for="post_tags">Username</label>
        <input value="<?php echo $username; ?>" type="text" class="form-control" name="username">
    </div>

    <div class="form-group">
        <label for="post_content">Email</label>
        <input value="<?php echo $user_email; ?>" type="email" class="form-control" name="user_email">
    </div>

    <div class="form-group">
        <label for="post_content">Password</label>
        <input value="" type="password" class="form-control" name="user_password">
    </div>

    <div class="form-group">
        <input class="btn btn-primary" type="submit" name="edit_user" value="Update user">
    </div>

</form>
