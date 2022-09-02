<?php
include('../config/connectdb.php');


    $id = mysqli_real_escape_string($conn, $_POST["r_idx"]);
    $r_numdate = mysqli_real_escape_string($conn, $_POST["r_numdate"]);
    $r_place = mysqli_real_escape_string($conn, $_POST["r_place"]);

    $sql = "update rental set r_numdate ='$r_numdate',r_place ='$r_place' where r_id ='$id'";
    $result = mysqli_query($conn, $sql) or die("กรุณาใส่ข้อมูลให้ครบถ้วน");
    
    echo "แก้ไขข้อมูลเรียบร้อย";
    mysqli_close($conn);



?>