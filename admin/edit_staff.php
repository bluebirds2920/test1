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
          <div class="row">
            <div class="col-sm">
            
             <h2 class="text-center" style="font-size:24px">จัดการข้อมูลพนักงาน</h2>
              
             <div class="col-sm text-center">
                      <img id="previewImg" width="100%" alt="">
                      </div>
              <form action="employee_insert_sql.php" method="post" enctype="multipart/form-data">
               
              

                    <div class="form-group row">
                      
                    
                      <div class="col-sm">
                        <label class="col-form-label">ชื่อ:</label>
                        <input type="text" class="form-control" id="firstname" name="firstname">
                      </div>
                      <div class="col-sm">
                        <label class="col-form-label">นามสกุล:</label>
                        <input type="text" class="form-control" id="lastname" name="lastname">
                      </div>
                    </div>
                    <div class="form-group row">
                      <div class="col-sm">
                        <label class="col-form-label">เบอร์โทรศัพท์:</label>
                        <input type="text" class="form-control" id="phonenumber" name="phonenumber">
                      </div>
                      <div class="col-sm">
                        <label class="col-form-label">รูปของรถ:</label>
                        <input type="file" class="form-control" id="imgInput" name="img">
                      </div>
                    </div>
                   
                    <button type="submit" name="emsubmit" class="btn btn-success btn-block">บันทึก</button>
                  <br>
                   
                   
                 
                
              </form>
            </div>
            <div class="col-sm">
              <?php
              //ติดต่อฐานข้อมูล mysql
              include('../config/connectdb.php');
              //เขียนภาษา SQL
              $sql = "SELECT * FROM employee ";
              $result = mysqli_query($conn, $sql) or die('sql ผิด');

              //สร้างตาราง
              echo "<table class='table table-success table-hover' id='table_id'>";
              echo "<thead>";
              echo "<tr>";
              echo "<th>รูปภาพ</th>";
              echo "<th>ชื่อ-นามสกุล</th>";
              echo "<th>เบอร์โทรติดต่อ</th>";
             
              echo "<th>แก้ไข</th>";
              echo "<th>ลบ</th>";
              echo "</tr>";
              echo "</thead>";
              echo "<tfoot>";
              echo "<tr class='align-text-center'>";
              echo "<th>รูปภาพ</th>";
              echo "<th>ชื่อ-นามสกุล</th>";
              echo "<th>เบอร์โทรติดต่อ</th>";
              
              echo "<th>แก้ไข</th>";
              echo "<th>ลบ</th>";
              echo "</tr>";
              echo "</tfoot>";
              echo "<tbody>";
              while ($row = mysqli_fetch_assoc($result)) {
                echo "<tr>";
                echo "<th>" . "<img class='rounded' width='150px' src='../uploads/" . $row["em_img"] . "' >" . "</th>";
                echo "<th>" . $row["em_firstname"] . " " . $row["em_lastname"] . "</th>";
                echo "<th>" . $row["em_phone"] . "</th>";
                
                echo "<th><button style='font-size:20px' class='btn btn-warning' name='edit' value='Edit' id='" . $row["em_id"] . "'>Edit</i></button></th>";
                echo "<th><input style='font-size:20px' type ='button' class='btn btn-danger' name='delete' value='Delete' id='" . $row["em_id"] . "'></th>";
                echo "</tr>";
              }
              echo "</tbody>";
              echo "</table>";
              mysqli_close($conn);
              ?>
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


  <!-- UsersUpDate Modal-->
  <div class="modal fade" id="UpEmModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered " role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">ข้อมูลพนักงาน(แก้ไข)</h5>
          <button class="close" type="button" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <div class="modal-body">
          <div class="container-fluid">
            <div class="row">
              <div class="col-sm-12">
                <form method="post" id="UpDEm" name="UpDEm" class="form-group">
                  <div class="form-group">
                    <label>ชื่อพนักงาน</label>
                    <input type="text" name="em_name_UpD" id="em_name_UpD" class="form-control" placeholder="กรอกชื่อ">
                  </div>
                  <div class="form-group">
                    <label>นามสกุล</label>
                    <input type="text" name="em_surname_UpD" id="em_surname_UpD" class="form-control" placeholder="กรอกนามสกุล">
                  </div>
                  <div class="form-group">
                    <label>เบอร์ติดต่อ</label>
                    <input type="text" name="em_phone_UpD" id="em_phone_UpD" class="form-control" placeholder="กรอกเบอร์ติดต่อ">
                  </div>
                  <input type="hidden" name="users_id_UpD" id="users_id_UpD" class="form-control">
                  <input type="submit" value="บันทึก" class="btn btn-primary" id="bsubmit">
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
  <!--End of UsersUpDate Modal-->



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
          <form class="form-group" method="post" name="delem" id="delem">
            <div class="form-group">
              <label>ชื่อ</label>
              <input type="text" name="em_name_del" id="em_name_del" class="form-control" readonly>
            </div>
            <div class="form-group">
              <label>นามสกุล</label>
              <input type="text" name="em_lastname_del" id="em_lastname_del" class="form-control" readonly>
            </div>

            <div class="form-group">
              <label>เบอร์โทรศัพท์</label>
              <input type="text" name="em_phone_del" id="em_phone_del" class="form-control" readonly>
            </div>
            <input type="submit" value="ลบ" class="btn btn-danger" id="insert">
            <input type="hidden" id="em_id_del" name="em_id_del">
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


    //-------------คลิกปุ่มแก้ไขข้อมูลที่รายการ------------\\
    $(document).on("click", "button[name='edit']", function() {
      var uid = $(this).attr("id");
      $.ajax({
        url: "employee_fetch.php",
        method: "post",
        data: {
          id: uid
        },
        dataType: "json",
        success: function(data) {
          $('#id').val(data.em_id);
          $('#em_name_UpD').val(data.em_firstname);
          $('#em_surname_UpD').val(data.em_lastname);
          $('#em_phone_UpD').val(data.em_phone);
          $('#UpEmModal').modal('show');
        }
      });
    });
    //-------------คลิกปุ่มแก้ไขข้อมูลที่รายการ------------\\

    //-------------คลิกปุ่มแก้ไขในฟอร์มแก้ไข------------\\

    $('#UpDEm').on('submit', function(e) {
      var form = $('#UpDEm')[0];
      var formData = new FormData(form);
      e.preventDefault();
      $.ajax({
        url: "em_update_sql.php",
        type: "POST",
        processData: false,
        contentType: false,
        data: formData,
        beforeSend: function() {},
        success: function(data) {
          alert(data);
          $('#UpDEm')[0].reset();
          $('#UpEmModal').modal('hide');
          location.reload();
        }
      });
    });
    //-------------คลิกปุ่มแก้ไขในฟอร์มแก้ไข------------\\		


    //-------------คลิกปุ่มลบข้อมูลที่รายการ------------\\

    $(document).on("click", "input[name='delete']", function() {
      var uid = $(this).attr("id");
      $.ajax({
        url: "employee_fetch.php",
        method: "post",
        data: {
          id: uid
        },
        dataType: "json",
        success: function(data) {
          $('#em_id_del').val(data.em_id);
          $('#em_name_del').val(data.em_firstname);
          $('#em_lastname_del').val(data.em_lastname);
          $('#em_phone_del').val(data.em_phone);
          $('#deleteModal').modal('show');
        }
      });
    });
    //-------------คลิกปุ่มลบข้อมูลที่รายการ------------\\


    //-------------คลิกปุ่มลบในฟอร์มลบ------------\\
    $('#delem').on('submit', function(e) {
      var form = $('#delem')[0];
      var formData = new FormData(form);
      e.preventDefault();
      $.ajax({
        url: "employee_del_sql.php",
        type: "POST",
        processData: false,
        contentType: false,
        data: formData,
        beforeSend: function() {},
        success: function(data) {
          alert(data);
          $('#delem')[0].reset();
          $('#deleteModal').modal('hide');
          location.reload();
        }
      });
    });
    //-------------คลิกปุ่มลบในฟอร์มลบ------------\\
  </script>

</body>

</html>