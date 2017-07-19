<?php include 'includes/header.php'; ?>
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

                        <!-- Add Catagory form -->
                        <div class="col-xs-6">

                          <form class="" action="" method="post">

                              <div class="form-group">
                                <label for="cat_title">Add Catagory</label>
                                <input class="form-control" type="text" name="cat_title">
                              </div>

                              <div class="form-group">
                                <input class="btn btn-primary" type="submit" name="submit" value="Add Catagory">
                              </div>

                          </form>

                        </div><!-- Add Catagory form -->

                        <div class="col-xs-6">

                          <?php
                              $sql="select * from catagory";
                              $select_catagory=mysqli_query($connection,$sql);
                          ?>

                          <table class="table table-bordered table-hover">
                            <thead>
                              <tr>
                                <th>Id</th>
                                <th>Catagory Title</th>
                              </tr>
                            </thead>
                            <tbody>

                              <?php
                                  while ($row=mysqli_fetch_assoc($select_catagory))
                                  {
                                    $cat_id=$row['id'];
                                    $cat_title=$row['title'];
                                    
                                    echo "<tr>";

                                    echo "<td>{$cat_id}</td>";
                                    echo "<td>{$cat_title}</td>";

                                    echo "</tr>";
                                  }
                              ?>

                            </tbody>
                          </table>

                        </div>

                    </div>
                </div>
                <!-- /.row -->

            </div>
            <!-- /.container-fluid -->

        </div>
        <!-- /#page-wrapper -->

<?php include 'includes/fotter.php'; ?>
