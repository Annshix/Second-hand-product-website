<?php
    session_start();
    include("connect_database.php");
    $des= $_POST['des'];
    $name = $_POST['name'];
    $place = $_POST['place'];
    $cost = $_POST['cost'];
    $uid=$_SESSION['userid '];
    $photo='http://img01.taobaocdn.com/bao/uploaded/i1/T1B0CzXllkXXa_ca7T_010708.jpg_b.jpg';
    $sql = "INSERT INTO product(product_name ,description ,place ,cost, userid,photo) VALUES ('$name','$des','$place','$cost','$uid','$photo')";
    if(mysqli_query($connection,$sql))
       $return['status']=0;
    else
        $return['status']=1;
    echo json_encode($return);
    mysqli_close($connection);
?>
            