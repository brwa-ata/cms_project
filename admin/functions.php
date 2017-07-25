<?php
/**
 * am functiona booleana peman ale  ka usera  admina yaxwd na
 *
 * @param string $username
 * @return bool
 */

function is_admin($username ='')
{
    global $connection;

    $sql="SELECT user_role FROM users WHERE username = '$username'";
    $result = mysqli_query($connection,$sql);
    if (!$result)
    {
        die("QUERY FAILED" .mysqli_error($connection));
    }

    $row= mysqli_fetch_array($result);
    if ($row['user_role'] == 'Admin')
    {
        return true;
    }
    else {
        return false;
    }
}


/****
 * nardny nawy table bo am functionaw zhmardny (row)ya kany ka admin/index pewystmana
 * @param $table
 * @return int
 *
 *
 */
function countRecord($table)
{
    global $connection;
    $sql="SELECT * FROM $table ";
    $select_all_post=mysqli_query($connection,$sql);
    if (!$select_all_post)
    {
        die("QUERY FAILED ". mysqli_error($connection));
    }

    $recordCount=mysqli_num_rows($select_all_post);

    return $recordCount;
}

/***
 *
 * @param $table
 * @param $column
 * @param $record
 * @return int
 */

function checkStatus($table,$column_name,$status)
{
    global  $connection;
    $sql="SELECT * FROM $table WHERE $column_name = '$status'";
    $get_query=mysqli_query($connection,$sql);
    if (!$get_query)
    {
        die("QUERY FAILED " . mysqli_error($connection));
    }

    $result = mysqli_num_rows($get_query);

    return $result;

}


/***
 * @param null $method
 * @return bool
 */
function ifItsMethod($method=null)
{
    if ($_SERVER['REQUEST_METHOD'] == strtoupper($method) )
    {
        return true;
    }
    else
    {
        return false;
    }
}

/***
 * @return bool
 */
function isLoggedIn()
{
    if ($_SESSION['user_role'])
    {
        return true;
    }
    else
    {
        return false;
    }
}

/**
 * @param string $redirectLocation
 */
function checkIfUserIsLoggedInAndRedirect($redirectLocation='')
{
    if (isLoggedIn())
    {
        header("Location:".$redirectLocation);
    }
}



function escape($string)// am functiona bakar de bo naheshty sql injection
    // boya har kate dataman la form wargrtawa ama bakar ahenyn
    //EX: $username= escape($_POST['username']);
{
    global  $connection;
    return mysqli_real_escape_string($connection,trim($string));

}


  function insert_catagories()
  {
    global $connection;// bo away connectionala lerasha rwbat
    if(isset($_POST['submit']))
    {
      $cat_title=$_POST['cat_title'];
      if(empty($cat_title))
      {
        echo "This field should not be empty";
      }
      else
      {


            $query=mysqli_prepare($connection,"INSERT INTO catagory(title) VALUES(?)") ;
            mysqli_stmt_bind_param($query,'s',$cat_title);
            mysqli_stmt_execute($query);

            if(!$query)
            {
              die("QUERY FAILED". mysqli_error($connection));
            }

      }
    }
  }

  function findAllCatagories()
  {
    global $connection;

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
  }

  function deleteCatagory()
  {
    global $connection;
    if(isset($_GET['delete'])) // am delete hy (key)akaya ==> ?delete
    {
      $delete_cat_id=$_GET['delete'];
      $query2="DELETE FROM catagory WHERE id = {$delete_cat_id} ";
      $delete_query=mysqli_query($connection,$query2);
      header("Location: catagories.php");// bo refresh krdnaway pageaka
    }
  }

?>
