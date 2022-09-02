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
        <div class="container-fluid">
          <!-- Page Heading -->
          <div class="col-sm-12">
            <span style="font-size:24px">ข้อมูลรถเครน&nbsp;</span>
            <button style="font-size:20px" class='btn btn btn-warning' name='Inserter'><i class="fas fa-pen"></i></button>
          </div>

          <form action="c_insert_sql.php" method="post" enctype="multipart/form-data">
            <div class="form-group row">
              <div class="col-sm-6">
                <div class="form-group row">
                  <div class="col-sm-6">
                    <label class="col-form-label">ชื่อรถ:</label>
                    <input type="text" class="form-control" id="c_name" name="c_name">
                  </div>
                  <div class="col-sm-6">
                    <label class="col-form-label" for="gender">ประเภทรถ:</label>
                    <select id='ct_id' name='ct_id' class='form-control'>
                      <option value=''>---เลือก---</option>
                      <?php
                      include('../config/connectdb.php');
                      $sql = "SELECT * FROM cranetype ";
                      $resultct = mysqli_query($conn, $sql) or die('sql ผิด');
                      while ($ct = mysqli_fetch_array($resultct)) {
                        echo "<option value='" . $ct["ct_id"] . "'>" . $ct["ct_name"] . "</option>";
                      }
                      ?>
                    </select>
                  </div>
                </div>

                <label class="col-form-label">รายละเอียด:</label>
                <textarea class="form-control" rows="3" id="c_details" name="c_details"></textarea>

                <div class="form-group row">
                  <div class="col-sm-6">
                    <label class="col-form-label">รูปของรถ:</label>
                    <input type="file" class="form-control" id="imgInput" name="img">
                  </div>
                  <div class="col-sm-6 col-form-label">
                    <div class=" col-form-label">
                      <br>
                      <button type="submit" name="updatecrane" class="btn btn-success btn-block">บันทึก</button>
                    </div>
                  </div>
                </div>

              </div>
              <div class="col-sm-6">
                <img id="previewImg" width="100%" alt="">







              </div>
            </div>
          </form>


          <?php

          //ติดต่อฐานข้อมูล mysql
          include('../config/connectdb.php');
          //เขียนภาษา SQL

          $sql = "SELECT crane.*,cranetype.ct_name FROM crane LEFT JOIN cranetype ON crane.ct_id=cranetype.ct_id";
          $result = mysqli_query($conn, $sql) or die('sql ผิด');
          //นับจำนวนข้อมูล

          //สร้างตาราง
          echo "<table class='table table-success table-hover' id='table_id'>";
          echo "<thead>";
          echo "<tr>";
          echo "<th>รูปภาพ</th>";
          echo "<th>ประเภท</th>";
          echo "<th>ชื่อรถ</th>";

          echo "<th>รายละเอียด</th>";
          echo "<th>แก้ไข</th>";
          echo "<th>ลบ</th>";

          echo "</tr>";
          echo "</thead>";
          echo "<tfoot>";
          echo "<tr class='align-text-center'>";
          echo "<th>รูปภาพ</th>";
          echo "<th>ประเภท</th>";
          echo "<th>ชื่อรถ</th>";
          echo "<th>รายละเอียด</th>";
          echo "<th>แก้ไข</th>";
          echo "<th>ลบ</th>";
          echo "</tr>";
          echo "</tfoot>";
          echo "<tbody>";
          while ($row = mysqli_fetch_assoc($result)) {
            echo "<tr>";
            echo "<th>" . "<img class='rounded' width='250px' src='../uploads/" . $row["c_img"] . "' >" . "</th>";
            echo "<th>" . $row["ct_name"] . "</th>";
            echo "<th>" . $row["c_name"] . "</th>";

            echo "<th>" . $row["c_details"] . "</th>";
                  
           echo "<th><button style='font-size:20px' class='btn btn-warning' name='edit' value='Edit' id='" . $row["c_id"] . "'>Edit</i></button></th>";
            echo "<th><input style='font-size:20px' type ='button' class='btn btn-danger' name='delete' value='Delete' id='" . $row["c_id"] . "'></th>";

            echo "</tr>";
          }
          echo "</tbody>";
          echo "</table>";
          mysqli_close($conn);
          ?>


        </div>
        <!-- /.container-fluid -->
      </div>
      <!-- End of Main Content -->


      <!-- cUpDate Modal-->
      <div class="modal fade" id="updateCModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered " role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel">ข้อมูลรถเช่า(แก้ไข)</h5>
              <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">×</span>
              </button>
            </div>
            <div class="modal-body">
              <div class="container-fluid">
                <div class="row">
                  <div class="col-sm-12">
                    <form method="post" id="UpDateC" name="UpDateC" class="form-group">
                      <div class="form-group">
                        <label>ชื่อรถ</label>
                        <input type="text" name="c_name_UpD" id="c_name_UpD" class="form-control" placeholder="กรอกชื่อและนามสกุล">
                      </div>
                      <div class="form-group">
                        <label for="ct_id_UpD">ประเภทรถ</label>
                        <select id='ct_id_UpD' name='ct_id_UpD' class='form-control'>
                          <option value=''>---เลือกประเภทรถ---</option>
                          <?php
                          include('../config/connectdb.php');
                          $sqlct = "SELECT * FROM cranetype ";
                          $resultct = mysqli_query($conn, $sqlct) or die('sql ผิด');
                          while ($rect = mysqli_fetch_array($resultct)) {
                            echo "<option value='" . $rect["ct_id"] . "'>" . $rect["ct_name"] . "</option>";
                          }
                          ?>
                        </select>
                      </div>
                      <div class="form-group">
                        <label class="col-form-label">รายละเอียด:</label>
                        <textarea class="form-control" name="c_Det_UpD" id="c_Det_UpD"></textarea>

                      </div>
                      <input type="hidden" name="c_id_UpD" id="c_id_UpD" class="form-control">

                      <input type="submit" value="บันทึก" class="btn btn-primary" name="bsubmit" id="bsubmit">
                      <input type="hidden" id="id" name="id">
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




  <!-- CraneTypeInsert Modal-->
  <div class="modal fade" id="CTI" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">ข้อมูลประเภทรถ</h5>
          <button class="close" type="button" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <div class="modal-body">
          <div class="container-fluid">
            <div class="row">
              <div class="col-sm-12">
                <form method="post" id="cranetypeform" name="cranetypeform" class="form-group">
                  <div class="form-group">
                    <input type="text" name="ct_name" id="ct_name" class="form-control" placeholder="กรอกประเภทรถ">
                  </div>
                  <?php
                  //ติดต่อฐานข้อมูล mysql
                  include('../config/connectdb.php');
                  //เขียนภาษา SQL
                  $sql2 = "SELECT * FROM cranetype ";
                  $result2 = mysqli_query($conn, $sql2) or die('sql ผิด');
                  //สร้างตาราง
                  echo "<table class='table table-hover table-sm' id='table_id'>";

                  echo "<thead>";
                  echo "<tr>";
                  echo "</tr>";
                  echo "</thead>";
                  echo "<tfoot>";
                  echo "<tr>";

                  echo "</tr>";
                  echo "</tfoot>";
                  echo "<tbody>";


                  echo "<tbody>";
                  while ($row2 = mysqli_fetch_assoc($result2)) {
                    echo "<tr>";
                    echo "<th>" . $row2["ct_name"] . "</th>";
                    echo "<th><input  type ='button' class='btn btn-danger' name='ct_delete' value='Delete' id='" . $row2["ct_id"] . "'></th>";
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
        <div class="modal-footer">
          <input type="submit" value="บันทึก" class="btn btn-primary" id="ctsubmit">
          <input type="hidden" id="id" name="id">
          <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
        </div>
        </form>
      </div>
    </div>
  </div>
  <!--End of UserTypeInsert Modal-->


  <!-- deletect Modal-->
  <div class="modal fade" id="deletectModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">ต้องการลบจริงหรือไม่</h5>
          <button class="close" type="button" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <div class="modal-body">
          <form class="form-group" method="post" name="deletect" id="deletect">
            <div class="form-group">
              <label>รหัสประเภทรถ</label>
              <input type="text" name="ct_id_del" id="ct_id_del" class="form-control" readonly>
            </div>
            <div class="form-group">
              <label>ประเภทรถ</label>
              <input type="text" name="ct_name_del" id="ct_name_del" class="form-control" readonly>
            </div>
            <input type="submit" value="ลบ" class="btn btn-danger" id="insert">
            <input type="hidden" id="id" name="id">
          </form>
        </div>
        <div class="modal-footer">
          <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
        </div>
      </div>
    </div>
  </div>
  <!--End of deletct Modal-->






  <!-- delete Modal-->
  <div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">ต้องการลบจริงหรือไม่</h5>
          <button class="close" type="button" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <div class="modal-body">
          <form class="form-group" method="post" name="delcrane" id="delcrane">
            <div class="form-group">
              <label>ชื่อรถ</label>
              <input type="text" name="c_name_del" id="c_name_del" class="form-control" readonly>
            </div>
            <div class="form-group">
              <label>ประเภทรถ</label>
              <input type="text" name="ct_name_del2" id="ct_name_del2" class="form-control" readonly>
            </div>
            <div class="form-group">
              <label>รายละเอียด</label>
              <input type="text" name="c_details_del" id="c_details_del" class="form-control" readonly>
            </div>
            <input type="submit" value="ลบ" class="btn btn-danger" id="insert">
            <input type="hidden" id="c_id_del" name="c_id_del">
            <input type="hidden" id="id" name="id">
          </form>
        </div>
        <div class="modal-footer">
          <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
        </div>
      </div>
    </div>
  </div>
  <!--End of delete Modal-->






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
          //$('#c_name_UpD').val(data.c_id);
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