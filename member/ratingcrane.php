<?php
session_start();


?>
<?php
$id = $_SESSION['member_login'];
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
        <div id="content-wrapper" class="d-flex flex-column bg-info">

            <!-- Main Content -->
            <div id="content">

                <!-- Topbar -->
                <?php
                include("topbar.php");
                include('../config/connectdb.php');
                ?>
                <!-- End of Topbar -->

                <!-- Begin Page Content -->
                <div class="container-fluid bg-info">


                    <?php $sqlsum = "SELECT SUM(rcpt_allnum) as allsumrcpt FROM rcpt LEFT JOIN rental ON rcpt.r_id=rental.r_id LEFT JOIN users ON rental.users_id=users.users_id WHERE users.users_id = $id AND rcpt.rcpt_role ='ชำระสำเร็จ' ";
                    $resultsum = mysqli_query($conn, $sqlsum) or die('sql ผิด');
                    while ($rowsum = mysqli_fetch_assoc($resultsum)) {
                        $allsum = $rowsum["allsumrcpt"];
                    } ?>
                    <?php $sqldaysum = "SELECT SUM(r_numdate) as numb FROM rental  LEFT JOIN users ON rental.users_id=users.users_id WHERE users.users_id = $id AND rental.r_role ='ตรวจสอบเสร็จสิ้น' ";
                    $resultdaysum = mysqli_query($conn, $sqldaysum) or die('sql ผิด');
                    while ($rowdaysum = mysqli_fetch_assoc($resultdaysum)) {
                        $alldaysum = $rowdaysum["numb"];
                    } ?>



                    <br>
                    <div class="card bg-warning">
                        <div class="card-header bg-dark">
                            <h2 class="text-center text-white"><i class='fas fa-star text-warning'></i>&nbsp;<i class='fas fa-star text-warning'></i>&nbsp;<i class='fas fa-star text-warning'></i>&nbsp;ให้คะแนนเรา&nbsp;<i class='fas fa-star text-warning'></i>&nbsp;<i class='fas fa-star text-warning'></i>&nbsp;<i class='fas fa-star text-warning'></i></h2>
                        </div>
                        <div class="card-footer bg-warning">
                            <?php
                            //ติดต่อฐานข้อมูล mysql
                            include('../config/connectdb.php');
                            //เขียนภาษา SQL

                            $sqluser = "SELECT rcpt.*,rental.*,users.*,crane.*,payment_type.*  FROM rcpt LEFT JOIN rental ON rcpt.r_id=rental.r_id LEFT JOIN crane ON rental.c_id=crane.c_id LEFT JOIN payment_type ON rental.pm_id=payment_type.pm_id LEFT JOIN users ON rental.users_id=users.users_id where users.users_id = $id AND rcpt.rcpt_rating = 'ยังไม่ให้คะแนน'";
                            $resultuser = mysqli_query($conn, $sqluser) or die('sql ผิด');
                            //นับจำนวนข้อมูล

                            //สร้างตาราง
                            echo "<table class='table table-success table-hover' id='table_id'>";
                            echo "<thead>";
                            echo "<tr>";
                            echo "<th>รหัสบิล</th>";
                            echo "<th>รถ</th>";
                            echo "<th>ราคา</th>";
                            echo "<th>วันเช่า</th>";
                            echo "<th>รวม</th>";

                            echo "<th>คะแนน</th>";
                            echo "</tr>";
                            echo "</thead>";
                            echo "<tfoot>";
                            echo "<tr class='align-text-center'>";
                            echo "<th>รหัสบิล</th>";
                            echo "<th>รถ</th>";
                            echo "<th>ราคา</th>";
                            echo "<th>วันเช่า</th>";
                            echo "<th>รวม</th>";

                            echo "<th>คะแนน</th>";
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

                                echo "<th><button  class='btn btn-info' name='ratingb' value='Edit' id='" . $rowuser["r_id"] . "'><i class='fas fa-star text-warning'></i></i></button></th>";
                                echo "</tr>";
                            }
                            echo "</tbody>";
                            echo "</table>";
                            ?>
                        </div>

                    </div>
                    <br>


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

                                    <div class="form-group ">
                                        <label>รหัสใบเสร็จ</label>
                                        <input type="text" name="rcpt_id_form" id="rcpt_id_form" class="form-control" readonly>
                                    </div>
                                    <div class="row">
                                        <div class="form-group col-sm">
                                            <input type="radio" id="rating" name="rating" value="1">
                                            &nbsp;<label for="html">ควรปรับปรุง</label>
                                        </div>
                                        <div class="form-group col-sm">
                                            <input type="radio" id="rating" name="rating" value="2">
                                            &nbsp;<label for="css">พอใช้</label>
                                        </div>
                                        <div class="form-group col-sm">
                                            <input type="radio" id="rating" name="rating" value="3">
                                            &nbsp;<label for="javascript">ดี</label>
                                        </div>
                                        <div class="form-group col-sm">
                                            <input type="radio" id="rating" name="rating" value="4">
                                            &nbsp;<label for="javascript">ดีมาก</label>
                                        </div>
                                        <div class="form-group col-sm">
                                            <input type="radio" id="rating" name="rating" value="5">
                                            &nbsp;<label for="javascript">ยอดเยี่ยม</label>
                                        </div>
                                    </div>
                                    <div class="form-group col-sm">
                                        <label>รายละเอียด</label>
                                        <input type="text" class="form-control" id="rating_details" name="rating_details">
                                    </div>

                            </div>
                        </div>
                    </div>

                </div>
                <div class="modal-footer">
                    <button class="btn btn-outline-secondary" type="button" data-dismiss="modal">Cancel</button>
                    <input type="submit" value="บันทึก" class="btn btn-primary" name="bsubmit" id="bsubmit">
                    </form>
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
            });

            //-------------คลิกปุ่มดูรายละเอียด------------\\
            $(document).on("click", "button[name='ratingb']", function() {
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

                        $('#detailsModal').modal('show');
                    }
                });
            });
            //-------------คลิกปุ่มดูรายละเอียด------------\\

            //-------------คลิกปุ่มบันทึกในฟอร์มแก้ไขชื่อ------------\\
            $('#DetailsForm').on('submit', function(e) {
                var form = $('#DetailsForm')[0];
                var formData = new FormData(form);
                e.preventDefault();
                $.ajax({
                    url: "rating_insert_sql.php",
                    type: "POST",
                    processData: false,
                    contentType: false,
                    data: formData,
                    beforeSend: function() {},
                    success: function(data) {
                        alert(data);
                        $('#DetailsForm')[0].reset();
                        $('#detailsModal').modal('hide');
                        location.reload();
                    }
                });
            });
            //-------------คลิกปุ่มบันทึกในฟอร์มแก้ไขชื่อ------------\\
        </script>
</body>

</html>