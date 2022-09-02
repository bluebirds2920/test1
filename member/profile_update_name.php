<?php
include('../config/connectdb.php');


    $id = mysqli_real_escape_string($conn, $_POST["id"]);
    $fullname = mysqli_real_escape_string($conn, $_POST["fullname"]);
    

    $sql = "update users set fullname ='$fullname' where users_id='$id'";
    $result = mysqli_query($conn, $sql) or die("กรุณาใส่ข้อมูลให้ครบถ้วน");
    echo "แก้ไขข้อมูลเรียบร้อย";
    mysqli_close($conn);



?>