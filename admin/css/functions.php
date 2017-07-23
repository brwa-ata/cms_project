<?php

function users_online()
{
    global $connection;

    $session=session_id();// wargrtny IDy aw useray ka log in bwa
    $time=time(); // aw katay ka daxl bwa
    $time_out_in_seconds=60; // dway chane pshany bat ka online namawa ama chrkakaya
    $time_out=$time - $time_out_in_seconds; // bam krdara aw kataman dasakawe ka tyaya user offline abe

    $query="SELECT * FROM online_users WHERE os_session = '$session'";
    $ex_query=mysqli_query($connection,$query);

    $count=mysqli_num_rows($ex_query); // zhmarndy aw lasanay ka onlinen


    if ($count == null) // wata kate yakam user dax abe chwnka law kataya count==null labar away hych la (db)yakaya nyia wata jare kas online nyia
        //bam shewaya (ID) am useraw katakay insert akayn bo naw (DB)y online user
    {
        $s= mysqli_query($connection,"INSERT INTO online_users(os_session,os_time) VALUES ('$session','$time')");
        if (!$s)
        {
            die("FAILED  " . mysqli_error($connection));
        }
    }
    else// wata gar pesh am kasa usery tr login bbw wata pesh am kaseky tr la xata
    {
        $r =mysqli_query($connection,"UPDATE online_users SET os_time='$time' WHERE os_session='$session'");
        if (!$r)
        {
            die("QUERY FAILED  " . mysqli_error($connection));
        }
    }

    // bo zhmardny aw kasanay ka la xatn
    $users_online=mysqli_query($connection,"SELECT * FROM online_users WHERE  os_time > '$time_out'");
    if (!$users_online)
    {
        die("QUERY FAILED  " . mysqli_error($connection));
    }
    $count_user=mysqli_num_rows($users_online);

    $_SESSION['num_of_online_user']=$count_user;
}

?>