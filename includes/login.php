<?php include 'db.php'; ?>
<?php session_start(); //labar away kar lagal user akayn pewsytman ba session abe bamash session ishy pe akre ?>
<?php
    if(isset($_POST['login']))
    {
        $user_name=$_POST['username'];
        $user_password=$_POST['password'];

        mysqli_real_escape_string($connection,$user_name);// naheshtny sql injection
        mysqli_real_escape_string($connection,$user_password);

        $query="SELECT * FROM users WHERE username='$user_name'";
        $select_user_query=mysqli_query($connection,$query);
        if (!$select_user_query)
        {
            die("QUERY FAILED " . mysqli_error($connection));
        }
        while ($row=mysqli_fetch_assoc($select_user_query))
        {
            $user_id=$row['user_id'];
            $username=$row['username'];
            $password=$row['user_password'];
            $user_firstname=$row['user_firstname'];
            $user_lastname=$row['user_lastname'];
            $user_role=$row['user_role'];
        }
        $user_password=crypt($user_password,$password);// this is like a decryption

        if ($user_name !== $username && $user_password !== $password)
        {
            header("Location: ../index.php"); // gar uname pass rast nabw bgarewa bo pagey saraky
        }
        else if($user_name == $username && $user_password == $password)
        {

            $_SESSION['username']=$username;
            $_SESSION['firstname']=$user_firstname;
            $_SESSION['lastname']=$user_lastname;
            $_SESSION['user_role']=$user_role;

            header("Location: ../admin");
        }
        else
        {
            header("Location: ../index.php");

        }


    }
?>
