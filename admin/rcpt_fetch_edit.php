<?php
session_start();
	include('../config/connectdb.php');
	$id=$_REQUEST['id'];
	$sql="SELECT rental.*,crane.c_name,payment_type.pm_name,users.fullname,users.urole,crane.c_num FROM rental LEFT JOIN crane ON rental.c_id=crane.c_id LEFT JOIN payment_type ON rental.pm_id=payment_type.pm_id LEFT JOIN users ON rental.users_id=users.users_id  where r_id ='$id' ";
	$result=mysqli_query($conn,$sql);
    $row=mysqli_fetch_array($result);
    
   


      if ($row['urole'] == 'VIP'){

            $row['c_num']= $row['c_num']* (100 - 15) / 100;

        }else {
            $row['c_num']= $row['c_num'];

        }

     $row['allnum']= $row['c_num']*$row['r_numdate'];

	echo json_encode($row);
?>
