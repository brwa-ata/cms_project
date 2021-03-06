<?php  include 'includes/header.php';  ?>

<body>

    <!-- Navigation -->
    <?php  include 'includes/navigation.php';   ?>

    <!-- Page Content -->
    <div class="container">

        <div class="row">

            <!-- Blog Entries Column -->

            <div class="col-md-8">

                <!-- QUERY TO SHOW PUBLISH POST -->
              <?php
                  $sql="SELECT * FROM posts";
                  $ex=mysqli_query($connection,$sql);
                  while ($row=mysqli_fetch_assoc($ex))
                   {
                      $post_id=$row['post_id'];
                      $post_title=$row['post_title'];
                      $post_author=$row['post_author'];
                      $post_date=$row['post_date'];
                      $post_image=$row['post_image'];
                      $post_content=substr($row['post_content'],0,10);// tanha 10 charactery sarata la postaka pshan ba
                       $post_status=$row['post_status'];

               if ($post_status == 'publish')
               {


                ?>
                <!-- First Blog Post -->
                <h1 class="page-header">
                    Page Heading
                    <small>Secondary Text</small>
                </h1>
                <h2>
                    <a href="post.php?p_id=<?php echo $post_id; ?>"><?php echo $post_title ?></a>
                </h2>
                <p class="lead">
                    by <a href="author_post.php?author=<?php echo $post_author ?>&p_id=<?php echo $post_id ?>"><?php echo $post_author ?></a>
                </p>
                <p><span class="glyphicon glyphicon-time"></span> <?php echo $post_date ?></p>
                <hr>
                   <a href="post.php?p_id=<?php echo $post_id; ?>">
                <img class="img-responsive" src="images/<?php echo $post_image ?>" alt="">
                   </a>
                <hr>

                <p><?php echo $post_content ?></p>

                <a class="btn btn-primary" href="post.php?p_id=<?php echo $post_id; ?>">Read More <span class="glyphicon glyphicon-chevron-right"></span></a>

                <hr>
                <?php } }?>

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
