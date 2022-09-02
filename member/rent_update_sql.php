<?php
include('../config/connectdb.php');


    $id = mysqli_real_escape_string($conn, $_POST["r_id_rentform"]);
    $r_startdate = mysqli_real_escape_string($conn, $_POST["r_startdate_rentform"]);
    $r_numdate = mysqli_real_escape_string($conn, $_POST["r_numdate_rentform"]);
    $r_place = mysqli_real_escape_string($conn, $_POST["r_place_rentform"]);

 

    $sql = "update rental set r_startdate ='$r_startdate',r_numdate ='$r_numdate',r_place ='$r_place' where r_id='$id'";
    $result = mysqli_query($conn, $sql) or die("กรุณาใส่ข้อมูลให้ครบถ้วน");
    echo "แก้ไขข้อมูลเรียบร้อย";
    mysqli_close($conn);



?>