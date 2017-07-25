<div class="col-md-4">

    <!-- Blog Search Well -->
    <div class="well">
        <h4>Blog Search</h4>
        <form action="search.php" method="post"><!-- am actiona wata har yatawa naw xoy -->
        <div class="input-group">
            <input name="search" type="text" class="form-control">
            <span class="input-group-btn">
                <button name="submit" class="btn btn-default" type="submit">
                    <span class="glyphicon glyphicon-search"></span>
            </button>
            </span>
        </div>
        </form>
        <!-- /.input-group -->
    </div>


    <!-- Login -->
    <div class="well">

        <?php
             if (isset($_SESSION['user_role']))
             {
               echo"  <h4>Logged in as  ".$_SESSION['username']."</h4>";

               echo "<a href='includes/logout.php' class='btn btn-primary'>Logout</a>";
             }
             else
             {
                 ?>

         <h4>Login</h4>
                <form action="includes/login.php" method="post">
                    <div class="form-group">
                        <input name="username" type="text" class="form-control" placeholder="Enter Username">
                    </div>

                    <div class="input-group">
                        <input name="password" type="password" class="form-control" placeholder="Enter Password">
                        <span class="input-group-btn">
                            <button class="btn btn-primary" name="login" type="submit">
                                Submit
                            </button>
                        </span>
                    </div>

                    <div class="form-group">
                        <a href="forgot.php?forgot=<?php echo uniqid(true); ?>">Forgot Password?</a>
                                                          // am uniid(true) ba shewayaky random id drust aka
                                                          //amash bo away parzraw betw hack nakre
                    </div>

                </form>

            <?php }
        ?>

    </div>


    <!-- Blog Categories Well -->
    <div class="well">

        <?php
            $sql="select * from catagory";
            $select_catagory_sidebar=mysqli_query($connection,$sql);
        ?>
        <h4>Blog Categories</h4>
        <div class="row">
            <div class="col-lg-12">
                <ul class="list-unstyled">
                    <?php
                        while ($row=mysqli_fetch_assoc($select_catagory_sidebar))
                        {
                            $catagory_id=$row['id'];
                            echo "<li><a href='catagory.php?catagory=$catagory_id'>{$row['title']}</a></li>";
                        }
                    ?>
                </ul>
            </div>
        </div>
        <!-- /.row -->
    </div>

    <!-- Side Widget Well -->
    <?php
        include "widget.php";
    ?>

</div>
