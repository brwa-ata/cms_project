<?php

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
        $query="INSERT INTO catagory(title)
                VALUES('$cat_title') ";
        $create_catagory_query=mysqli_query($connection,$query);
        if(!$create_catagory_query)
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

?>
