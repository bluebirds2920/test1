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
    <div id="content-wrapper" class="d-flex flex-column">

      <!-- Main Content -->
      <div id="content">

        <!-- Topbar -->
        <?php
        include("topbar.php");
        include('../config/connectdb.php');
        ?>
        <!-- End of Topbar -->

        <!-- Begin Page Content -->
        <div class="container-fluid">


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
          <div class="card">
            <div class="card-header bg-dark">
              <h2 class="text-center text-white">ข้อมูลการเช่ารถ</h2>
            </div>
            <div class="card-body">
              <?php
              //ติดต่อฐานข้อมูล mysql
              include('../config/connectdb.php');
              //เขียนภาษา SQL
              $sqluser = "SELECT rental.*,crane.c_name,payment_type.pm_name,users.fullname FROM rental LEFT JOIN crane ON rental.c_id=crane.c_id LEFT JOIN payment_type ON rental.pm_id=payment_type.pm_id LEFT JOIN users ON rental.users_id=users.users_id  WHERE  users.users_id = $id AND rental.r_role ='รอการตรวจสอบ'";
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
              echo "<th>แก้ไข</th>";
              echo "<th>ลบ</th>";
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
              echo "<th>แก้ไข</th>";
              echo "<th>ลบ</th>";
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
                echo "<th><button style='font-size:20px' class='btn btn-warning' name='editrent' value='Edit' id='" . $rowuser["r_id"] . "'>Edit</button></th>";
                echo "<th><button style='font-size:20px' type ='button' class='btn btn-outline-danger' name='delrent' value='Delete' id='" . $rowuser["r_id"] . "'>Delete</button></th>";
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

              $sqluser = "SELECT rcpt.*,rental.*,users.*,crane.*,payment_type.*  FROM rcpt LEFT JOIN rental ON rcpt.r_id=rental.r_id LEFT JOIN crane ON rental.c_id=crane.c_id LEFT JOIN payment_type ON rental.pm_id=payment_type.pm_id LEFT JOIN users ON rental.users_id=users.users_id where users.users_id = $id";
              $resultuser = mysqli_query($conn, $sqluser) or die('sql ผิด');
              //นับจำนวนข้อมูล

              //สร้างตาราง
              echo "<table class='table table-success table-hover' id='table_id2'>";
              echo "<thead>";
              echo "<tr>";
              echo "<th>พิมพ์</th>";
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
              echo "<th>พิมพ์</th>";
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
              ?>

                <form action="report_rcpt.php" method="post">

                  <input type="hidden" name="rcpt_idfinish" id="rcpt_idfinish" value="<?php echo $rowuser["rcpt_id"]; ?>">
                  <?php
                  echo "<th><button  class='btn btn-success' type='submit' name='RcptButton' value='Edit' id='" . $rowuser["rcpt_id"] . "'><i class='fas fa-print'></i></button></th>";
                  ?>

                </form>

              <?php
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


  <!-- detailsrentModal-->
  <div class="modal fade" id="detailsrentModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
                <form method="post" id="DetailsRentForm" name="DetailsRentForm" class="form-group">
                  <div class="form-group row">
                    <div class="form-group col-sm">
                      <label>รหัสการเช่า</label>
                      <input type="text" name="r_id_rentform" id="r_id_rentform" class="form-control" readonly>
                    </div>
                    <div class="form-group col-sm">
                      <label>วันที่เริ่ม</label>
                      <input type="date" name="r_startdate_rentform" id="r_startdate_rentform" class="form-control">
                    </div>

                  </div>
                  <div class="row">
                    <div class="form-group col-sm">
                      <label>รถ</label>
                      <input type="text" name="c_name_rentform" id="c_name_rentform" class="form-control" readonly>
                    </div>
                    <div class="form-group col-sm">
                      <label>จำนวนวัน</label>
                      <input type="num" min="1" name="r_numdate_rentform" id="r_numdate_rentform" class="form-control">
                    </div>
                  </div>
                  <div class="form-group col-sm">
                    <label>สถานที่เช่า</label>
                    <input type="text" name="r_place_rentform" id="r_place_rentform" class="form-control">
                  </div>


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
  <!--End of detailsrentModal-->



  <!-- detailsModal-->
  <div class="modal fade" id="DelRentModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
                <form method="post" id="DelRentForm" name="DelRentForm" class="form-group">
                  <div class="form-group row">
                    <div class="form-group col-sm">
                      <label>รหัสการเช่า</label>
                      <input type="text" name="r_id_rentform2" id="r_id_rentform2" class="form-control" readonly>
                    </div>
                    <div class="form-group col-sm">
                      <label>วันที่เริ่ม</label>
                      <input type="date" name="r_startdate_rentform2" id="r_startdate_rentform2" class="form-control" readonly>
                    </div>

                  </div>
                  <div class="row">
                    <div class="form-group col-sm">
                      <label>รถ</label>
                      <input type="text" name="c_name_rentform2" id="c_name_rentform2" class="form-control" readonly>
                    </div>
                    <div class="form-group col-sm">
                      <label>จำนวนวัน</label>
                      <input type="num" min="1" name="r_numdate_rentform2" id="r_numdate_rentform2" class="form-control" readonly>
                    </div>
                  </div>
                  <div class="form-group col-sm">
                    <label>สถานที่เช่า</label>
                    <input type="text" name="r_place_rentform2" id="r_place_rentform2" class="form-control" readonly>
                  </div>


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
  <!--End of detailsModal-->


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
                    <div class="form-group col-sm">
                      <label>รหัสใบเสร็จ</label>
                      <input type="text" name="rcpt_id_form" id="rcpt_id_form" class="form-control" readonly>
                    </div>
                    <div class="form-group col-sm">
                      <label>วันที่เริ่ม</label>
                      <input type="text" name="rcpt_date_form" id="rcpt_date_form" class="form-control" readonly>
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
    $(document).on("click", "button[name='editrent']", function() {
      var uid = $(this).attr("id");
      $.ajax({
        url: "rent_fetch.php",
        method: "post",
        data: {
          id: uid
        },
        dataType: "json",
        success: function(data) {
          $('#r_id_rentform').val(data.r_id);
          $('#r_startdate_rentform').val(data.r_startdate);
          $('#c_name_rentform').val(data.c_name);
          $('#r_numdate_rentform').val(data.r_numdate);
          $('#r_place_rentform').val(data.r_place);
          $('#detailsrentModal').modal('show');
        }
      });
    });
    //-------------คลิกปุ่มดูรายละเอียด------------\\

    //-------------คลิกปุ่มบันทึกในฟอร์มแก้ไขชื่อ------------\\
    $('#DetailsRentForm').on('submit', function(e) {
      var form = $('#DetailsRentForm')[0];
      var formData = new FormData(form);
      e.preventDefault();
      $.ajax({
        url: "rent_update_sql.php",
        type: "POST",
        processData: false,
        contentType: false,
        data: formData,
        beforeSend: function() {},
        success: function(data) {
          alert(data);
          $('#DetailsRentForm')[0].reset();
          $('#detailsrentModal').modal('hide');
          location.reload();
        }
      });
    });
    //-------------คลิกปุ่มบันทึกในฟอร์มแก้ไขชื่อ------------\\

    //-------------คลิกปุ่มดูรายละเอียด------------\\
    $(document).on("click", "button[name='delrent']", function() {
      var uid = $(this).attr("id");
      $.ajax({
        url: "rent_fetch.php",
        method: "post",
        data: {
          id: uid
        },
        dataType: "json",
        success: function(data) {
          $('#r_id_rentform2').val(data.r_id);
          $('#r_startdate_rentform2').val(data.r_startdate);
          $('#c_name_rentform2').val(data.c_name);
          $('#r_numdate_rentform2').val(data.r_numdate);
          $('#r_place_rentform2').val(data.r_place);
          $('#DelRentModal').modal('show');
        }
      });
    });
    //-------------คลิกปุ่มดูรายละเอียด------------\\


    //-------------คลิกปุ่มบันทึกในฟอร์มแก้ไขชื่อ------------\\
    $('#DelRentForm').on('submit', function(e) {
      var form = $('#DelRentForm')[0];
      var formData = new FormData(form);
      e.preventDefault();
      $.ajax({
        url: "rent_delete_sql.php",
        type: "POST",
        processData: false,
        contentType: false,
        data: formData,
        beforeSend: function() {},
        success: function(data) {
          alert(data);
          $('#DelRentForm')[0].reset();
          $('#DelRentModal').modal('hide');
          location.reload();
        }
      });
    });
    //-------------คลิกปุ่มบันทึกในฟอร์มแก้ไขชื่อ------------\\




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