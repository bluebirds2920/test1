<?php
session_start();
if (isset($_POST['rent'])) {
    $_SESSION["c_id"] =  $_POST["c_id"];
}
header("location: rent_check.php");
?>