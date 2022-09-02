<?php
include('../config/connectdb.php');


    $id = mysqli_real_escape_string($conn, $_POST["id"]);
    $em_firstname = mysqli_real_escape_string($conn, $_POST["em_name_UpD"]);
    $em_lastname = mysqli_real_escape_string($conn, $_POST["em_surname_UpD"]);
    $em_phone = mysqli_real_escape_string($conn, $_POST["em_phone_UpD"]);

    $sql = "update employee set em_lastname ='$em_lastname',em_firstname='$em_firstname',em_phone ='$em_phone' where em_id='$id'";
    $result = mysqli_query($conn, $sql) or die("กรุณาใส่ข้อมูลให้ครบถ้วน");
    echo "แก้ไขข้อมูลเรียบร้อย";
    mysqli_close($conn);



?>