<?php
    include("connect_database.php");
    $id = $_POST['id'];
    $name = $_POST['name'];
    $phone = $_POST['phone'];
    $password = $_POST['password'];

    $check_query = mysqli_query($connection,"select userid from common_user where userid = '$id'");
    if(mysqli_num_rows($check_query)>0){
        $return['status']=1;
    }
    else{
        $sql = "INSERT INTO common_user(userid ,username ,password ,phone) VALUES ('$id','$name','$password','$phone')";
        if(mysqli_query($connection,$sql))
            $return['status']=0;
    }
    echo json_encode($return);
    mysqli_close($connection);
?>
            