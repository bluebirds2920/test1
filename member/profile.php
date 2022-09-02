<?php
session_start();


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
                    $id = $_SESSION['member_login'];
                    ?>
                    <?php

                    //ติดต่อฐานข้อมูล mysql
                    include('../config/connectdb.php');
                    //เขียนภาษา SQL

                    $sql = "SELECT * FROM users  WHERE users_id = $id";
                    $result = mysqli_query($conn, $sql) or die('sql ผิด');
                    //นับจำนวนข้อมูล

                    while ($row = mysqli_fetch_assoc($result)) { ?>

                        <div class="d-sm-flex align-items-center justify-content-center mb-4">
                            <h1 class="h2 mb-0 text-gray-800">ข้อมูลส่วนตัว
                                <?php if ($row["urole"] == "VIP") {
                                ?>
                                    <span class="text-warning">
                                    <?php echo  "( " . $row["urole"] . " )";
                                } ?></span>
                            </h1>
                        </div>
                        <div class="d-sm-flex align-items-center justify-content-center mb-4">
                            <div class=" col-lg-6 col-sm-12 col-md-12 card-body bg-success ">

                                <h3 class="m-0 font-weight-bold text-dark">
                                    <?php
                                    echo "E-mail : " . $row["email"] ?>


                                </h3>
                                <br>
                                <div class="row">
                                    <div class="col-10">
                                        <h3 class="m-0 font-weight-bold text-dark">
                                            <?php
                                            echo "ชื่อ : " . $row["fullname"] . "<br>"; ?></h3>
                                    </div>
                                    <div class="col-1"><button class='btn btn btn-warning' name='editname' id='<?php echo $id ?>'><i class="fas fa-pen"></i></button></div>
                                </div>
                                <br>
                                <div class="row">
                                    <div class="col-10">
                                        <h3 class="m-0 font-weight-bold text-dark">
                                            <?php
                                            echo "เบอร์โทรศัพท์ : " . $row["phonenumber"] . "<br>"; ?>
                                    </div>
                                    <div class="col-1"><button class='btn btn btn-warning' name='editphone' id='<?php echo $id ?>'><i class="fas fa-pen"></i></button></div>
                                </div>
                            <?php }
                        mysqli_close($conn);
                            ?>
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
                    <a class="btn btn-primary" href="logout.php">Logout</a>
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
                                        <input type="text" name="phonenumber" id="phonenumber" class="form-control" >
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



    <?php
    include("scripter.php");
    ?>



    <script>
        //-------------คลิกปุ่มแก้ไขชื่อ------------\\
        $(document).on("click", "button[name='editname']", function() {
            var uid = $(this).attr("id");
            $.ajax({
                url: "profile_fetch_edit.php",
                method: "post",
                data: {
                    id: uid
                },
                dataType: "json",
                success: function(data) {
                    $('#id').val(data.users_id);
                    $('#fullname').val(data.fullname);
                    $('#EditName').modal('show');
                }
            });
        });
        //-------------คลิกปุ่มแก้ไขชื่อ------------\\



        //-------------คลิกปุ่มแก้ไขเบอร์โทรศัพท์------------\\
        $(document).on("click", "button[name='editphone']", function() {
            var uid = $(this).attr("id");
            $.ajax({
                url: "profile_fetch_edit.php",
                method: "post",
                data: {
                    id: uid
                },
                dataType: "json",
                success: function(data) {
                    $('#id2').val(data.users_id);
                    $('#phonenumber').val(data.phonenumber);
                    $('#EditPhone').modal('show');
                }
            });
        });
        //-------------คลิกปุ่มแก้ไขเบอร์โทรศัพท์------------\\

        //-------------คลิกปุ่มบันทึกในฟอร์มแก้ไขชื่อ------------\\
        $('#EditorName').on('submit', function(e) {
            var form = $('#EditorName')[0];
            var formData = new FormData(form);
            e.preventDefault();
            $.ajax({
                url: "profile_update_name.php",
                type: "POST",
                processData: false,
                contentType: false,
                data: formData,
                beforeSend: function() {},
                success: function(data) {
                    alert(data);
                    $('#EditorName')[0].reset();
                    $('#Editname').modal('hide');
                    location.reload();
                }
            });
        });
        //-------------คลิกปุ่มบันทึกในฟอร์มแก้ไขชื่อ------------\\
        
        //-------------คลิกปุ่มบันทึกในฟอร์มแก้ไขชื่อ------------\\
        $('#EditorPhone').on('submit', function(e) {
            var form = $('#EditorPhone')[0];
            var formData = new FormData(form);
            e.preventDefault();
            $.ajax({
                url: "profile_update_phone.php",
                type: "POST",
                processData: false,
                contentType: false,
                data: formData,
                beforeSend: function() {},
                success: function(data) {
                    alert(data);
                    $('#EditorPhone')[0].reset();
                    $('#EditPhone').modal('hide');
                    location.reload();
                }
            });
        });
        //-------------คลิกปุ่มบันทึกในฟอร์มแก้ไขชื่อ------------\\
     
    </script>
</body>

</html>