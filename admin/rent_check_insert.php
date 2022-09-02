<?php
session_start();
error_reporting(E_ALL ^ E_NOTICE);

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
include('../config/connectdb.php');
$CraneArr = array();
$yearMonth = "$year-$month"; ?>




<?php
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
        <div id="content-wrapper" class="d-flex flex-column bg-light">
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
                <div class="container-fluid bg-light">
                    <h1 class=" h3 mb-0 text-gray-800"><?php // echo $_SESSION['member_login']; 
                                                        ?></h1>

                    <?php $sqlc = "SELECT * FROM crane  WHERE c_id = $c_id";
                    $resultc = mysqli_query($conn, $sqlc) or die('sql ผิด');
                    while ($rowc = mysqli_fetch_assoc($resultc)) {
                        $cranename = $rowc["c_name"];
                        $cnum = $rowc["c_num"];
                    } ?>




                    <?php
                    //echo "<br/>ตำแหน่งของวันที่ $startDay คือ <strong>", $startPoint , " (ตรงกับ วัน" , $weekDay[$startPoint].")</strong>";
                    $title = "เดือน $thaiMon[$month] <strong>" . $startDay . " : " . $endDay . "</strong>";
                    $monthth = $thaiMon[$month];
                    //ลดเวลาลง 1 เดือน
                    $prevMonTime = strtotime('-1 month', $timeDate);
                    $prevMon = date('m', $prevMonTime);
                    $prevYear = date('Y', $prevMonTime);
                    //เพิ่มเวลาขึ้น 1 เดือน
                    $nextMonTime = strtotime('+1 month', $timeDate);
                    $nextMon = date('m', $nextMonTime);
                    $nextYear = date('Y', $nextMonTime);
                    $month = isset($_POST['month']) ? $_POST['month'] : date('m');
                    $year = isset($_POST['year']) ? $_POST['year'] : date('Y');
                    ?>



                    <div class="card">
                        <div class="card-header bg-dark">
                            <h2 class="text-center text-white">ตรวจสอบรายการเช่ารถ</h2>
                        </div>
                        <div class="card-body">


                            <?php

                            //ติดต่อฐานข้อมูล mysql
                            include('../config/connectdb.php');
                            //เขียนภาษา SQL

                            $sqluser = "SELECT rental.*,crane.c_name,payment_type.pm_name,users.fullname FROM rental LEFT JOIN crane ON rental.c_id=crane.c_id LEFT JOIN payment_type ON rental.pm_id=payment_type.pm_id LEFT JOIN users ON rental.users_id=users.users_id  WHERE r_role='รอการตรวจสอบ' ";
                            $resultuser = mysqli_query($conn, $sqluser) or die('sql ผิด');
                            //นับจำนวนข้อมูล

                            //สร้างตาราง
                            echo "<table class='table table-success table-hover' id='table_id'>";
                            echo "<thead>";
                            echo "<tr>";
                            echo "<th>ใบเสร็จ</th>";
                            echo "<th>รหัสคำร้อง</th>";
                            echo "<th>วันเช่า</th>";
                            echo "<th>ผู้เช่า</th>";
                            echo "<th>รถ</th>";

                            echo "<th>จำนวนวัน</th>";
                            echo "<th>สถานที่</th>";
                            echo "<th>ประเภทการชำระ</th>";

                            echo "<th>สถานะ</th>";

                            echo "<th>Edit</th>";
                            echo "<th>Delete</th>";

                            echo "</tr>";
                            echo "</thead>";
                            echo "<tfoot>";
                            echo "<tr class='align-text-center'>";
                            echo "<th>ใบเสร็จ</th>";
                            echo "<th>รหัสคำร้อง</th>";
                            echo "<th>วันเช่า</th>";
                            echo "<th>ผู้เช่า</th>";
                            echo "<th>รถ</th>";

                            echo "<th>จำนวนวัน</th>";
                            echo "<th>สถานที่</th>";
                            echo "<th>ประเภทการชำระ</th>";

                            echo "<th>สถานะ</th>";

                            echo "<th>Edit</th>";
                            echo "<th>Delete</th>";
                            echo "</tr>";
                            echo "</tfoot>";
                            echo "<tbody>";
                            while ($rowuser = mysqli_fetch_assoc($resultuser)) {

                                echo "<tr>";
                                echo "<th><button  class='btn btn-success' name='RcptButton' value='Edit' id='" . $rowuser["r_id"] . "'><i class='fas fa-print'></i></button></th>";
                                echo "<th>" . $rowuser["r_id"] . "</th>";
                                echo "<th>" . $rowuser["r_startdate"] . "</th>";
                                echo "<th>" . $rowuser["fullname"] . "</th>";
                                echo "<th>" . $rowuser["c_name"] . "</th>";


                                echo "<th>" . $rowuser["r_numdate"] . "</th>";
                                echo "<th>" . $rowuser["r_place"] . "</th>";
                                echo "<th>" . $rowuser["pm_name"] . "</th>";


                                echo "<th>" . $rowuser["r_role"] . "</th>";
                                echo "<th><button  class='btn btn-warning' name='checkrent' value='Edit' id='" . $rowuser["r_id"] . "'><i class='far fa-edit'></i></i></button></th>";
                                echo "<th><button  class='btn btn-danger' name='deleterent' value='Delete' id='" . $rowuser["r_id"] . "'><i class='far fa-trash-alt'></i></i></button></th>";


                                echo "</tr>";
                            }
                            echo "</tbody>";
                            echo "</table>";
                            mysqli_close($conn);
                            ?>
                        </div>

                    </div>
                    <div class="container-fluid">
                        <hr>
                    </div>




                    <?php

                    //ติดต่อฐานข้อมูล mysql
                    include('../config/connectdb.php');
                    //เขียนภาษา SQL

                    $sql = "SELECT crane.*,cranetype.ct_name FROM crane LEFT JOIN cranetype ON crane.ct_id=cranetype.ct_id";
                    $result = mysqli_query($conn, $sql) or die('sql ผิด'); ?>

                    <div class="row">

                        <div class="col-sm">
                            <h2 class="text-center">บันทึกการเช่ารถ <?php echo $cranename ?></h2>
                            <form action="cranerent_insert_sql.php" method="post">
                      
                                <div class="form-group row">
                                    <div class="col-sm">
                                        <label class="col-form-label" for="r_id">รหัสคำร้อง</label>
                                        <select id='r_id' name='r_id' class='form-control'>
                                            <option value=''>---เลือกรหัสคำร้อง--</option>
                                            <?php
                                            include('../config/connectdb.php');
                                            $sqlr_id = "SELECT rental.*,crane.c_name,payment_type.pm_name,users.fullname FROM rental LEFT JOIN crane ON rental.c_id=crane.c_id LEFT JOIN payment_type ON rental.pm_id=payment_type.pm_id LEFT JOIN users ON rental.users_id=users.users_id  WHERE r_role='รอการตรวจสอบ' ";
                                            $resultr_id = mysqli_query($conn, $sqlr_id) or die('sql ผิด');
                                            while ($rer_id = mysqli_fetch_array($resultr_id)) {
                                                echo "<option value='" . $rer_id["r_id"] . "'>" . $rer_id["r_id"] . "</option>";
                                            }
                                            ?>
                                        </select>
                                    </div>
                                    <div class="col-sm">
                                        <label class="col-form-label">วันที่เช่า:</label>
                                        <input type="date" class="form-control" id="cr_date" name="cr_date">
                                    </div>
                                </div>

                                <div class="col-form-group-sm">
                                    <button type="submit" name="emsubmit" class="btn btn-success btn-block">บันทึก</button>
                                </div>



                                <br>




                            </form>
                            <div class=" align-items-center justify-content-center mb-4">

                                <div class="card">
                                    <div class="card-header bg-dark text-light">

                                        <h2 class="text-center text-light"> <?php echo " เดือน" . $monthth;  ?></h2>

                                    </div>
                                    <div class="card-body bg-secondary ">
                                        <table class="table table-bordered bg-white ">
                                            <thead class="h5">
                                                <tr>
                                                    <th>อาทิตย์</th>
                                                    <th>จันทร์</th>
                                                    <th>อังคาร</th>
                                                    <th>พุธ</th>
                                                    <th>พฤหัส</th>
                                                    <th>ศุกร์</th>
                                                    <th>เสาร์</th>
                                                </tr>
                                            </thead>
                                            <tbody class="h5">
                                                <tr>
                                                    <?php
                                                    $col = $startPoint;          //ให้นับลำดับคอลัมน์จาก ตำแหน่งของ วันในสับดาห์ 
                                                    if ($startPoint < 7) {         //ถ้าวันอาทิตย์จะเป็น 7
                                                        echo str_repeat("<td> </td>", $startPoint); //สร้างคอลัมน์เปล่า กรณี วันแรกของเดือนไม่ใช่วันอาทิตย์
                                                    }
                                                    for ($i = 1; $i <= $lastDay; $i++) { //วนลูป ตั้งแต่วันที่ 1 ถึงวันสุดท้ายของเดือน
                                                        $col++;       //นับจำนวนคอลัมน์ เพื่อนำไปเช็กว่าครบ 7 คอลัมน์รึยัง
                                                        $numcrane = isset($CraneArr[$i]) ? $CraneArr[$i] : 0;
                                                        $tdStyle = "";
                                                        if ($numcrane == 1) {
                                                            $tdStyle = "crane_status2";
                                                        } else {
                                                            $tdStyle = "crane_status1";
                                                        }
                                                        echo "<td class='$tdStyle' text-warning> $i </td>";   //สร้างคอลัมน์ แสดงวันที่ 
                                                        if ($col % 7 == false) {   //ถ้าครบ 7 คอลัมน์ให้ขึ้นบรรทัดใหม่
                                                            echo "</tr><tr>";   //ปิดแถวเดิม และขึ้นแถวใหม่
                                                            $col = 0;     //เริ่มตัวนับคอลัมน์ใหม่
                                                        }
                                                    }
                                                    if ($col < 7) {         // ถ้ายังไม่ครบ7 วัน
                                                        echo str_repeat("<td> </td>", 7 - $col); //สร้างคอลัมน์ให้ครบตามจำนวนที่ขาด
                                                    }
                                                    ?>
                                                </tr>
                                            </tbody>
                                        </table>

                                    </div>

                                    <div class="card-footer bg-dark ">



                                        <button type="button" class="btn btn-primary navLeft" <?php echo 'onclick="goTo(\'' . $prevMon . '\', \'' . $prevYear . '\');"'  ?>><?php echo '<<' ?> เดือนที่แล้ว</button>
                                        <button type="button" class="btn btn-primary navRight" <?php echo 'onclick="goTo(\'' . $nextMon . '\', \'' . $nextYear . '\');"'  ?>> เดือนต่อไป<?php echo '>>' ?></button>

                                        <h6 class="text-center text-light"><?php echo $cranename ?></h6>
                                        <h6 class="text-center text-light">( &#128154; = ว่าง , &#128308; = เต็ม )</h6>





                                    </div>
                                </div>

                            </div>



                        </div>
                        <div class="col-sm">
                            <?php //สร้างตาราง
                            echo "<table class='table table-success table-hover' id='table_id2'>";
                            echo "<thead>";
                            echo "<tr>";
                            echo "<th>รูปภาพ</th>";
                            echo "<th>ชื่อรถ</th>";
                            echo "<th>ตรวจสอบ</th>";
                            echo "</tr>";
                            echo "</thead>";
                            echo "<tfoot>";
                            echo "<tr class='align-text-center'>";
                            echo "<th>รูปภาพ</th>";
                            echo "<th>ชื่อรถ</th>";
                            echo "<th>ตรวจสอบ</th>";
                            echo "</tr>";
                            echo "</tfoot>";
                            echo "<tbody>";
                            while ($row = mysqli_fetch_assoc($result)) {
                                echo "<tr>";
                                echo "<th>" . "<img class='rounded' width='250px' src='../uploads/" . $row["c_img"] . "' >" . "</th>";
                                echo "<th>" . $row["c_name"] . "</th>";
                                echo "<th><a href ='rent_check_insert.php?c_id=" . $row["c_id"] . "'><button style='font-size:20px' class='btn btn-info' name='edit'  id='" . $row["c_id"] . "'>เช็ควัน</button></a></th>";
                                echo "</tr>";
                            }
                            echo "</tbody>";
                            echo "</table>";
                            mysqli_close($conn);
                            ?>
                        </div>
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
                    <a class="btn btn-primary" href="../index.php">Logout</a>
                </div>
            </div>
        </div>
    </div>



    <!-- RentalModal-->
    <div class="modal fade" id="RentalModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered " role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">ตรวจสอบข้อมูลการเช่า</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-sm-12">
                                <form method="post" id="RentalCheck" name="RentalCheck" class="form-group">
                                    <div class="form-group">
                                        <label>รหัสคำร้องเช่า</label>
                                        <input type="text" name="r_idx" id="r_idx" class="form-control" readonly>
                                    </div>
                                    <div class="form-group row">
                                        <div class="form-group col-sm">
                                            <label>ชื่อสมาชิก</label>
                                            <input type="text" name="fullname" id="fullname" class="form-control" readonly>
                                        </div>
                                        <div class="form-group col-sm">
                                            <label>ชื่อรถ</label>
                                            <input type="text" name="c_name" id="c_name" class="form-control" readonly>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="form-group col-sm">
                                            <label>จำนวนวัน</label>
                                            <input type="number" min="1" name="r_numdate" id="r_numdate" class="form-control">
                                        </div>

                                        <div class="form-group col-sm">
                                            <label>สถานที่</label>
                                            <input type="text" name="r_place" id="r_place" class="form-control">
                                        </div>
                                    </div>


                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-outline-secondary" type="button" data-dismiss="modal">Cancel</button>
                    <input type="submit" value="บันทึก" class="btn btn-primary " name="bsubmit" id="bsubmit">
                    </form>

                </div>
            </div>
        </div>
    </div>
    <!--End of RentalModal-->


    <!-- DelRentalModal-->
    <div class="modal fade" id="DelRentalModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered " role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">ตรวจสอบข้อมูลการเช่า</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-sm-12">
                                <form method="post" id="DelRentalCheck" name="DelRentalCheck" class="form-group">
                                    <div class="form-group">
                                        <label>รหัสคำร้องเช่า</label>
                                        <input type="text" name="r_id_del" id="r_id_del" class="form-control" readonly>
                                    </div>
                                    <div class="form-group row">
                                        <div class="form-group col-sm">
                                            <label>ชื่อสมาชิก</label>
                                            <input type="text" name="fullname_del" id="fullname_del" class="form-control" readonly>
                                        </div>
                                        <div class="form-group col-sm">
                                            <label>ชื่อรถ</label>
                                            <input type="text" name="c_name_del" id="c_name_del" class="form-control" readonly>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="form-group col-sm">
                                            <label>จำนวนวัน</label>
                                            <input type="text" name="r_numdate_del" id="r_numdate_del" class="form-control" readonly>
                                        </div>
                                        <div class="form-group col-sm">
                                            <label>สถานที่</label>
                                            <input type="text" name="r_place_del" id="r_place_del" class="form-control" readonly>
                                        </div>
                                    </div>


                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-outline-secondary" type="button" data-dismiss="modal">Cancel</button>
                    <input type="submit" value="บันทึก" class="btn btn-primary " name="bsubmit" id="bsubmit">
                    </form>

                </div>
            </div>
        </div>
    </div>
    <!--End of DelRentalModal-->


    <!-- RcptModal-->
    <div class="modal fade" id="RcptModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered " role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">ออกใบเสร็จให้ลูกค้า</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-sm-12">
                                <form method="post" id="Rcpt" name="Rcpt" class="form-group">
                                    <input type="hidden" id="r_id_Rcpt" name="r_id_Rcpt">
                                    <div class="form-group row">
                                        <div class="form-group col-sm">
                                            <label>ชื่อสมาชิก</label>
                                            <input type="text" name="fullname_Rcpt" id="fullname_Rcpt" class="form-control" readonly>
                                        </div>
                                        <div class="form-group col-sm">
                                            <label>สถานะ</label>
                                            <input type="text" name="urole_Rcpt" id="urole_Rcpt" class="form-control" readonly>
                                        </div>

                                    </div>

                                    <div class="form-group row">

                                        <div class="form-group col-sm">
                                            <label>ชื่อรถ</label>
                                            <input type="text" name="c_name_Rcpt" id="c_name_Rcpt" class="form-control" readonly>
                                        </div>
                                        <div class="form-group col-sm">
                                            <label>สถานที่</label>
                                            <input type="text" name="r_place_Rcpt" id="r_place_Rcpt" class="form-control" readonly>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="form-group col-sm">
                                            <label>ราคา</label>
                                            <input type="text" name="c_num_Rcpt" id="c_num_Rcpt" class="form-control" readonly>
                                        </div>
                                        <div class="form-group col-sm">
                                            <label>จำนวนวัน</label>
                                            <input type="number" min="1" name="r_numdate_Rcpt" id="r_numdate_Rcpt" class="form-control" readonly>
                                        </div>

                                        <div class="form-group col-sm">
                                            <label>รวมทั้งสิ้น</label>
                                            <input type="text" name="allnum_Rcpt" id="allnum_Rcpt" class="form-control" readonly>
                                        </div>
                                    </div>


                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-outline-secondary" type="button" data-dismiss="modal">Cancel</button>
                    <input type="submit" value="บันทึก" class="btn btn-primary " name="bsubmit" id="bsubmit">
                    </form>

                </div>
            </div>
        </div>
    </div>
    <!--End of RcptModal-->


    <?php
    include("scripter.php");
    ?>
    <script>
        $(document).ready(function() {
            $('#table_id').DataTable();
            $('#table_id2').DataTable();
        });






        //-------------คลิกปุ่มแก้ไขสถานะUser------------\\
        $(document).on("click", "button[name='checkrent']", function() {
            var uid = $(this).attr("id");
            $.ajax({
                url: "rental_fetch_edit.php",
                method: "post",
                data: {
                    id: uid
                },
                dataType: "json",
                success: function(data) {
                    $('#r_idx').val(data.r_id);
                    $('#fullname').val(data.fullname);
                    $('#c_name').val(data.c_name);
                    $('#r_numdate').val(data.r_numdate);
                    $('#r_place').val(data.r_place);

                    $('#RentalModal').modal('show');
                }
            });
        });
        //-------------คลิกปุ่มแก้ไขสถานะUser------------\\


        //-------------คลิกปุ่มแก้ไขในฟอร์มแก้ไข------------\\

        $('#RentalCheck').on('submit', function(e) {
            var form = $('#RentalCheck')[0];
            var formData = new FormData(form);
            e.preventDefault();
            $.ajax({
                url: "rental_update_sql.php",
                type: "POST",
                processData: false,
                contentType: false,
                data: formData,
                beforeSend: function() {},
                success: function(data) {
                    alert(data);
                    $('#RentalCheck')[0].reset();
                    $('#RentalModal').modal('hide');
                    location.reload();
                }
            });
        });
        //-------------คลิกปุ่มแก้ไขในฟอร์มแก้ไข------------\\		












        //-------------คลิกปุ่มแก้ไขสถานะUser------------\\
        $(document).on("click", "button[name='RcptButton']", function() {
            var uid = $(this).attr("id");
            $.ajax({
                url: "rcpt_fetch_edit.php",
                method: "post",
                data: {
                    id: uid
                },
                dataType: "json",
                success: function(data) {

                    $('#r_id_Rcpt').val(data.r_id);
                    $('#r_place_Rcpt').val(data.r_place);
                    $('#fullname_Rcpt').val(data.fullname);
                    $('#c_name_Rcpt').val(data.c_name);
                    $('#urole_Rcpt').val(data.urole);

                    $('#c_num_Rcpt').val(data.c_num);
                    $('#r_numdate_Rcpt').val(data.r_numdate);
                    $('#allnum_Rcpt').val(data.allnum);

                    $('#RcptModal').modal('show');
                }
            });
        });
        //-------------คลิกปุ่มแก้ไขสถานะUser------------\\




        //-------------คลิกปุ่มแก้ไขในฟอร์มแก้ไข------------\\

        $('#Rcpt').on('submit', function(e) {
            var form = $('#Rcpt')[0];
            var formData = new FormData(form);
            e.preventDefault();
            $.ajax({
                url: "rcpt_insert_sql.php",
                type: "POST",
                processData: false,
                contentType: false,
                data: formData,
                beforeSend: function() {},
                success: function(data) {
                    alert(data);
                    $('#Rcpt')[0].reset();
                    $('#RcptModal').modal('hide');
                    location.reload();
                }
            });
        });
        //-------------คลิกปุ่มแก้ไขในฟอร์มแก้ไข------------\\		





        //-------------คลิกปุ่มลบข้อมูลที่รายการ------------\\

        $(document).on("click", "button[name='deleterent']", function() {
            var uid = $(this).attr("id");
            $.ajax({
                url: "rental_fetch_edit.php",
                method: "post",
                data: {
                    id: uid
                },
                dataType: "json",
                success: function(data) {
                    $('#r_id_del').val(data.r_id);
                    $('#fullname_del').val(data.fullname);
                    $('#c_name_del').val(data.c_name);
                    $('#r_numdate_del').val(data.r_numdate);
                    $('#r_place_del').val(data.r_place);

                    $('#DelRentalModal').modal('show');
                }
            });
        });
        //-------------คลิกปุ่มลบข้อมูลที่รายการ------------\\


        //-------------คลิกปุ่มลบในฟอร์มลบ------------\\
        $('#DelRentalCheck').on('submit', function(e) {
            var form = $('#DelRentalCheck')[0];
            var formData = new FormData(form);
            e.preventDefault();
            $.ajax({
                url: "rental_del_sql.php",
                type: "POST",
                processData: false,
                contentType: false,
                data: formData,
                beforeSend: function() {},
                success: function(data) {
                    alert(data);
                    $('#DelRentalCheck')[0].reset();
                    $('#DelRentalModal').modal('hide');
                    location.reload();
                }
            });
        });
        //-------------คลิกปุ่มลบในฟอร์มลบ------------\\
    </script>






    </script>



</body>

</html>