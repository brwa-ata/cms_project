
<?php session_start(); ?>
<nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
    <div class="container">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="index.php">CMS Front</a>
        </div>
        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            <ul class="nav navbar-nav">

                <?php $sql="select * from catagory";
                $run=mysqli_query($connection,$sql);
                while ($row=mysqli_fetch_assoc($run))
                {
                    $category_id=$row['id'];
                    $category_class = '';

                    $registration_class='';

                    $page_name=basename($_SERVER['PHP_SELF']); // bo wargrnty nawy aw pageay ka tyayayn

                    $registration = 'registration.php';
                    if(isset($_GET['catagory']) && $_GET['catagory'] == $category_id)
                    {
                        $category_class='active';
                    }
                    elseif ($page_name == $registration )
                    {
                        $registration_class='active';
                    }
                    echo "<li class='$category_class'><a href='catagory.php?catagory=$category_id'>{$row['title']}</a></li>";
                }
                ?>
                <li>
                    <a href="admin">Admin</a>
                </li>
                <li>
                    <a href="./registration.php">Registration</a>
                </li>

                <li>
                    <a href="./contact.php">Contact</a>
                </li>

                <?php
                    if (isset($_SESSION['username']))
                    {
                        if (isset($_GET['p_id']))
                        {
                            $the_post_id=$_GET['p_id'];

                            echo "<li><a href='admin/posts.php?source=edit_posts&p_id=$the_post_id'>Edit Post</a> </li>";
                        }

                    }

                ?>

            </ul>
        </div>
        <!-- /.navbar-collapse -->
    </div>
    <!-- /.container -->
</nav>
