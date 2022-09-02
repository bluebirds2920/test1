<?php
include('../config/connectdb.php');


    $id = mysqli_real_escape_string($conn, $_POST["id"]);
    
    $urole = mysqli_real_escape_string($conn, $_POST["urole"]);

    $sql = "update users set urole ='$urole' where users_id ='$id'";
    $result = mysqli_query($conn, $sql) or die("กรุณาใส่ข้อมูลให้ครบถ้วน");
    echo "แก้ไขข้อมูลเรียบร้อย";
    mysqli_close($conn);



?>