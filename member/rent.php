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
        <div id="content-wrapper" class="d-flex flex-column bg-info">

            <!-- Main Content -->
            <div id="content">

                <!-- Topbar -->
                <?php
                include("topbar.php");
                ?>
                <!-- End of Topbar -->

                <!-- Begin Page Content -->
                <div class="container-fluid bg-info">



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
                            <h1 class="h2 mb-0 text-gray-800">เลือกเช่ารถ
                                <?php if ($row["urole"] == "VIP") {
                                ?>
                                    <span class="text-warning">
                                        <?php echo  "( " . $row["urole"] . " )"; ?> </span><span class="text-danger"> <?php echo "รับส่วนลด 15 %";
                                                                                                                    } ?></span>
                            </h1>
                        </div>

                    <?php }
                    mysqli_close($conn);
                    ?>


                    <div class="container-fluid">
                        <?php
                        include('../config/connectdb.php');
                        $sql3 = "SELECT * FROM crane";
                        $result3 = mysqli_query($conn, $sql3) or die('sql ผิด'); ?>
                        <div class="row">
                            <?php while ($row3 = mysqli_fetch_assoc($result3)) { ?>

                                <div class="col-lg-4  mb-2 ">
                                    <div class="card bg-warning " style="width:100%" >
                                        <div class="card-header text-center bg-warning "> <h3 class="card-title" style="color:black"> <?php echo $row3["c_name"]  ?></h3></div>
                                        <?php
                                        echo "<img class='mx-auto d-block'  alt='Card image' style='width:100%'' src='../uploads/" . $row3["c_img"] . "' >";
                                        ?>
                                        <div class="card-body text-center">
                                            <h5 class="card-title text-center" style="color:black"> <?php echo "ราคา " . $row3["c_num"] . " บาท / วัน"  ?></h4>
                                            <h6 style="color:black"> <?php echo  $row3["c_details"]; ?></h6>
                                            <form action="check_craneid.php" method="post">
                                                <input type="hidden" value="<?php echo $row3["c_id"] ?>" class="form-control" name="c_id">
                                                <div class="col-sm-12 mb-3 mb-sm-0">
                                                    <button type="submit" name="rent" class="btn btn-success btn-user btn-block"><i class='fas' style='font-size:24px;color:black'>เช่า</i></button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            <?php } ?>
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


  

   



    <?php
    include("scripter.php");
    ?>



    
</body>

</html>