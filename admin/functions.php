<?php

  function insert_catagories()
  {
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

?>
