<?php
session_start();

if (isset($_GET["users_id"])) {
    $usersid = $_GET["users_id"];
}
?>

<!DOCTYPE html>
<html lang="en">

<?php
include("head.php");

?>

<body id="page-top">
    <!-- Page Wrapper -->
    <div id="wrapper">
        <!-- Sidebar -->
        <?php
        include("menu.php");
        ?>
        <!-- End of Sidebar -->

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <!-- Topbar -->
                <?php
                include("topbar.php");
                ?>
                <!-- End of Topbar -->

                <!-- Begin Page Content -->
                <div class="container-fluid">
                    <h1 class=" h3 mb-0 text-gray-800"><?php // echo $_SESSION['member_login']; 
                                                        ?></h1>
                    <?php

                    //ติดต่อฐานข้อมูล mysql
                    include('../config/connectdb.php');
                    //เขียนภาษา SQL

                    $sql = "SELECT * FROM users  WHERE users_id = $usersid";
                    $result = mysqli_query($conn, $sql) or die('sql ผิด');
                    //นับจำนวนข้อมูล

                    while ($row = mysqli_fetch_assoc($result)) {
                    ?>
                        <div class="card text-center">
                            <div class="card-header ">
                                <h2>ข้อมูลส่วนตัว
                                    <?php if ($row["urole"] == "VIP") {
                                    ?>
                                        <span class="text-warning">
                                        <?php echo  "( " . $row["urole"] . " )";
                                    } ?></span>
                                </h2>
                            </div>
                            <div class="  card-body bg-success ">
                                <h4 class="m-0 font-weight-bold text-dark">
                                    <?php
                                    echo "E-mail : " . $row["email"]
                                    ?>
                                </h4>
                                <br>
                                <h4 class="m-0 font-weight-bold text-dark">
                                    <?php
                                    echo "ชื่อ : " . $row["fullname"] . "<br>"; ?></h4>
                                <br>
                                <h4 class="m-0 font-weight-bold text-dark">
                                    <?php
                                    echo "เบอร์โทรศัพท์ : " . $row["phonenumber"] . "<br>";
                                    ?>
                                <?php
                            }
                                ?>
                            </div>
                        </div>
                        <?php $sqlsum = "SELECT SUM(rcpt_allnum) as allsumrcpt FROM rcpt LEFT JOIN rental ON rcpt.r_id=rental.r_id LEFT JOIN users ON rental.users_id=users.users_id WHERE users.users_id = $usersid  ";
                        $resultsum = mysqli_query($conn, $sqlsum) or die('sql ผิด');
                        while ($rowsum = mysqli_fetch_assoc($resultsum)) {
                            $allsum = $rowsum["allsumrcpt"];
                        } ?>
                        <?php $sqldaysum = "SELECT SUM(r_numdate) as numb FROM rental  LEFT JOIN users ON rental.users_id=users.users_id WHERE users.users_id = $usersid  ";
                        $resultdaysum = mysqli_query($conn, $sqldaysum) or die('sql ผิด');
                        while ($rowdaysum = mysqli_fetch_assoc($resultdaysum)) {
                            $alldaysum = $rowdaysum["numb"];
                        } ?>

                        <br>
                        <div class="card">
                            <div class="card-header bg-dark">
                                <h2 class="text-center text-white">ประวัติการเช่า</h2>
                            </div>
                            <div class="card-body">
                                <?php
                                //ติดต่อฐานข้อมูล mysql
                                include('../config/connectdb.php');
                                //เขียนภาษา SQL
                                $sqluser = "SELECT rental.*,crane.c_name,payment_type.pm_name,users.fullname FROM rental LEFT JOIN crane ON rental.c_id=crane.c_id LEFT JOIN payment_type ON rental.pm_id=payment_type.pm_id LEFT JOIN users ON rental.users_id=users.users_id  WHERE  users.users_id = $usersid";
                                $resultuser = mysqli_query($conn, $sqluser) or die('sql ผิด');
                                //นับจำนวนข้อมูล

                                //สร้างตาราง
                                echo "<table class='table table-success table-hover' id='table_id'>";
                                echo "<thead>";
                                echo "<tr>";
                                echo "<th>รหัสเช่า</th>";
                                echo "<th>วันที่เริ่มเช่า</th>";
                                echo "<th>ชื่อรถ</th>";
                                echo "<th>จำนวนวัน</th>";
                                echo "<th>สถานที่เช่า</th>";
                                echo "<th>วิธีชำระ</th>";
                                echo "<th>สถานะ</th>";
                                echo "</tr>";
                                echo "</thead>";
                                echo "<tfoot>";
                                echo "<tr class='align-text-center'>";
                                echo "<th>รหัสเช่า</th>";
                                echo "<th>วันที่เริ่มเช่า</th>";
                                echo "<th>ชื่อรถ</th>";
                                echo "<th>จำนวนวัน</th>";
                                echo "<th>สถานที่เช่า</th>";
                                echo "<th>วิธีชำระ</th>";
                                echo "<th>สถานะ</th>";
                                echo "</tr>";
                                echo "</tfoot>";
                                echo "<tbody>";
                                while ($rowuser = mysqli_fetch_assoc($resultuser)) {

                                    echo "<tr>";
                                    echo "<th>" . $rowuser["r_id"] . "</th>";
                                    echo "<th>" . $rowuser["r_startdate"] . "</th>";
                                    echo "<th>" . $rowuser["c_name"] . "</th>";
                                    echo "<th>" . $rowuser["r_numdate"] . "</th>";
                                    echo "<th>" . $rowuser["r_place"] . "</th>";
                                    echo "<th>" . $rowuser["pm_name"] . "</th>";
                                    echo "<th>" . $rowuser["r_role"] . "</th>";
                                    echo "</tr>";
                                }
                                echo "</tbody>";
                                echo "</table>";

                                ?>
                            </div>
                           
                        </div>
                        <br>
                        <div class="card">
                            <div class="card-header bg-dark">
                                <h2 class="text-center text-white">บิลชำระเงิน</h2>
                            </div>
                            <div class="card-body">
                                <?php
                                //ติดต่อฐานข้อมูล mysql
                                include('../config/connectdb.php');
                                //เขียนภาษา SQL

                                $sqluser = "SELECT rcpt.*,rental.*,users.*,crane.*,payment_type.*  FROM rcpt LEFT JOIN rental ON rcpt.r_id=rental.r_id LEFT JOIN crane ON rental.c_id=crane.c_id LEFT JOIN payment_type ON rental.pm_id=payment_type.pm_id LEFT JOIN users ON rental.users_id=users.users_id where users.users_id = $usersid";
                                $resultuser = mysqli_query($conn, $sqluser) or die('sql ผิด');
                                //นับจำนวนข้อมูล

                                //สร้างตาราง
                                echo "<table class='table table-success table-hover' id='table_id2'>";
                                echo "<thead>";
                                echo "<tr>";
                                echo "<th>รหัสบิล</th>";
                                echo "<th>รถ</th>";
                                echo "<th>ราคา</th>";
                                echo "<th>วันเช่า</th>";
                                echo "<th>รวม</th>";
                                echo "<th>สถานะ</th>";
                                echo "<th>รายละเอียด</th>";
                                echo "</tr>";
                                echo "</thead>";
                                echo "<tfoot>";
                                echo "<tr class='align-text-center'>";
                                echo "<th>รหัสบิล</th>";
                                echo "<th>รถ</th>";
                                echo "<th>ราคา</th>";
                                echo "<th>วันเช่า</th>";
                                echo "<th>รวม</th>";
                                echo "<th>สถานะ</th>";
                                echo "<th>รายละเอียด</th>";
                                echo "</tr>";
                                echo "</tfoot>";
                                echo "<tbody>";
                                while ($rowuser = mysqli_fetch_assoc($resultuser)) {
                                    echo "<tr>";
                                    echo "<th>" . $rowuser["rcpt_id"] . "</th>";
                                    echo "<th>" . $rowuser["c_name"] . "</th>";
                                    echo "<th>" . $rowuser["rcpt_num"] . "</th>";
                                    echo "<th>" . $rowuser["r_numdate"] . "</th>";
                                    echo "<th>" . $rowuser["rcpt_allnum"] . "</th>";
                                    echo "<th>" . $rowuser["rcpt_role"] . "</th>";
                                    echo "<th><button  class='btn btn-info' name='detailsrent' value='Edit' id='" . $rowuser["r_id"] . "'><i class='fas fa-clipboard'></i></i></button></th>";
                                    echo "</tr>";
                                }
                                echo "</tbody>";
                                echo "</table>";
                                ?>
                            </div>
                            <div class="card-footer">
                                <div class="row">
                                    <div class="col-sm">
                                        <h2 class='text-left'>รวมวันเช่า <?php echo number_format($alldaysum); ?> วัน</h2>
                                    </div>
                                    <div class="col-sm">
                                        <h2 class='text-right'>รวมทั้งสิ้น <?php echo number_format($allsum, 2); ?> บาท</h2>
                                    </div>
                                </div>
                            </div>
                        </div>



                </div>
            </div>
        </div>
        <!-- /.container-fluid -->
    </div>
    <!-- End of Main Content -->
    <!-- Footer -->
    <?php
    include("footer.php");
    ?>
    <!-- End of Footer -->
    </div>
    <!-- End of Content Wrapper -->
    </div>
    <!-- End of Page Wrapper -->
    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>
    <!-- Logout Modal-->
    <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                    <a class="btn btn-primary" href="logout.php">ออกจากระบบ</a>
                </div>
            </div>
        </div>
    </div>


    <!-- EditName Modal-->
    <div class="modal fade" id="EditName" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered " role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">แก้ไขชื่อ</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-sm-12">
                                <form method="post" id="EditorName" name="EditorName" class="form-group">
                                    <div class="form-group">
                                        <input type="text" name="fullname" id="fullname" class="form-control">
                                    </div>
                                    <input type="hidden" id="id" name="id">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <input type="submit" value="บันทึก" class="btn btn-primary" name="bsubmit" id="bsubmit">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!--End of EditName Modal-->

    <!-- EditPhone Modal-->
    <div class="modal fade" id="EditPhone" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered " role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">แก้ไขเบอร์โทรศัพท์</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-sm-12">
                                <form method="post" id="EditorPhone" name="EditorPhone" class="form-group">
                                    <div class="form-group">
                                        <input type="text" name="phonenumber" id="phonenumber" class="form-control">
                                    </div>
                                    <input type="hidden" id="id2" name="id2">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <input type="submit" value="บันทึก" class="btn btn-primary" name="bsubmit" id="bsubmit">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!--End of EditName Modal-->

<!-- detailsModal-->
<div class="modal fade" id="detailsModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg " role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="text-center modal-title" id="exampleModalLabel">รายละเอียด</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-sm-12">
                                <form method="post" id="DetailsForm" name="DetailsForm" class="form-group">
                                    <div class="form-group row">
                                        <div class="form-group col-2">
                                            <label>รหัสใบเสร็จ</label>
                                            <input type="text" name="rcpt_id_form" id="rcpt_id_form" class="form-control" readonly>
                                        </div>
                                        <div class="form-group col-5">
                                            <label>วันที่เริ่ม</label>
                                            <input type="text" name="rcpt_date_form" id="rcpt_date_form" class="form-control" readonly>
                                        </div>
                                        <div class="form-group col-5">
                                            <label>เบอร์ลูกค้า</label>
                                            <input type="text" name="phonenumber_form" id="phonenumber_form" class="form-control" readonly>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <div class="form-group col-sm">
                                            <label>ผู้เช่า</label>
                                            <input type="text" name="fullname_form" id="fullname_form" class="form-control" readonly>
                                        </div>
                                        <div class="form-group col-sm">
                                            <label>สถานะ</label>
                                            <input type="text" name="urole_form" id="urole_form" class="form-control" readonly>
                                        </div>

                                    </div>
                                    <div class="row">
                                        <div class="form-group col-sm">
                                            <label>รถ</label>
                                            <input type="text" name="c_name_form" id="c_name_form" class="form-control" readonly>
                                        </div>
                                        <div class="form-group col-sm">
                                            <label>จำนวนวัน</label>
                                            <input type="text" name="r_numdate_form" id="r_numdate_form" class="form-control" readonly>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="form-group col-sm">
                                            <label>ราคาต่อวัน</label>
                                            <input type="text" name="rcpt_num_form" id="rcpt_num_form" class="form-control" readonly>
                                        </div>
                                        <div class="form-group col-sm">
                                            <label>รวมทั้งหมด</label>
                                            <input type="text" name="rcpt_all_form" id="rcpt_all_form" class="form-control" readonly>
                                        </div>
                                    </div>


                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
    <!--End of detailsModal-->

    <?php
    include("scripter.php");
    ?>



    <script>
        $(document).ready(function() {
            $('#table_id').DataTable();
            $('#table_id2').DataTable();
        });


        //-------------คลิกปุ่มดูรายละเอียด------------\\
        $(document).on("click", "button[name='detailsrent']", function() {
            var uid = $(this).attr("id");
            $.ajax({
                url: "detailsrent_fetch.php",
                method: "post",
                data: {
                    id: uid
                },
                dataType: "json",
                success: function(data) {
                    $('#rcpt_id_form').val(data.rcpt_id);
                    $('#rcpt_date_form').val(data.rcpt_date);
                    $('#fullname_form').val(data.fullname);
                    $('#phonenumber_form').val(data.phonenumber);
                    $('#urole_form').val(data.urole);
                    $('#r_numdate_form').val(data.r_numdate);
                    $('#c_name_form').val(data.c_name);
                    $('#rcpt_num_form').val(data.rcpt_num);
                    $('#rcpt_all_form').val(data.rcpt_allnum);
                    $('#detailsModal').modal('show');
                }
            });
        });
        //-------------คลิกปุ่มดูรายละเอียด------------\\

    </script>
</body>

</html>