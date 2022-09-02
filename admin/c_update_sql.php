<?php
include('../config/connectdb.php');


    $id = mysqli_real_escape_string($conn, $_POST["id"]);
    $c_name = mysqli_real_escape_string($conn, $_POST["c_name_UpD"]);
    $ct_id = mysqli_real_escape_string($conn, $_POST["ct_id_UpD"]);
    $c_details = mysqli_real_escape_string($conn, $_POST["c_Det_UpD"]);

    $sql = "update crane set ct_id ='$ct_id',c_name='$c_name',c_details ='$c_details' where c_id='$id'";
    $result = mysqli_query($conn, $sql) or die("กรุณาใส่ข้อมูลให้ครบถ้วน");
    echo "แก้ไขข้อมูลเรียบร้อย";
    mysqli_close($conn);



?>