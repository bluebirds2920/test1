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


          <div class="col-sm text-center">
            <span style="font-size:24px">จัดการข้อมูลสมาชิก&nbsp;</span>

          </div>
          <div class="col-sm">

            <?php

            //ติดต่อฐานข้อมูล mysql
            include('../config/connectdb.php');
            //เขียนภาษา SQL

            $sqluser = "SELECT * FROM users WHERE urole !='admin' ";
            $resultuser = mysqli_query($conn, $sqluser) or die('sql ผิด');
            //นับจำนวนข้อมูล

            //สร้างตาราง
            echo "<table class='table table-success table-hover' id='table_id'>";
            echo "<thead>";
            echo "<tr>";
            echo "<th>ดูรายละเอียด</th>";
            echo "<th>รหัสสมาชิก</th>";
            echo "<th>E-mail</th>";
            echo "<th>ชื่อสมาชิก</th>";
            echo "<th>เบอร์โทรศัพท์</th>";
            echo "<th>สถานะ</th>";
            echo "<th>อัพสถานะ</th>";
            echo "<th>ลบ</th>";

            echo "</tr>";
            echo "</thead>";
            echo "<tfoot>";
            echo "<tr class='align-text-center'>";
            echo "<th>ดูรายละเอียด</th>";
            echo "<th>รหัสสมาชิก</th>";
            echo "<th>E-mail</th>";
            echo "<th>ชื่อสมาชิก</th>";
            echo "<th>เบอร์โทรศัพท์</th>";
            echo "<th>สถานะ</th>";
            echo "<th>อัพสถานะ</th>";
            echo "<th>ลบ</th>";
            echo "</tr>";
            echo "</tfoot>";
            echo "<tbody>";
            while ($rowuser = mysqli_fetch_assoc($resultuser)) {
              echo "<tr>";
              echo "<th><a href ='details_member.php?users_id=" .  $rowuser["users_id"] . "'><button  class='btn btn-info' name='edit'  id='" . $rowuser["users_id"] . "'><i class='fas fa-eye'></i></button></a></th>";
              echo "<th>" . $rowuser["users_id"] . "</th>";
              echo "<th>" . $rowuser["email"] . "</th>";
              echo "<th>" . $rowuser["fullname"] . "</th>";
              echo "<th>" . $rowuser["phonenumber"] . "</th>";
              echo "<th>" . $rowuser["urole"] . "</th>";

              echo "<th><button  class='btn btn-warning' name='EditUser' value='Edit' id='" . $rowuser["users_id"] . "'>Edit</i></button></th>";
              echo "<th><input  type ='button' class='btn btn-outline-danger' name='delete' value='Delete' id='" . $rowuser["users_id"] . "'></th>";

              echo "</tr>";
            }
            echo "</tbody>";
            echo "</table>";
            mysqli_close($conn);
            ?>
          </div>











        </div>
        <!-- /.container-fluid -->
      </div>
      <!-- End of Main Content -->



      <!-- UpVIPModal-->
      <div class="modal fade" id="UpVIPModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
                    <form method="post" id="UpVIP" name="UpVIP" class="form-group">
                      <input type="hidden" id="id" name="id">
                      <div class="form-group">
                        <label>ชื่อสมาชิก</label>
                        <input type="text" name="fullname" id="fullname" class="form-control" readonly>
                      </div>
                      <div class="form-group">
                        <label>สถานะเดิม</label>
                        <input type="text" name="uroleold" id="uroleold" class="form-control" readonly>
                      </div>
                      <div class="form-group">
                        <label for="urole">สถานะใหม่</label>
                        <select id='urole' name='urole' class='form-control'>
                          <option value=''>---เลือกสถานะใหม่---</option>
                          <option value='VIP'>VIP</option>
                          <option value='member'>member</option>
                        </select>
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
      <!--End of UpVIPModal-->


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
          <button class="btn btn-outline-secondary" type="button" data-dismiss="modal">Cancel</button>
          <a class="btn btn-primary" href="logout.php">ออกจากระบบ</a>
        </div>
      </div>
    </div>
  </div>





  <!-- DelUser Modal-->
  <div class="modal fade" id="DelUserModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">ต้องการลบจริงหรือไม่</h5>
          <button class="close" type="button" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <div class="modal-body">
          <form class="form-group" method="post" name="DelUser" id="DelUser">
            <div class="form-group">
              <label>รหัสสมาชิก</label>
              <input type="text" name="users_id_del" id="users_id_del" class="form-control" readonly>
            </div>
            <div class="form-group">
              <label>ชื่อสมาชิก</label>
              <input type="text" name="fullname_del" id="fullname_del" class="form-control" readonly>
            </div>

            
        </div>
        <div class="modal-footer">
          <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
          <input type="submit" value="ลบ" class="btn btn-danger" id="DelUserSubmit">
          </form>
        </div>
      </div>
    </div>
  </div>
  <!--End of DelUser Modal-->





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


    //-------------คลิกปุ่มแก้ไขสถานะUser------------\\
    $(document).on("click", "button[name='EditUser']", function() {
      var uid = $(this).attr("id");
      $.ajax({
        url: "users_fetch_edit.php",
        method: "post",
        data: {
          id: uid
        },
        dataType: "json",
        success: function(data) {
          $('#id').val(data.users_id);
          $('#fullname').val(data.fullname);
          $('#uroleold').val(data.urole);
          $('#UpVIPModal').modal('show');
        }
      });
    });
    //-------------คลิกปุ่มแก้ไขสถานะUser------------\\



    //-------------คลิกปุ่มแก้ไขในฟอร์มแก้ไข------------\\

    $('#UpVIP').on('submit', function(e) {
      var form = $('#UpVIP')[0];
      var formData = new FormData(form);
      e.preventDefault();
      $.ajax({
        url: "users_update_sql.php",
        type: "POST",
        processData: false,
        contentType: false,
        data: formData,
        beforeSend: function() {},
        success: function(data) {
          alert(data);
          $('#UpVIP')[0].reset();
          $('#UpVIPModal').modal('hide');
          location.reload();
        }
      });
    });
    //-------------คลิกปุ่มแก้ไขในฟอร์มแก้ไข------------\\		





    //-------------คลิกปุ่มลบข้อมูลที่รายการ------------\\

    $(document).on("click", "input[name='delete']", function() {
      var uid = $(this).attr("id");
      $.ajax({
        url: "users_fetch_edit.php",
        method: "post",
        data: {
          id: uid
        },
        dataType: "json",
        success: function(data) {
          $('#users_id_del').val(data.users_id);
          $('#fullname_del').val(data.fullname);
          $('#DelUserModal').modal('show');
        }
      });
    });
    //-------------คลิกปุ่มลบข้อมูลที่รายการ------------\\


    //-------------คลิกปุ่มลบในฟอร์มลบ------------\\
    $('#DelUser').on('submit', function(e) {
      var form = $('#DelUser')[0];
      var formData = new FormData(form);
      e.preventDefault();
      $.ajax({
        url: "users_del_sql.php",
        type: "POST",
        processData: false,
        contentType: false,
        data: formData,
        beforeSend: function() {},
        success: function(data) {
          alert(data);
          $('#DelUser')[0].reset();
          $('#DelUserModal').modal('hide');
          location.reload();
        }
      });
    });
    //-------------คลิกปุ่มลบในฟอร์มลบ------------\\
  </script>

</body>

</html>