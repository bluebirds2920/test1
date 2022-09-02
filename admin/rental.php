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


          <div class="card shadow mb-4">
            <div class="card-header py-3">
              <h3 class="m-0 font-weight-bold text-primary">คำร้องขอการเช่ารถเครน </h6>

            </div>
            <div class="card-body">
              <?php

              //ติดต่อฐานข้อมูล mysql
              include('../config/connectdb.php');
              //เขียนภาษา SQL

              $sql = "SELECT rental.*,crane.c_name,users.fullname FROM rental LEFT JOIN crane ON rental.c_id=crane.c_id LEFT JOIN users ON rental.users_id=users.users_id WHERE rental.rt_role ='อยู่ระหว่างตรวจสอบ'";
              $result = mysqli_query($conn, $sql) or die('sql ผิด');
              //นับจำนวนข้อมูล

              //สร้างตาราง
              echo "<table class='table table-success table-hover' id='table_id'>";
              echo "<thead>";
              echo "<tr>";
              echo "<th>รหัสการเช่า</th>";
              echo "<th>ผู้เช่า</th>";
              echo "<th>ชื่อรถ</th>";
              echo "<th>เริ่ม</th>";
              echo "<th>สิ้นสุด</th>";
              echo "<th>รวม</th>";
              echo "<th>สถานะ</th>";
              echo "<th>Edit</th>";
              echo "<th>Delete</th>";

              echo "</tr>";
              echo "</thead>";
              echo "<tfoot>";
              echo "<tr class='align-text-center'>";
              echo "<th>รหัสการเช่า</th>";
              echo "<th>ผู้เช่า</th>";
              echo "<th>ชื่อรถ</th>";
              echo "<th>เริ่ม</th>";
              echo "<th>สิ้นสุด</th>";
              echo "<th>รวม</th>";
              echo "<th>สถานะ</th>";
              echo "<th>Edit</th>";
              echo "<th>Delete</th>";
              echo "</tr>";
              echo "</tfoot>";
              echo "<tbody>";
              while ($row = mysqli_fetch_assoc($result)) {
                echo "<tr>";
                echo "<th>" . $row["rt_id"] . "</th>";
                echo "<th>" . $row["fullname"] . "</th>";
                echo "<th>" . $row["c_name"] . "</th>";
                echo "<th>" . $row["rt_startdate"] . "</th>";
                echo "<th>" . $row["rt_enddate"] . "</th>";
                echo "<th>" . $row["rt_num"] . "</th>";
                echo "<th>" . $row["rt_role"] . "</th>";

                echo "<th><button  class='btn btn-warning' name='edit'  id='" . $row["c_id"] . "'>Edit</button></th>";
                echo "<th><input type ='button' class='btn btn-danger' name='delete' value='Delete' id='" . $row["c_id"] . "'></th>";

                echo "</tr>";
              }
              echo "</tbody>";
              echo "</table>";
           
              ?>
            </div>
          </div>



          <div class="card shadow mb-4">
            <div class="card-header py-3">
              <h3 class="m-0 font-weight-bold text-primary">เช็คข้อมูลรถ <button style="font-size:20px" class='btn btn btn-warning' name='Inserter'><i class="fas fa-snowplow"></i></button></h6>

            </div>
            <div class="card-body">

              <?php

              //เขียนภาษา SQL

              $sql2 = "SELECT rental.*,crane.c_name FROM rental LEFT JOIN crane ON rental.c_id=crane.c_id WHERE rental.rt_role ='สำเร็จ' ";
              $result2 = mysqli_query($conn, $sql2) or die('sql ผิด');
              //นับจำนวนข้อมูล
              
             
              //สร้างตาราง
              echo "<table class='table table-success table-hover' id='table_id2'>";
              echo "<thead>";
              echo "<tr>";
              echo "<th>Rental ID</th>";
              echo "<th>Crane</th>";
              echo "<th>Start</th>";
              echo "<th>End</th>";
              echo "<th>total</th>";
              echo "<th>status</th>";
              echo "<th>Edit</th>";
              echo "<th>Delete</th>";

              echo "</tr>";
              echo "</thead>";
              echo "<tfoot>";
              echo "<tr class='align-text-center'>";
              echo "<th>Rental ID</th>";
              echo "<th>Crane</th>";
              echo "<th>Start</th>";
              echo "<th>End</th>";
              echo "<th>total</th>";
              echo "<th>status</th>";
              echo "<th>Edit</th>";
              echo "<th>Delete</th>";
              echo "</tr>";
              echo "</tfoot>";
              echo "<tbody>";
              while ($row2 = mysqli_fetch_assoc($result2)) {
                echo "<tr>";
                echo "<th>" . $row2["rt_id"] . "</th>";
                echo "<th>" . $row2["c_name"] . "</th>";
                echo "<th>" . $row2["rt_startdate"] . "</th>";
                echo "<th>" . $row2["rt_enddate"] . "</th>";
                echo "<th>" . $row2["rt_num"] . "</th>";
                echo "<th>" . $row2["rt_role"] . "</th>";

                echo "<th><button class='btn btn-warning' name='edit' value='Edit' id='" . $row2["c_id"] . "'>Edit</i></button></th>";
                echo "<th><input type ='button' class='btn btn-danger' name='delete' value='Delete' id='" . $row2["c_id"] . "'></th>";

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
      $('#table_id2').DataTable();
    });

    let imgInput = document.getElementById('imgInput');
    let previewImg = document.getElementById('previewImg');

    imgInput.onchange = evt => {
      const [file] = imgInput.files;
      if (file) {

        previewImg.src = URL.createObjectURL(file);
      }
    };

    $(document).ready(function() {
      $('#table_id').DataTable();
    });
    //-------------คลิกปุ่ม+เพิ่มข้อมูลประเภทรถ------------\\
    $(document).on("click", "button[name='Inserter']", function() {
      $('#CTI').modal('show');

    });


    //-------------คลิกปุ่มเพิ่มข้อมูลประเภทรถ------------\\
    $('#cranetypeform').on('submit', function(e) {
      var form = $('#cranetypeform')[0];
      var formData = new FormData(form);
      e.preventDefault();
      $.ajax({
        url: "ct_insert_sql.php",
        type: "POST",
        processData: false,
        contentType: false,
        data: formData,
        beforeSend: function() {},
        success: function(data) {
          alert(data);
          $('#cranetypeform')[0].reset();
          $('#CTI').modal('hide');
          location.reload();
        }
      });
    });
    //-------------คลิกปุ่มเพิ่มข้อมูลประเภทรถ------------\\

    //-------------คลิกปุ่มลบที่ข้อมูลประเภทรถ------------\\
    $('#cranetypeform').on("click", "input[name='ct_delete']", function() {
      var uid = $(this).attr("id");
      $.ajax({
        url: "ct_fetch_edit.php",
        method: "post",
        data: {
          id: uid
        },
        dataType: "json",
        success: function(data) {
          $('#ct_id_del').val(data.ct_id);
          $('#ct_name_del').val(data.ct_name);
          $('#deletectModal').modal('show');
          $('#CTI').modal('hide');
        }
      });
    });
    //-------------คลิกปุ่มลบที่ข้อมูลประเภทรถ------------\\

    //-------------คลิกปุ่มลบข้อมูลประเภทรถ------------\\
    $('#deletect').on('submit', function(e) {
      var form = $('#deletect')[0];
      var formData = new FormData(form);
      e.preventDefault();
      $.ajax({
        url: "ct_delete_sql.php",
        type: "POST",
        processData: false,
        contentType: false,
        data: formData,
        beforeSend: function() {},
        success: function(data) {
          alert(data);
          $('#deletect')[0].reset();
          $('#deletectModal').modal('hide');
          location.reload();
        }
      });
    });
    //-------------คลิกปุ่มลบข้อมูลประเภทรถ------------\\

    //-------------คลิกปุ่มแก้ไขข้อมูลที่รายการ------------\\
    $(document).on("click", "button[name='edit']", function() {
      var uid = $(this).attr("id");
      $.ajax({
        url: "c_fetch_edit.php",
        method: "post",
        data: {
          id: uid
        },
        dataType: "json",
        success: function(data) {
          $('#id').val(data.c_id);
          $('#c_name_UpD').val(data.c_id);
          $('#ct_id_UpD').val(data.ct_id);
          $('#c_name_UpD').val(data.c_name);
          $('#c_Det_UpD').val(data.c_details);
          $('#updateCModal').modal('show');
        }
      });
    });
    //-------------คลิกปุ่มแก้ไขข้อมูลที่รายการ------------\\

    //-------------คลิกปุ่มแก้ไขในฟอร์มแก้ไข------------\\

    $('#UpDateC').on('submit', function(e) {
      var form = $('#UpDateC')[0];
      var formData = new FormData(form);
      e.preventDefault();
      $.ajax({
        url: "c_update_sql.php",
        type: "POST",
        processData: false,
        contentType: false,
        data: formData,
        beforeSend: function() {},
        success: function(data) {
          alert(data);
          $('#UpDateC')[0].reset();
          $('#updateCModal').modal('hide');
          location.reload();
        }
      });
    });
    //-------------คลิกปุ่มแก้ไขในฟอร์มแก้ไข------------\\		


    //-------------คลิกปุ่มลบข้อมูลที่รายการ------------\\

    $(document).on("click", "input[name='delete']", function() {
      var uid = $(this).attr("id");
      $.ajax({
        url: "c_fetch_edit.php",
        method: "post",
        data: {
          id: uid
        },
        dataType: "json",
        success: function(data) {
          $('#c_id_del').val(data.c_id);
          $('#ct_name_del2').val(data.ct_name);
          $('#c_name_del').val(data.c_name);
          $('#c_details_del').val(data.c_details);
          $('#deleteModal').modal('show');
        }
      });
    });
    //-------------คลิกปุ่มลบข้อมูลที่รายการ------------\\


    //-------------คลิกปุ่มลบในฟอร์มลบ------------\\
    $('#delcrane').on('submit', function(e) {
      var form = $('#delcrane')[0];
      var formData = new FormData(form);
      e.preventDefault();
      $.ajax({
        url: "crane_delete_sql.php",
        type: "POST",
        processData: false,
        contentType: false,
        data: formData,
        beforeSend: function() {},
        success: function(data) {
          alert(data);
          $('#delcrane')[0].reset();
          $('#deleteModal').modal('hide');
          location.reload();
        }
      });
    });
    //-------------คลิกปุ่มลบในฟอร์มลบ------------\\
  </script>



</body>

</html>