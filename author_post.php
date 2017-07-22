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
                if(isset($_GET['p_id']) )
                {
                  $post_id=$_GET['p_id'];
                  $the_post_author=$_GET['author'];
                }
              ?>

              <?php
                  $sql="SELECT * FROM posts WHERE post_author='$the_post_author' ";
                  $ex=mysqli_query($connection,$sql);
                  while ($row=mysqli_fetch_assoc($ex))
                   {
                      $post_title=$row['post_title'];
                      $post_author=$row['post_author'];
                      $post_date=$row['post_date'];
                      $post_image=$row['post_image'];
                      $post_content=$row['post_content'];
                ?>
                <!-- First Blog Post -->
                <h1 class="page-header">
                    Page Heading
                    <small>Secondary Text</small>
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
                <?php } ?>



                <!-- Blog Comments -->


                <!-- Comments Form -->


                <hr>

                <!-- Posted Comments -->


                        <!-- Comment -->




            </div>

            <!-- Blog Sidebar Widgets Column -->

              <?php  include 'includes/sidebar.php';   ?>

        </div>
      </div>
        <!-- /.row -->

        <hr>
        <?php
          include 'includes/footer.php';
         ?>
</body>

</html>
