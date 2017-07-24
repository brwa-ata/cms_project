<?php  include 'includes/header.php';  ?>
<?php  include 'admin/functions.php';  ?>

<body>

    <!-- Navigation -->
    <?php  include 'includes/navigation.php';   ?>

    <!-- Page Content -->
<div class="container">

    <div class="row">

        <!-- Blog Entries Column -->

        <div class="col-md-8">


              <?php

                  if(isset($_GET['catagory']))
                  {

                      $post_catagory_id=$_GET['catagory'];

                      if (is_admin($_SESSION['username']))
                      {
                          // ama pey awtre prepared statement bo securety basha chnka ba bakar henany ama
                          // ka natwane beta naw (DB)yakatawa w dastkary bka bam shewaya projectakaman parezraw abe
                          $stm1=mysqli_prepare($connection,"SELECT post_id,post_title,post_author,post_date,post_image,post_content
                                                                    FROM posts WHERE post_catagory_id= ? ");
                      }
                      else
                          {
                          $stm2=mysqli_prepare($connection,"SELECT post_id,post_title,post_author,post_date,post_image,post_content 
                                                                    FROM posts WHERE post_catagory_id= ? AND post_status= ? ");
                            $publish='publish';
                      }

                      if (isset($stm1))
                      {
                          // ama chand variable waragre yakamyan dyara wa dwmyan formaty aw place holdera
                          //(?) ka leraya typakay (integera) boya (i) da aneyn gar (string) bw (s) da aneyn
                          // wa agar hardwkyman habw awa (is) da aneyn
                          // seyamyan aw variablea da aneyn ka amanawe bcheta jegay aw place holdera
                          mysqli_stmt_bind_param($stm1, "i",$post_catagory_id);

                          mysqli_stmt_execute($stm1);

                          mysqli_stmt_bind_result($stm1,$post_id,$post_title,$post_author,$post_date,$post_image,$post_content);

                          $stmt=$stm1;
                      }
                      else
                      {
                          mysqli_stmt_bind_param($stm2, "is",$post_catagory_id,$publish);

                          mysqli_stmt_execute($stm2);

                          mysqli_stmt_bind_result($stm2,$post_id,$post_title,$post_author,$post_date,$post_image,$post_content);

                          $stmt=$stm2;
                      }

                      if (mysqli_stmt_num_rows($stmt) === 1 )
                      {
                          echo "<h1 class='text-center'> No Categories available</h1>";
                      }

                          while (mysqli_stmt_fetch($stmt))
                           {
                               /*
                              $post_id=$row['post_id'];
                              $post_title=$row['post_title'];
                              $post_author=$row['post_author'];
                              $post_date=$row['post_date'];
                              $post_image=$row['post_image'];
                              $post_content=$row['post_content'];
                               */
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
                                        by <a href="index.php"><?php echo $post_author ?></a>
                                    </p>
                                    <p><span class="glyphicon glyphicon-time"></span> <?php echo $post_date ?></p>
                                    <hr>
                                    <img class="img-responsive" src="images/<?php echo $post_image ?>" alt="">
                                    <hr>
                                    <p><?php echo $post_content ?></p>
                                    <a class="btn btn-primary" href="#">Read More <span class="glyphicon glyphicon-chevron-right"></span></a>
                                    <hr>

                    <?php
                           }


                  }
                     ?>

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
