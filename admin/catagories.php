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

                          <?php
                          // INSERTING CATAGORIES
                            if(isset($_POST['submit']))
                            {
                              $cat_title=$_POST['cat_title'];
                              if(empty($cat_title))
                              {
                                echo "This field should not be empty";
                              }
                              else
                              {
                                $query="INSERT INTO catagory(title)
                                        VALUES('$cat_title') ";
                                $create_catagory_query=mysqli_query($connection,$query);
                                if(!$create_catagory_query)
                                {
                                  die("QUERY FAILED". mysqli_error($connection));
                                }
                              }
                            }
                           ?>

                           <!-- ADD CATAGORIES FORM  -->
                          <form class="" action="" method="post">

                              <div class="form-group">
                                <label for="cat_title">Add Catagory</label>
                                <input class="form-control" type="text" name="cat_title">
                              </div>

                              <div class="form-group">
                                <input class="btn btn-primary" type="submit" name="submit" value="Add Catagory">
                              </div>

                          </form><!-- ADD CATAGORIES FORM  -->


                          <!-- Edit Form  -->
                          <?php
                            if(isset($_GET['edit']))
                            {
                              $cat_id=$_GET['edit'];
                              include 'includes/update_catagory.php';
                            }
                           ?>


                        </div><!-- Add Catagory form -->

                        <div class="col-xs-6">

                          <table class="table table-bordered table-hover">
                            <thead>
                              <tr>
                                <th>Id</th>
                                <th>Catagory Title</th>
                              </tr>
                            </thead>
                            <tbody>

                              <?php
                                  //FIND ALL CATAGORIES

                                  $sql="select * from catagory";
                                  $select_catagory=mysqli_query($connection,$sql);
                                  while ($row=mysqli_fetch_assoc($select_catagory))
                                  {
                                    $cat_id=$row['id'];
                                    $cat_title=$row['title'];

                                    echo "<tr>";

                                    echo "<td>{$cat_id}</td>";
                                    echo "<td>{$cat_title}</td>";
                                    echo "<td><a href='catagories.php?delete={$cat_id}'>Delete</a></td>";
                                    echo "<td><a href='catagories.php?edit={$cat_id}'>Edit</a></td>";
                                    // ama bo srynaway datakan bakar yat (delete) chwnka GET assoc arraya ama abeta key
                                    echo "</tr>";
                                  }
                              ?>

                              <?php
                                //DELETE catagories
                                if(isset($_GET['delete'])) // am delete hy (key)akaya ==> ?delete
                                {
                                  $delete_cat_id=$_GET['delete'];
                                  $query2="DELETE FROM catagory WHERE id = {$delete_cat_id} ";
                                  $delete_query=mysqli_query($connection,$query2);
                                  header("Location: catagories.php");// bo refresh krdnaway pageaka
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
