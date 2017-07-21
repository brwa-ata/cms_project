<?php session_start(); //labar away kar lagal user akayn pewsytman ba session abe bamash session ishy pe akre ?>
<?php

    $_SESSION['username']=null; // batal krdnaway session yan cancel kedny session
    $_SESSION['firstname']=null;
    $_SESSION['lastname']=null;
    $_SESSION['user_role']=null;

    header("Location: ../index.php");

?>