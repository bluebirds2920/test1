<?php
include('../config/connectdb.php');


    $id = mysqli_real_escape_string($conn, $_POST["rcpt_id_form2"]);
   
    $rcpt_role = 'ชำระสำเร็จ';
    $sql = "update rcpt set rcpt_role ='$rcpt_role' where rcpt_id ='$id'";
    $result = mysqli_query($conn, $sql) or die("กรุณาใส่ข้อมูลให้ครบถ้วน");
    
    echo "ยืนยันการชำระบริการสำเร็จ";
    mysqli_close($conn);



?>