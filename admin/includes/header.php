<?php ob_start(); ?>
<?php session_start(); ?>
<?php include '../includes/db.php';?>
<?php include 'functions.php';?>

<?php
    //gar bam shewaya codeaka bnwsyn harchana kar aka balam
    //la katy logout bwny user chwnka ['user_role']
    //heshta har ba set krawy mawata har atwanyn babe login nchynawa naw admin
    // charasary am keshayash bam shewayay xwarawa abe
    /*if (isset($_SESSION['user_role']))
    {
       if($_SESSION['user_role'] !== 'Admin')
       {
           header("Location: ../index.php"); // wata agar admin nabw ba nacheta zhwrawaw bgaretawa ba pagey saraky
       }
    }*/

    if (!isset($_SESSION['user_role']))
    {
        header("Location: ../index.php");
        //wata gar chytr ['user_role'] set nakrabw (wakw peshtr yaksanman krd ba null)
        // awa ba bchetawa pagey saraky wata chytr natwane rastawxo brwatawa admin babe login
    }

?>
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>SB Admin - Bootstrap Admin Template</title>

    <!-- Bootstrap Core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="css/sb-admin.css" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

    <!-- LINK BO CHARTAKAY NAW ADMIN CHNWKA EMA EMPLATE BAKAR AHENYN BOYA AM LINKA PEWYSTA -->
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>

    <!-- am linka pewysta bo kar pe krdny aw simple editoray ka bakary ahenyn la edit_post
    <script src="https://cloud.tinymce.com/stable/tinymce.min.js"></script>
    -->

    <!-- link to the js file
    <script src="js/js.js"></script>
    -->

</head>

<body>
