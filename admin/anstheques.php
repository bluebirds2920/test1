<?php
error_reporting(E_ALL ^ E_NOTICE);
session_start();
require_once '../config/connectdb.php';
//if (!isset($_SESSION['admin_login'])) {
//  $_SESSION['error'] = 'กรุณาเข้าสู่ระบบ!';
//  header('location: ../login.php');
//};

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





                <!-- Icon Divider-->
                <div class="container-fluid">
                    <!-- Portfolio Grid Items-->
                    <div class="justify-content-center">
                        <div class="card shadow mb-4">
                            <div class="card-header bg-dark py-3">
                                <h3 class="m-0 font-weight-bolder text-center text-warning">คำถาม </h3>



                            </div>
                            <div class="card-body">
                                <?php
                                $sql = "SELECT * FROM users_question ORDER BY users_question.uqt_id  DESC ";
                                $result = mysqli_query($conn, $sql) or die('sql ผิด'); ?>
                                <div class="row">
                                    <?php


                                    while ($row = mysqli_fetch_assoc($result)) {

                                        $qt = $row["uqt_id"];
                                        $x[] = $qt;
                                        $c = count($x);


                                        if ($c == 5) {
                                            break;
                                        };
                                    ?>


                                        <div class="col-md-6 col-lg-6 mb-5">
                                            <div class="card shadow mb-4">
                                                <div class="card-header py-3">
                                                    <h3 class="m-0 font-weight-bold text-dark">คำถามจากคุณ <span class="text-primary"><?php echo $row["uqt_firstname"] . "&nbsp;" . $row["uqt_lastname"]  ?> </span></h3>
                                                </div>
                                                <div class="card-body">
                                                    <?php echo $row["uqt_details"];
                                                    ?>
                                                    <hr>

                                                    <?php if ($row["uqt_answer"] != '') { ?>
                                                        <div class="card shadow mb-4">
                                                            <div class="card-body bg-dark py-3">
                                                                <h5 class="m-0 font-weight-bold text-light"><span class="text-light">

                                                                        <i class="far fa-check-circle text-success"></i>&nbsp;คำตอบ :</span>

                                                                    <?php echo $row["uqt_answer"];

                                                                    ?>



                                                                </h5>

                                                            </div>
                                                        </div>
                                                    <?php } else {
                                                    } ?>




                                                </div>
                                            </div>
                                        </div>
                                    <?php  }  ?>
                                    <div class="col-lg-12 mb-5">
                                        <div class="card shadow mb-4">
                                            <div class="card-header py-3">
                                                <h5 class="m-0 font-weight-bold text-danger">คำถามอื่นๆ


                                                </h5>
                                            </div>
                                            <div class="card-body">
                                                <?php
                                                $sqlx = "SELECT * FROM users_question ORDER BY users_question.uqt_id  DESC ";
                                                $resultx = mysqli_query($conn, $sqlx) or die('sql ผิด');
                                                //นับจำนวนข้อมูล

                                                //สร้างตาราง
                                                echo "<table class='table table-primary table-hover' id='table_id'>";
                                                echo "<thead>";
                                                echo "<tr>";
                                                echo "<th>คำถาม</th>";
                                                echo "<th>คำตอบ</th>";
                                                echo "<th>ดูคำตอบ</th>";


                                                echo "</tr>";
                                                echo "</thead>";
                                                echo "<tfoot>";
                                                echo "<tr class='align-text-center'>";
                                                echo "<th>คำถาม</th>";
                                                echo "<th>คำตอบ</th>";
                                                echo "<th>ดูคำตอบ</th>";


                                                echo "</tr>";
                                                echo "</tfoot>";
                                                echo "<tbody>";
                                                while ($rowx = mysqli_fetch_assoc($resultx)) {
                                                    echo "<tr>";
                                                    echo "<th>" . $rowx["uqt_details"] . "</th>";
                                                    echo "<th>" . $rowx["uqt_answer"] . "</th>";
                                                    echo "<th ><button style='font-size:20px' class='btn btn-warning btn-block' name='edit' value='Edit' id='" . $rowx["uqt_id"] . "'>ตอบ</i></button></th>";

                                                    echo "</tr>";
                                                }
                                                echo "</tbody>";
                                                echo "</table>";
                                                mysqli_close($conn);
                                                ?>
                                            </div>

                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>



                    <!-- Page Heading -->
                </div>

                <!-- /.container-fluid -->
            </div>
            <!-- End of Main Content -->


            <!-- cUpDate Modal-->
            <div class="modal fade" id="UpdateAnswerModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered " role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">ตอบคำถาม</h5>
                            <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">×</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <div class="container-fluid">
                                <div class="row">
                                    <div class="col-sm-12">
                                        <form method="post" id="UpdateAnswer" name="UpdateAnswer" class="form-group">
                                            <div class="form-group row">
                                                <div class="col-sm-6">
                                                    <label>ชื่อ</label>
                                                    <input type="text" name="uqt_firstname" id="uqt_firstname" class="form-control" readonly>
                                                </div>
                                                <div class="col-sm-6">
                                                    <label>นามสกุล</label>
                                                    <input type="text" name="uqt_lastname" id="uqt_lastname" class="form-control" readonly>
                                                </div>
                                            </div>


                                            <div class="form-group">
                                                <label>เบอร์ติดต่อ</label>
                                                <input type="text" name="uqt_phone" id="uqt_phone" class="form-control" readonly>
                                            </div>


                                            <div class="form-group">
                                                <label class="col-form-label">คำถาม:</label>
                                                <textarea class="form-control" name="uqt_details" id="uqt_details" readonly></textarea>

                                            </div>
                                            <div class="form-group">
                                                <label class="col-form-label">คำตอบ:</label>
                                                <textarea class="form-control" name="uqt_answer" id="uqt_answer"></textarea>

                                            </div>
                                            <input type="hidden" name="id" id="id" class="form-control">

                                            <input type="submit" value="บันทึก" class="btn btn-primary" name="bsubmit" id="bsubmit">

                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                        </div>
                    </div>
                </div>
            </div>
            <!--End of cUpDate Modal-->

            <!-- Footer -->
            <footer class="sticky-footer bg-white">
                <div class="container my-auto">
                    <div class="copyright text-center my-auto">
                        <span>Copyright &copy; Preecha Crane Rental 2015</span>
                    </div>
                </div>
            </footer>
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
                    <h5 class="modal-title" id="exampleModalLabel">ออกจากระบบ ?</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">เลือกออกจากระบบ หากคุณต้องการที่จะ " ออกจากระบบ ".</div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                    <a class="btn btn-primary" href="logout.php">ออกจากระบบ</a>
                </div>
            </div>
        </div>
    </div>












    <!-- Bootstrap core JavaScript-->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="js/sb-admin-2.min.js"></script>

    <!-- Page level plugins -->
    <script src="vendor/chart.js/Chart.min.js"></script>

    <!-- Page level custom scripts -->
    <script src="js/demo/chart-area-demo.js"></script>
    <script src="js/demo/chart-pie-demo.js"></script>

    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.22/js/jquery.dataTables.js"></script>


    <script>
        $(document).ready(function() {
            $('#table_id').DataTable();
        });



        //-------------คลิกปุ่มตอบคำถาม------------\\
        $(document).on("click", "button[name='edit']", function() {
            var uid = $(this).attr("id");
            $.ajax({
                url: "fetch_question.php",
                method: "post",
                data: {
                    id: uid
                },
                dataType: "json",
                success: function(data) {
                    $('#id').val(data.uqt_id);
                    $('#uqt_firstname').val(data.uqt_firstname);
                    $('#uqt_lastname').val(data.uqt_lastname);
                    $('#uqt_phone').val(data.uqt_phone);
                    $('#uqt_details').val(data.uqt_details);
                    $('#uqt_answer').val(data.uqt_answer);
                    $('#UpdateAnswerModal').modal('show');
                }
            });
        });
        //-------------คลิกปุ่มแก้ไขข้อมูลที่รายการ------------\\

        //-------------คลิกปุ่มแก้ไขในฟอร์มแก้ไข------------\\

        $('#UpdateAnswer').on('submit', function(e) {
            var form = $('#UpdateAnswer')[0];
            var formData = new FormData(form);
            e.preventDefault();
            $.ajax({
                url: "update_answer_sql.php",
                type: "POST",
                processData: false,
                contentType: false,
                data: formData,
                beforeSend: function() {},
                success: function(data) {
                    alert(data);
                    $('#UpdateAnswer')[0].reset();
                    $('#UpdateAnswerModal').modal('hide');
                    location.reload();
                }
            });
        });
        //-------------คลิกปุ่มแก้ไขในฟอร์มแก้ไข------------\\		
    </script>

</body>

</html>