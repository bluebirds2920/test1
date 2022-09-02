<?php
session_start();
$id = $_SESSION['member_login'];
$urole = $_SESSION['urole'];

if (isset($_POST['rent'])) {
    $_SESSION["c_id"] =  $_POST["c_id"];
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
$yearMonth = "$year-$month";
$sql = "SELECT DAY( cranerent.cr_date ) AS crane_day, COUNT( * ) AS qty FROM cranerent LEFT JOIN rental ON cranerent.r_id=rental.r_id 
WHERE DATE_FORMAT( cranerent.cr_date , '%Y-%m' ) = '$yearMonth' and rental.c_id = $c_id GROUP BY DAY( cr_date );";
$qry = mysqli_query($conn, $sql) or die('sql ผิด');
while ($row = mysqli_fetch_assoc($qry)) {
    $CraneArr[$row['crane_day']] = $row['qty'];
}

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

                    <?php $sqlc = "SELECT * FROM crane  WHERE c_id = $c_id";
                    $resultc = mysqli_query($conn, $sqlc) or die('sql ผิด');
                    while ($rowc = mysqli_fetch_assoc($resultc)) {
                        $cranename = $rowc["c_name"];
                        $cnum = $rowc["c_num"];
                    } ?>




                    <div class="d-sm-flex align-items-center justify-content-center mb-4">
                        <h1 class="h2 mb-0 text-gray-800"><?php echo $cranename; ?>

                            <?php if ($urole == "VIP") { ?>


                                <span class="text-warning">
                                    <?php echo  "( " . $urole . " )"; ?> </span> <?php       } ?>
                        </h1>
                    </div>

                    <div class=" align-items-center justify-content-center mb-4">

                        <div class="card">
                            <div class="card-header bg-dark text-light">

                                <h2 class="text-center text-light">
                                    <?php
                                    if ($urole == 'VIP') {
                                        $newcnum = $cnum * (100 - 15) / 100;
                                        echo "จากราคาเต็ม " . $cnum . " เหลือ " . $newcnum . " บาท / วัน";
                                    } else {
                                        echo $cnum . " บาท / วัน ";
                                    }
                                    ?>
                                </h2>
                                <form action="rentcall_insert_sql.php" method="post">

                                    <div class="form-group text-center  justify-content-center">
                                        <div class="form-group row">
                                            <div class="col-sm">
                                                <label>วัน:
                                                    <input type="date" class="form-control" id="r_startdate" name="r_startdate"></label>
                                            </div>
                                            <div class="col-sm">
                                                <label>จำนวน:
                                                    <input type="number" min="1" class="form-control" id="r_numdate" name="r_numdate" placeholder="จำนวนวันที่เช่า"></label>
                                            </div>
                                            <div class="col-sm">
                                                <label>สถานที่ :
                                                    <input type="text" class="form-control" id="r_place" name="r_place"></label>
                                            </div>
                                           
                                            <div class="col-sm">
                                                <label for="pm_id">ประเภทการชำระเงิน
                                                    <select id='pm_id' name='pm_id' class='form-control'>
                                                        <option value=''>---เลือกประเภท---</option>


                                                        <?php

                                                        $sqlpmt = "SELECT * FROM payment_type ";
                                                        $resultpmt = mysqli_query($conn, $sqlpmt) or die('sql ผิด');
                                                        while ($repmt = mysqli_fetch_array($resultpmt)) {
                                                            $pm_id[] = $repmt["pm_id"];
                                                            $pm_name[] = $repmt["pm_name"];
                                                        }
                                                        if ($urole == 'VIP') {
                                                            echo "<option value='" . $pm_id[0] . "'>" . $pm_name[0] . "</option>";
                                                            echo "<option value='" . $pm_id[1] . "'>" . $pm_name[1] . "</option>";
                                                            echo "<option value='" . $pm_id[2] . "'>" . $pm_name[2] . "</option>";
                                                        } else {
                                                            echo "<option value='" . $pm_id[0] . "'>" . $pm_name[0] . "</option>";
                                                            echo "<option value='" . $pm_id[1] . "'>" . $pm_name[1] . "</option>";
                                                        }

                                                        ?>


                                                    </select></label>
                                            </div>
                                            <input type="hidden" name="id" id="<?php echo $id; ?>" class="form-control">
                                            <input type="hidden" name="c_id" id="<?php echo $c_id; ?>" class="form-control">
                                            <div class="col-sm-label">
                                                <br>
                                                <button type="submit" name="rentcall" class="btn btn-success navCenter btn-block">บันทึก</button>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                            <div class="card-body bg-secondary ">
                                <table class="table table-bordered bg-white ">
                                    <thead class="h4">
                                        <tr>
                                            <th>อาทิตย์</th>
                                            <th>จันทร์</th>
                                            <th>อังคาร</th>
                                            <th>พุธ</th>
                                            <th>พฤหัสฯ</th>
                                            <th>ศุกร์</th>
                                            <th>เสาร์</th>
                                        </tr>
                                    </thead>
                                    <tbody class="h4">
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

                            <div class="card-footer  ">
                                <button type="button" class="btn btn-outline-primary navLeft" <?php echo 'onclick="goTo(\'' . $prevMon . '\', \'' . $prevYear . '\');"'  ?>>
                                    <?php echo '<<' ?> เดือนที่แล้ว
                                </button>
                                <button type="button" class="btn btn-outline-primary navRight" <?php echo 'onclick="goTo(\'' . $nextMon . '\', \'' . $nextYear . '\');"'  ?>>
                                    เดือนต่อไป<?php echo '>>' ?>
                                </button>
                                <h3 class="text-center"><?php echo "เดือน" . $monthth;  ?>
                                </h3>
                                <h6 class="text-center">
                                    ( &#128154; = ว่าง , &#128308; = เต็ม )
                                </h6>
                            </div>
                        </div>
                    </div>
                </div>
                <?php
                mysqli_close($conn);
                ?>
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




    <?php
    include("scripter.php");
    ?>




</body>

</html>