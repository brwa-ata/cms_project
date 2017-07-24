<?php include 'includes/header.php'; ?>

<div id="wrapper">

<?php

    $session=session_id();// wargrtny IDy aw useray ka log in bwa
    $time=time(); // aw katay ka daxl bwa
    $time_out_in_seconds=60; // dway chane pshany bat ka online namawa ama chrkakaya
    $time_out=$time - $time_out_in_seconds; // bam krdara aw kataman dasakawe ka tyaya user offline abe

    $query="SELECT * FROM online_users WHERE os_session = '$session'";
    $ex_query=mysqli_query($connection,$query);

    $count=mysqli_num_rows($ex_query); // zhmarndy aw lasanay ka onlinen


    if ($count == null) // wata kate yakam user dax abe chwnka law kataya count==null labar away hych la (db)yakaya nyia wata jare kas online nyia
        //bam shewaya (ID) am useraw katakay insert akayn bo naw (DB)y online user
    {
       $s= mysqli_query($connection,"INSERT INTO online_users(os_session,os_time) VALUES ('$session','$time')");
        if (!$s)
        {
            die("FAILED  " . mysqli_error($connection));
        }
    }
    else// wata gar pesh am kasa usery tr login bbw wata pesh am kaseky tr la xata
    {
       $r =mysqli_query($connection,"UPDATE online_users SET os_time='$time' WHERE os_session='$session'");
        if (!$r)
        {
            die("QUERY FAILED  " . mysqli_error($connection));
        }
    }

    // bo zhmardny aw kasanay ka la xatn
    $users_online=mysqli_query($connection,"SELECT * FROM online_users WHERE  os_time > '$time_out'");
    if (!$users_online)
    {
        die("QUERY FAILED  " . mysqli_error($connection));
    }
        $count_user=mysqli_num_rows($users_online);

    $_SESSION['num_of_online_user']=$count_user;
?>

<!-- Navigation -->

<?php include 'includes/navigation.php'; ?>


<div id="page-wrapper">

    <div class="container-fluid">

        <!-- Page Heading -->
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">
                    Welcome to Admin
                    <small><?php echo $_SESSION['username']; ?></small>
                </h1>

            </div>
        </div>

        <!-- /.row -->

        <!-- /.row -->

        <div class="row">
            <div class="col-lg-3 col-md-6">
                <div class="panel panel-primary">
                    <div class="panel-heading">
                        <div class="row">
                            <div class="col-xs-3">
                                <i class="fa fa-file-text fa-5x"></i>
                            </div>
                            <div class="col-xs-9 text-right">

                                <?php

                                    $post_count=countRecord('posts'); // pet ale ka chan post haya chwnka aw har royak 7sab aka
                                    echo " <div class='huge'>$post_count</div>";

                                ?>
                                <div>Posts</div>
                            </div>
                        </div>
                    </div>
                    <a href="posts.php">
                        <div class="panel-footer">
                            <span class="pull-left">View Details</span>
                            <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                            <div class="clearfix"></div>
                        </div>
                    </a>
                </div>
            </div>
            <div class="col-lg-3 col-md-6">
                <div class="panel panel-green">
                    <div class="panel-heading">
                        <div class="row">
                            <div class="col-xs-3">
                                <i class="fa fa-comments fa-5x"></i>
                            </div>
                            <div class="col-xs-9 text-right">

                                <?php

                                    $comment_count=countRecord('comments');
                                    echo "<div class='huge'>$comment_count</div>";
                                ?>

                                <div>Comments</div>
                            </div>
                        </div>
                    </div>
                    <a href="comments.php">
                        <div class="panel-footer">
                            <span class="pull-left">View Details</span>
                            <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                            <div class="clearfix"></div>
                        </div>
                    </a>
                </div>
            </div>
            <div class="col-lg-3 col-md-6">
                <div class="panel panel-yellow">
                    <div class="panel-heading">
                        <div class="row">
                            <div class="col-xs-3">
                                <i class="fa fa-user fa-5x"></i>
                            </div>
                            <div class="col-xs-9 text-right">

                                <?php
                                    $user_count=countRecord('users');
                                    echo "<div class='huge'>$user_count</div>";
                                ?>

                                <div> Users</div>
                            </div>
                        </div>
                    </div>
                    <a href="users.php">
                        <div class="panel-footer">
                            <span class="pull-left">View Details</span>
                            <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                            <div class="clearfix"></div>
                        </div>
                    </a>
                </div>
            </div>
            <div class="col-lg-3 col-md-6">
                <div class="panel panel-red">
                    <div class="panel-heading">
                        <div class="row">
                            <div class="col-xs-3">
                                <i class="fa fa-list fa-5x"></i>
                            </div>
                            <div class="col-xs-9 text-right">

                                <?php
                                    $catagory_count=countRecord('catagory');
                                    echo "<div class='huge'>$catagory_count</div>";
                                ?>

                                <div>Categories</div>
                            </div>
                        </div>
                    </div>
                    <a href="catagories.php">
                        <div class="panel-footer">
                            <span class="pull-left">View Details</span>
                            <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                            <div class="clearfix"></div>
                        </div>
                    </a>
                </div>
            </div>
        </div>
        <!-- /.row -->


        <?php

        /***
         * bang krdnaway functiony checkStatus() ka recordy har yak la tablekan adozetawa ba pey marjaka
         */
            $post_draft_count=checkStatus('posts','post_status','draft');

            $post_publish_count=checkStatus('posts','post_status','publish');

            $unapproved_comment_count=checkStatus('comments','comment_status','unproved');

            $sub_user_count=checkStatus('users','user_role','subscriber');
        ?>


        <div class="row">

            <script type="text/javascript">
                google.charts.load('current', {'packages':['bar']});
                google.charts.setOnLoadCallback(drawChart);

                function drawChart() {
                    var data = google.visualization.arrayToDataTable([
                        ['Data', 'Count'],

                        <?php

                            $element_text=['All posts','Active Post','Draft Posts','Comments','Pending Comment','Users','Subscribers','Categories'];
                            $element_count=[$post_count,$post_publish_count,$post_draft_count,$comment_count,$unapproved_comment_count,$user_count,$sub_user_count,$catagory_count];

                            for ($i=0 ; $i<8;$i++)
                            {
                                echo "['$element_text[$i]'" . "," . "$element_count[$i]],";
                            }

                        ?>

                    ]);

                    var options = {
                        chart: {
                            title: '',
                            subtitle: '',
                        }
                    };

                    var chart = new google.charts.Bar(document.getElementById('columnchart_material'));

                    chart.draw(data, google.charts.Bar.convertOptions(options));
                }
            </script>

            <!-- am scriptay xwarawa pewsyta bo kar pe krdny scriptakay sarawa -->
            <div id="columnchart_material" style="width: auto; height: 500px;"></div>

        </div>

    </div>
    <!-- /.container-fluid -->

</div>
<!-- /#page-wrapper -->

<?php include 'includes/fotter.php'; ?>
