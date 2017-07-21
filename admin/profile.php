<?php include 'includes/header.php'; ?>

<?php
    if (isset($_SESSION['username']))
    {
        $the_username =$_SESSION['username'];
        $sql="SELECT * FROM users WHERE username='$the_username'";

        $select_user_profile=mysqli_query($connection,$sql);

        while ($row= mysqli_fetch_array($select_user_profile))
        {
            $user_id=$row["user_id"];
            $username=$row["username"];
            $user_password=$row["user_password"];
            $user_firstname=$row["user_firstname"];
            $user_lastname=$row["user_lastname"];
            $user_email=$row["user_email"];
            $user_image=$row["user_image"];
            $user_role=$row["user_role"];
        }
    }
?>


<?php
        if (isset($_POST['edit_user']))
        {

            $user_firstname = $_POST['user_firstname'];
            $user_lastname = $_POST['user_lastname'];
            $user_role = $_POST['user_role'];
            // $user_image=$_POST['user_image'];
            $username = $_POST['username'];
            $user_email = $_POST['user_email'];
            $user_password = $_POST['user_password'];

            $sql="UPDATE users SET  
                  username='$username',
                  user_firstname='$user_firstname',
                  user_lastname='$user_lastname',
                  user_role='$user_role',
                  user_email='$user_email',
                  user_password='$user_password'   
                  WHERE username='$the_username'";
            $update_user_query = mysqli_query($connection, $sql);
            if (!$update_user_query)
            {
                die("QUERY FAILED " . mysqli_error($connection));
            }
            else
            {
                header("Location: users.php");
            }

        }
?>


<div id="wrapper">

    <!-- Navigation -->

    <?php include 'includes/navigation.php'; ?>

    <div id="page-wrapper">

        <div class="container-fluid">

            <!-- Page Heading -->
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">
                        Weolcome Admin
                        <small>Author</small>
                    </h1>

                    <!-- profile form -->
                    <form  action="" method="post" enctype="multipart/form-data">

                        <div class="form-group">
                            <label for="author">Firstname</label>
                            <input value="<?php echo $user_firstname?>" type="text" class="form-control" name="user_firstname">
                        </div>

                        <div class="form-group">
                            <label for="post_status">Lastname</label>
                            <input value="<?php echo $user_lastname?>" type="text" class="form-control" name="user_lastname">
                        </div>

                        <select name="user_role" id="">
                            <option value="subscriber"><?php echo $user_role?></option>
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

                        <div class="form-group">
                            <label for="post_tags">Username</label>
                            <input value="<?php echo $username?>" type="text" class="form-control" name="username">
                        </div>

                        <div class="form-group">
                            <label for="post_content">Email</label>
                            <input value="<?php echo $user_email?>" type="email" class="form-control" name="user_email">
                        </div>

                        <div class="form-group">
                            <label for="post_content">Password</label>
                            <input value="<?php echo $user_password?>" type="password" class="form-control" name="user_password">
                        </div>

                        <div class="form-group">
                            <input class="btn btn-primary" type="submit" name="edit_user" value="Update Profile">
                        </div>

                    </form>



                </div>
            </div>
            <!-- /.row -->

        </div>
        <!-- /.container-fluid -->

    </div>
    <!-- /#page-wrapper -->

    <?php include 'includes/fotter.php'; ?>
