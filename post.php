<?php  include 'includes/header.php';  ?>

<body>

    <!-- Navigation -->
    <?php  include 'includes/navigation.php';   ?>

    <!-- Page Content -->
    <div class="container">

        <div class="row">

            <!-- Blog Entries Column -->

            <div class="col-md-8">

          <?php
            if(isset($_GET['p_id'])) {

                $the_post_id = $_GET['p_id'];

                $view_query = "UPDATE posts SET post_view_count=post_view_count + 1 WHERE post_id=$the_post_id ";
                $send_query = mysqli_query($connection, $view_query);

                if (!$send_query) {
                    die("QUERY FAILED " . mysqli_error($connection));
                }


                if (isset($_SESSION['user_role']) && $_SESSION['user_role'] == 'Admin') {
                    $sql = "SELECT * FROM posts WHERE post_id= $the_post_id ";
                } else {
                    $sql = "SELECT * FROM posts WHERE post_id= $the_post_id AND  post_status='publish'";
                }


                $ex = mysqli_query($connection, $sql);


                if (mysqli_num_rows($ex) < 1) {
                    echo "<h1 class='text-center'>No posts available</h1>";
                } else {
                    while ($row = mysqli_fetch_assoc($ex)) {
                        $post_title = $row['post_title'];
                        $post_author = $row['post_author'];
                        $post_date = $row['post_date'];
                        $post_image = $row['post_image'];
                        $post_content = $row['post_content'];
                        ?>

                        <!-- First Blog Post -->
                        <h1 class="page-header">
                            Posts
                        </h1>
                        <h2>
                            <a href="#"><?php echo $post_title ?></a>
                        </h2>
                        <p class="lead">
                            by <a href="index.php"><?php echo $post_author ?></a>
                        </p>
                        <p><span class="glyphicon glyphicon-time"></span> <?php echo $post_date ?></p>
                        <hr>
                        <img class="img-responsive" src="images/<?php echo $post_image ?>" alt="">

                        <hr>
                        <p><b><?php echo $post_content ?></b></p>
                    <?php }


                    ?>


                    <!-- Blog Comments -->

                    <?php
                    if (isset($_POST['create_comment'])) {
                        $post_id = $_GET['p_id'];
                        $comment_author = $_POST['comment_author'];
                        $comment_email = $_POST['comment_email'];
                        $comment_content = $_POST['comment_content'];

                        if (empty($_POST['comment_author']) || empty($_POST['comment_email']) || empty($_POST['comment_content'])) {
                            echo "<script>
                                    alert('FIELDS CAN NOT BE EMPTY');
                                  </script>";
                        } else {
                            $comment_sql = "INSERT INTO comments(comment_post_id,comment_author,comment_email,comment_content,comment_status,comment_date) 
                                      VALUES ($post_id,'$comment_author','$comment_email','$comment_content','unproved',now())";
                            $ex_comment_sql = mysqli_query($connection, $comment_sql);
                            if (!$ex_comment_sql) {
                                die("QUERY FAILED" . mysqli_error($connection));
                            }

                            echo "<script>
                                    alert('Comment posted');
                                  </script>";


                            /*  $sql="UPDATE posts SET post_comment_count= post_comment_count + 1
                                WHERE post_id=$post_id"; // bamay sarawa indexy naw am columna la naw databaseaka zyad akain basm shewaya harchan comment bkre bo postaka countek zyad aka
                              $count_comment=mysqli_query($connection,$sql);
                              if (!$count_comment){
                                  die("QUERY FAILED". mysqli_error($connection));
                              }*/
                        }

                    }
                    ?>

                    <!-- Comments Form -->
                    <div class="well">
                        <h4>Leave a Comment:</h4>
                        <form action="" method="post" role="form">

                            <div class="form-group">
                                <label for="comment_author">Author</label>
                                <input class="form-control" type="text" name="comment_author">
                            </div>

                            <div class="form-group">
                                <label for="comment_email">Email</label>
                                <input class="form-control" type="email" name="comment_email">
                            </div>

                            <div class="form-group">
                                <label for="comment">Your Comment</label>
                                <textarea name="comment_content" class="form-control" rows="3"></textarea>
                            </div>
                            <button name="create_comment" type="submit" class="btn btn-primary">Submit</button>
                        </form>
                    </div>

                    <hr>

                    <!-- Posted Comments -->
                    <?php

                    if (isset($_GET['p_id'])) {
                        $the_post_id = $_GET['p_id'];

                        $query = "SELECT * FROM comments WHERE comment_post_id=$the_post_id AND 
                            comment_status= 'approved' ORDER BY comment_id DESC ";
                        $select_comment_query = mysqli_query($connection, $query);

                        if (!$select_comment_query) {

                            die("QUERY FAILED" . mysqli_error($connection));
                        } else {

                            while ($row = mysqli_fetch_assoc($select_comment_query)) {
                                $comment_date = $row['comment_date'];
                                $comment_content = $row['comment_content'];
                                $comment_author = $row['comment_author'];

                                ?>

                                <!-- Comment -->
                                <div class="media">
                                    <a class="pull-left" href="#">
                                        <img class="media-object" src="http://placehold.it/64x64" alt="">
                                    </a>
                                    <div class="media-body">
                                        <h4 class="media-heading"><?php echo $comment_author; ?>
                                            <small><?php echo $comment_date; ?></small>
                                        </h4>
                                        <?php echo $comment_content; ?>
                                    </div>
                                </div>

            <?php           }
                        }
                    }
                }
            }
            else
            {
                header("Location: index.php");
            }?>

            </div>

            <!-- Blog Sidebar Widgets Column -->

              <?php  include 'includes/sidebar.php';   ?>

        </div>
        <hr>
        <?php
        include 'includes/footer.php';
        ?>
      </div>
        <!-- /.row -->


</body>

</html>
