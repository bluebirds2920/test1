<?php
session_start();
$id = $_SESSION['admin_login'];
$_SESSION["c_id"] = '1';
if (isset($_GET["c_id"])) {
    $_SESSION["c_id"] = $_GET["c_id"];
}
$c_id = $_SESSION["c_id"];
$weekDay = array('อาทิตย์', 'จันทร์', 'อังคาร', 'พุธ', 'พฤหัสฯ', 'ศุกร์', 'เสาร์');
$thaiMon = array(
    "01" => "มกราคม", "02" => "กุมภาพันธ์", "03" => "มีนาคม", "04" => "เมษายน",
    "05" => "พฤษภาคม", "06" => "มิถุนายน", "07" => "กรกฎาคม", "08" => "สิงหาคม",
    "09" => "กันยายน", "10" => "ตุลาคม", "11" => "พฤศจิกายน", "12" => "ธันวาคม"
);
$month = isset($_GET['month']) ? $_GET['month'] : date('m'); //ถ้าส่งค่าเดือนมาใช้ค่าที่ส่งมา ถ้าไม่ส่งมาด้วย ใช้เดือนปัจจุบัน
$year = isset($_GET['year']) ? $_GET['year'] : date('Y'); //ถ้าส่งค่าปีมาใช้ค่าที่ส่งมา ถ้าไม่ส่งมาด้วย ใช้ปีปัจจุบัน
$startDay = "01-" . $month . '-' . $year;   //วันที่เริ่มต้นของเดือน
$timeDate = strtotime($startDay);   //เปลี่ยนวันที่เป็น timestamp
$lastDay = date("t", $timeDate);   //จำนวนวันของเดือน
$endDay = $lastDay . '-' . $month . "-" . $year;  //วันที่สุดท้ายของเดือน
$startPoint = date('w', $timeDate);   //จุดเริ่มต้น วันในสัปดาห์

//เชื่อมต่อฐานข้อมูลวันในปฏิทิน
include('../config/connectdb.php');
$CraneArr = array();
$yearMonth = "$year-$month";
$sql = "SELECT DAY( cranerent.cr_date ) AS crane_day, COUNT( * ) AS qty FROM cranerent LEFT JOIN rental ON cranerent.r_id=rental.r_id 
WHERE DATE_FORMAT( cranerent.cr_date , '%Y-%m' ) = '$yearMonth' and rental.c_id = $c_id GROUP BY DAY( cr_date );";
$qry = mysqli_query($conn, $sql) or die('sql ผิด');
while ($row = mysqli_fetch_assoc($qry)) {
    $CraneArr[$row['crane_day']] = $row['qty'];
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
        <div id="content-wrapper" class="d-flex flex-column bg-success">
            <!-- Main Content -->
            <div id="content">
                <!-- Topbar -->
                <?php
                include("topbar.php");
                //ติดต่อฐานข้อมูล mysql
                include('../config/connectdb.php');
                ?>
                <!-- End of Topbar -->
                <!-- Begin Page Content -->
                <div class="container-fluid bg-success">
                    <h1 class=" h3 mb-0 text-gray-800"><?php // echo $_SESSION['member_login']; 
                                                        ?></h1>

                    <?php
                    $sqlc = "SELECT * FROM crane  WHERE c_id = $c_id";
                    $resultc = mysqli_query($conn, $sqlc) or die('sql ผิด');
                    while ($rowc = mysqli_fetch_assoc($resultc)) {
                        $cranename = $rowc["c_name"];
                        $cnum = $rowc["c_num"];
                    }

                    $sqlsum = "SELECT SUM(rcpt_allnum) as allsumrcpt FROM rcpt  WHERE rcpt_role = 'ค้างชำระ' ";
                    $resultsum = mysqli_query($conn, $sqlsum) or die('sql ผิด');
                    while ($rowsum = mysqli_fetch_assoc($resultsum)) {

                        $allsum = $rowsum["allsumrcpt"];
                    }

                    $sqlsumfinish = "SELECT SUM(rcpt_allnum) as allsumrcpt2 FROM rcpt  WHERE rcpt_role = 'ชำระสำเร็จ' ";
                    $resultsumfinish = mysqli_query($conn, $sqlsumfinish) or die('sql ผิด');
                    while ($rowsumfinish = mysqli_fetch_assoc($resultsumfinish)) {

                        $allsum2 = $rowsumfinish["allsumrcpt2"];
                    }




                    ?>


                    <div class="card">
                        <div class="card-header bg-dark">
                            <h2 class="text-center text-white">งานวันนี้</h2>
                        </div>
                        <div class="card-body">


                            <?php

                            //ติดต่อฐานข้อมูล mysql
                            include('../config/connectdb.php');
                            //เขียนภาษา SQL
                         
 
                            $datetoday = date("Y-m-d");
                            $sqlcranerent = "SELECT cranerent.*,rental.*,crane.*,users.*  FROM cranerent LEFT JOIN rental ON cranerent.r_id=rental.r_id LEFT JOIN crane ON rental.c_id=crane.c_id LEFT JOIN users ON rental.users_id=users.users_id  WHERE cranerent.cr_date = '$datetoday' ";
                            $resultcranerent = mysqli_query($conn, $sqlcranerent) or die('sql ผิด');
                            //นับจำนวนข้อมูล

                            //สร้างตาราง
                            echo "<table class='table table-success table-hover' id='table_idcranerent'>";
                            echo "<thead>";
                            echo "<tr>";
                           
                            echo "<th>รถ</th>";
                            echo "<th>สถานที่</th>";
                            echo "<th>ลูกค้า</th>";
                            echo "<th>เบอร์ลูกค้า</th>";
                            echo "</tr>";
                            echo "</thead>";
                            echo "<tfoot>";
                            echo "<tr class='align-text-center'>";
                           
                            echo "<th>รถ</th>";
                            echo "<th>สถานที่</th>";
                            echo "<th>ลูกค้า</th>";
                            echo "<th>เบอร์ลูกค้า</th>";
                            echo "</tr>";
                            echo "</tfoot>";
                            echo "<tbody>";
                            while ($rowcranerent = mysqli_fetch_assoc($resultcranerent)) {

                                echo "<tr>";
                                echo "<th>" . $rowcranerent["c_name"] . "</th>";
                                echo "<th>" . $rowcranerent["r_place"] . "</th>";
                                echo "<th>" . $rowcranerent["fullname"] . "</th>";
                                echo "<th>" . $rowcranerent["phonenumber"] . "</th>";
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
                            <h2 class="text-center text-white">งานทั้งหมด</h2>
                        </div>
                        <div class="card-body">


                            <?php

                            //ติดต่อฐานข้อมูล mysql
                            include('../config/connectdb.php');
                            //เขียนภาษา SQL
                         
 
                       
                            $sqlcranerent2 = "SELECT cranerent.*,rental.*,crane.*,users.*  FROM cranerent LEFT JOIN rental ON cranerent.r_id=rental.r_id LEFT JOIN crane ON rental.c_id=crane.c_id LEFT JOIN users ON rental.users_id=users.users_id WHERE cranerent.cr_date != '$datetoday'   ";
                            $resultcranerent2 = mysqli_query($conn, $sqlcranerent2) or die('sql ผิด');
                            //นับจำนวนข้อมูล

                            //สร้างตาราง
                            echo "<table class='table table-success table-hover' id='table_idcranerent2'>";
                            echo "<thead>";
                            echo "<tr>";
                            
                            echo "<th>วันที่</th>";
                            echo "<th>รถ</th>";
                            echo "<th>ผู้เช่า</th>";
                            echo "<th>สถานที่</th>";
                           
                            echo "</tr>";
                            echo "</thead>";
                            echo "<tfoot>";
                            echo "<tr class='align-text-center'>";
                            
                            echo "<th>วันที่</th>";
                            echo "<th>รถ</th>";
                            echo "<th>ผู้เช่า</th>";
                            echo "<th>สถานที่</th>";
                       
                            echo "</tr>";
                            echo "</tfoot>";
                            echo "<tbody>";
                            while ($rowcranerent2 = mysqli_fetch_assoc($resultcranerent2)) {

                                echo "<tr>";
                              
                                echo "<th>" . $rowcranerent2["cr_date"] . "</th>";
                                echo "<th>" . $rowcranerent2["c_name"] . "</th>";
                                echo "<th>" . $rowcranerent2["fullname"] . "</th>";
                                echo "<th>" . $rowcranerent2["r_place"] . "</th>";
                               
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
                            <h2 class="text-center text-white">บิลค้างชำระ</h2>
                        </div>
                        <div class="card-body">


                            <?php

                            //ติดต่อฐานข้อมูล mysql
                            include('../config/connectdb.php');
                            //เขียนภาษา SQL

                            $sqluser = "SELECT rcpt.*,rental.*,users.*,crane.*,payment_type.*  FROM rcpt LEFT JOIN rental ON rcpt.r_id=rental.r_id LEFT JOIN crane ON rental.c_id=crane.c_id LEFT JOIN payment_type ON rental.pm_id=payment_type.pm_id LEFT JOIN users ON rental.users_id=users.users_id WHERE rcpt.rcpt_role = 'ค้างชำระ' ";
                            $resultuser = mysqli_query($conn, $sqluser) or die('sql ผิด');
                            //นับจำนวนข้อมูล

                            //สร้างตาราง
                            echo "<table class='table table-success table-hover' id='table_id'>";
                            echo "<thead>";
                            echo "<tr>";
                            echo "<th>ยืนยัน</th>";
                            echo "<th>รหัสใบเสร็จ</th>";
                            echo "<th>ผู้เช่า</th>";
                            echo "<th>รถ</th>";
                            echo "<th>ราคา / วัน</th>";
                            echo "<th>วันเช่า</th>";
                            echo "<th>รวมทั้งหมด</th>";
                            echo "<th>รายละเอียด</th>";
                            echo "</tr>";
                            echo "</thead>";
                            echo "<tfoot>";
                            echo "<tr class='align-text-center'>";
                            echo "<th>ยืนยัน</th>";
                            echo "<th>รหัสใบเสร็จ</th>";
                            echo "<th>ผู้เช่า</th>";
                            echo "<th>รถ</th>";
                            echo "<th>ราคา / วัน</th>";
                            echo "<th>วันเช่า</th>";
                            echo "<th>รวมทั้งหมด</th>";
                            echo "<th>รายละเอียด</th>";
                            echo "</tr>";
                            echo "</tfoot>";
                            echo "<tbody>";
                            while ($rowuser = mysqli_fetch_assoc($resultuser)) {

                                echo "<tr>";
                                echo "<th><button  class='btn btn-success' name='RcptButton' value='Edit' id='" . $rowuser["r_id"] . "'><i class='fas fa-vote-yea'></i></button></th>";
                                echo "<th>" . $rowuser["rcpt_id"] . "</th>";
                                echo "<th>" . $rowuser["fullname"] . "</th>";
                                echo "<th>" . $rowuser["c_name"] . "</th>";
                                echo "<th>" . $rowuser["rcpt_num"] . "</th>";
                                echo "<th>" . $rowuser["r_numdate"] . "</th>";
                                echo "<th>" . $rowuser["rcpt_allnum"] . "</th>";
                                echo "<th><button  class='btn btn-outline-info' name='detailsrent' value='Edit' id='" . $rowuser["r_id"] . "'><i class='fas fa-clipboard'></i></i></button></th>";



                                echo "</tr>";
                            }
                            echo "</tbody>";
                            echo "</table>";

                            ?>
                        </div>
                        <div class="card-footer">
                            <h2 class='text-right'>รวมยอดค้างชำระ <?php echo number_format($allsum, 2); ?> บาท</h2>
                        </div>

                    </div>
                    <br>


                    <div class="card">
                        <div class="card-header bg-dark">
                            <h2 class="text-center text-white">รายรับบริษัท</h2>
                        </div>
                        <div class="card-body">


                            <?php

                            //ติดต่อฐานข้อมูล mysql
                            include('../config/connectdb.php');
                            //เขียนภาษา SQL

                            $sqlrcptfinish = "SELECT rcpt.*,rental.*,users.*,crane.*,payment_type.*  FROM rcpt LEFT JOIN rental ON rcpt.r_id=rental.r_id LEFT JOIN crane ON rental.c_id=crane.c_id LEFT JOIN payment_type ON rental.pm_id=payment_type.pm_id LEFT JOIN users ON rental.users_id=users.users_id WHERE rcpt.rcpt_role = 'ชำระสำเร็จ' ";
                            $resultrcptfinish = mysqli_query($conn, $sqlrcptfinish) or die('sql ผิด');
                            //นับจำนวนข้อมูล

                            //สร้างตาราง
                            echo "<table class='table table-success table-hover' id='table_id2'>";
                            echo "<thead>";
                            echo "<tr>";
                            echo "<th>พิมพ์</th>";
                            echo "<th>รหัสใบเสร็จ</th>";
                            echo "<th>ผู้เช่า</th>";
                            echo "<th>รถ</th>";
                            echo "<th>ราคา / วัน</th>";
                            echo "<th>วันเช่า</th>";
                            echo "<th>รวมทั้งหมด</th>";
                            echo "<th>รายละเอียด</th>";
                            echo "</tr>";
                            echo "</thead>";
                            echo "<tfoot>";
                            echo "<tr class='align-text-center'>";
                            echo "<th>พิมพ์</th>";
                            echo "<th>รหัสใบเสร็จ</th>";
                            echo "<th>ผู้เช่า</th>";
                            echo "<th>รถ</th>";
                            echo "<th>ราคา / วัน</th>";
                            echo "<th>วันเช่า</th>";
                            echo "<th>รวมทั้งหมด</th>";
                            echo "<th>รายละเอียด</th>";
                            echo "</tr>";
                            echo "</tfoot>";
                            echo "<tbody>";
                            while ($rowrcptfinish = mysqli_fetch_assoc($resultrcptfinish)) {

                                echo "<tr>"; ?>

                                <form action="report_rcpt.php" method="post">

                                    <input type="hidden" name="rcpt_idfinish" id="rcpt_idfinish" value="<?php echo $rowrcptfinish["rcpt_id"]; ?>">
                                    <?php
                                    echo "<th><button  class='btn btn-success' type='submit' name='RcptButton2' value='Edit' id='" . $rowrcptfinish["rcpt_id"] . "'><i class='fas fa-print'></i></button></th>";
                                    ?>

                                </form>

                            <?php
                                echo "<th>" . $rowrcptfinish["rcpt_id"] . "</th>";
                                echo "<th>" . $rowrcptfinish["fullname"] . "</th>";
                                echo "<th>" . $rowrcptfinish["c_name"] . "</th>";
                                echo "<th>" . $rowrcptfinish["rcpt_num"] . "</th>";
                                echo "<th>" . $rowrcptfinish["r_numdate"] . "</th>";
                                echo "<th>" . $rowrcptfinish["rcpt_allnum"] . "</th>";
                                echo "<th><button  class='btn btn-info' name='detailsrent' value='Edit' id='" . $rowrcptfinish["r_id"] . "'><i class='fas fa-clipboard'></i></i></button></th>";



                                echo "</tr>";
                            }
                            echo "</tbody>";
                            echo "</table>";

                            ?>
                        </div>
                        <div class="card-footer">
                            <h2 class='text-right'>รวมรายรับ <?php echo number_format($allsum2, 2); ?> บาท</h2>
                        </div>

                    </div>
                    <br>


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
                    <a class="btn btn-primary" href="logout.php">Logout</a>
                </div>
            </div>
        </div>
    </div>

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
                                </form>

                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
    <!--End of detailsModal-->

    <!-- detailsModal-->
    <div class="modal fade" id="confirmModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg " role="document">
            <div class="modal-content text-center">
                <div class="modal-header ">
                    <h5 class="text-center  modal-title">ยืนยันการชำระเงิน</h5>

                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-sm-12">
                                <form method="post" id="Confirmform" name="Confirmform" class="form-group">
                                    <div class="form-group row">
                                        <div class="form-group col-2">
                                            <label>รหัสใบเสร็จ</label>
                                            <input type="text" name="rcpt_id_form2" id="rcpt_id_form2" class="form-control" readonly>
                                        </div>
                                        <div class="form-group col-5">
                                            <label>วันที่เริ่ม</label>
                                            <input type="text" name="rcpt_date_form2" id="rcpt_date_form2" class="form-control" readonly>
                                        </div>
                                        <div class="form-group col-5">
                                            <label>เบอร์ลูกค้า</label>
                                            <input type="text" name="phonenumber_form2" id="phonenumber_form2" class="form-control" readonly>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <div class="form-group col-sm">
                                            <label>ผู้เช่า</label>
                                            <input type="text" name="fullname_form2" id="fullname_form2" class="form-control" readonly>
                                        </div>
                                        <div class="form-group col-sm">
                                            <label>สถานะ</label>
                                            <input type="text" name="urole_form2" id="urole_form2" class="form-control" readonly>
                                        </div>

                                    </div>
                                    <div class="row">
                                        <div class="form-group col-sm">
                                            <label>รถ</label>
                                            <input type="text" name="c_name_form2" id="c_name_form2" class="form-control" readonly>
                                        </div>
                                        <div class="form-group col-sm">
                                            <label>จำนวนวัน</label>
                                            <input type="text" name="r_numdate_form2" id="r_numdate_form2" class="form-control" readonly>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="form-group col-sm">
                                            <label>ราคาต่อวัน</label>
                                            <input type="text" name="rcpt_num_form2" id="rcpt_num_form2" class="form-control" readonly>
                                        </div>
                                        <div class="form-group col-sm">
                                            <label>รวมทั้งหมด</label>
                                            <input type="text" name="rcpt_all_form2" id="rcpt_all_form2" class="form-control" readonly>
                                        </div>
                                    </div>


                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-outline-secondary" type="button" data-dismiss="modal">Cancel</button>
                    <input type="submit" value="ยืนยัน" class="btn btn-success " name="submit" id="submit">
                    </form>

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
            $('#table_idcranerent').DataTable();
            $('#table_idcranerent2').DataTable();
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





        //-------------คลิกปุ่มยืนยันการชำระเงิน------------\\
        $(document).on("click", "button[name='RcptButton']", function() {
            var uid = $(this).attr("id");
            $.ajax({
                url: "detailsrent_fetch.php",
                method: "post",
                data: {
                    id: uid
                },
                dataType: "json",
                success: function(data) {
                    $('#rcpt_id_form2').val(data.rcpt_id);
                    $('#rcpt_date_form2').val(data.rcpt_date);
                    $('#fullname_form2').val(data.fullname);
                    $('#phonenumber_form2').val(data.phonenumber);
                    $('#urole_form2').val(data.urole);
                    $('#r_numdate_form2').val(data.r_numdate);
                    $('#c_name_form2').val(data.c_name);
                    $('#rcpt_num_form2').val(data.rcpt_num);
                    $('#rcpt_all_form2').val(data.rcpt_allnum);
                    $('#confirmModal').modal('show');
                }
            });
        });
        //-------------คลิกปุ่มยืนยันการชำระเงิน------------\\


        //-------------คลิกปุ่มยืนยันในฟอร์มการชำระเงิน------------\\

        $('#Confirmform').on('submit', function(e) {
            var form = $('#Confirmform')[0];
            var formData = new FormData(form);
            e.preventDefault();
            $.ajax({
                url: "rcpt_update_sql.php",
                type: "POST",
                processData: false,
                contentType: false,
                data: formData,
                beforeSend: function() {},
                success: function(data) {
                    alert(data);
                    $('#Confirmform')[0].reset();
                    $('#confirmModal').modal('hide');
                    location.reload();
                }
            });
        });
        //-------------คลิกปุ่มยืนยันในฟอร์มการชำระเงิน------------\\	
    </script>


</body>

</html>