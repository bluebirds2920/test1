<?php
session_start();
require_once 'config/connectdb.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Crane Rental</title>

    <!-- Favicon-->
    <link rel="icon" type="image/x-icon" href="assets/favicon.ico" />
    <!-- Font Awesome icons (free version)-->
    <script src="https://use.fontawesome.com/releases/v6.1.0/js/all.js" crossorigin="anonymous"></script>
    <!-- Google fonts-->
    <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700" rel="stylesheet" type="text/css" />
    <link href="https://fonts.googleapis.com/css?family=Lato:400,700,400italic,700italic" rel="stylesheet" type="text/css" />
    <!-- Core theme CSS (includes Bootstrap)-->
    <link href="css/styles.css" rel="stylesheet" />
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.22/css/jquery.dataTables.css">

</head>

<body id="page-top">
    <!-- Navigation-->
    <nav class="navbar navbar-expand-lg bg-dark text-uppercase fixed-top" id="mainNav">
        <div class="container">
            <a class="navbar-brand" href="index.php">Preecha Crane Rental</a>
            <button class="navbar-toggler text-uppercase font-weight-bold bg-primary text-white rounded" type="button" data-bs-toggle="collapse" data-bs-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
                Menu
                <i class="fas fa-bars"></i>
            </button>
            <div class="collapse navbar-collapse" id="navbarResponsive">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item mx-0 mx-lg-1"><a class="nav-link py-3 px-0 px-lg-3 rounded" href="index.php">หน้าแรก</a></li>
                    <li class="nav-item mx-0 mx-lg-1"><a class="nav-link py-3 px-0 px-lg-3 rounded" href="#portfolio">สอบถามเรา</a></li>
                    <li class="nav-item mx-0 mx-lg-1"><a class="nav-link py-3 px-0 px-lg-3 rounded" href="#registers">สมัครสมาชิก</a></li>
                    <li class="nav-item mx-0 mx-lg-1"><a class="btn py-3 px-0 px-lg-3 rounded btn-outline-light" data-bs-toggle="modal" data-bs-target="#loginModal">เข้าสู่ระบบ</a></li>
                </ul>
            </div>
        </div>
    </nav>
    <!-- Masthead-->
    <!-- Portfolio Section-->
    <section class="masthead page-section bg-secondary portfolio" id="portfolio">
        <div class="container">
            <?php if (isset($_SESSION['error'])) { ?>
                <div class="alert alert-danger" role="alert">
                    <?php
                    echo $_SESSION['error'];
                    unset($_SESSION['error']);
                    ?>
                </div>
            <?php } ?>
            <?php if (isset($_SESSION['success'])) { ?>
                <div class="alert alert-success" role="alert">
                    <?php
                    echo $_SESSION['success'];
                    unset($_SESSION['success']);
                    ?>
                </div>
            <?php } ?>
            <?php if (isset($_SESSION['warning'])) { ?>
                <div class="alert alert-warning" role="alert">
                    <?php
                    echo $_SESSION['warning'];
                    unset($_SESSION['warning']);
                    ?>
                </div>
            <?php } ?>
            <!-- Portfolio Section Heading-->
            <h2 class="page-section-heading text-center text-uppercase text-white mb-0">คำถาม-คำตอบ</h2>
            <!-- Icon Divider-->
            <div class="divider-custom divider-light">
                <div class="divider-custom-line"></div>
                <div class="divider-custom-icon"><i class="fas fa-star"></i>&nbsp; <i class="fas fa-star"></i> &nbsp;<i class="fas fa-star"></i></div>
                <div class="divider-custom-line"></div>
            </div>
            <!-- Portfolio Grid Items-->
          
            <div class="justify-content-center">
                <div class="card shadow mb-4">
                    <div class="card-header text-center">
                       <button style="font-size:20px" class='btn btn btn-info' name='qtb'>คลิกเพื่อสอบถาม</button>
                        

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
                                             
                                                    <div class="card-header bg-warning py-3">
                                                        <h5 class="m-0 font-weight-bold text-danger"><span class="text-dark">

                                                                <i class="far fa-check-circle text-success"></i>&nbsp;คำตอบ :</span>

                                                            <?php echo $row["uqt_answer"];

                                                            ?>



                                                        </h5>

                                                    </div>
                                              
                                            <?php } else {
                                            } ?>




                                        </div>
                                    </div>
                                </div>
                            <?php  }  ?>
                            <div class="col-md-6 col-lg-12 mb-5">
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
                                        echo "<table class='table table-info table-hover' id='table_id'>";
                                        echo "<thead >";
                                        echo "<tr >";
                                        echo "<th class='text-center'>คำถาม</th>";
                                        echo "<th class='text-center'>คำตอบ</th>";

                                        echo "</tr>";
                                        echo "</thead>";
                                        echo "<tfoot>";
                                        echo "<tr class='align-text-center'>";
                                        echo "<th>คำถาม</th>";
                                        echo "<th class='text-center'>คำตอบ</th>";

                                        echo "</tr>";
                                        echo "</tfoot>";
                                        echo "<tbody>";
                                        while ($rowx = mysqli_fetch_assoc($resultx)) {
                                            echo "<tr>";
                                            echo "<th >" . $rowx["uqt_details"] . "</th>";
                                            echo "<th >" . $rowx["uqt_answer"] . "</th>";
                                            


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
        </div>
    </section>


    <!-- Register Section-->
    <section class="page-section" id="registers">
        <div class="container">
            <!-- Register Section Heading-->
            <h2 class="page-section-heading text-center text-uppercase text-secondary mb-0">สมัครสมาชิก !</h2>
            <!-- Icon Divider-->
            <div class="divider-custom">
                <div class="divider-custom-line"></div>
                <div class="divider-custom-icon"><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i></div>
                <div class="divider-custom-line"></div>
            </div>
            <!-- Register Section Form-->
            <div class="row justify-content-center">
                <div class="col-lg-8 col-xl-7">

                    <form action="register_db.php" method="post">
                        <?php if (isset($_SESSION['error'])) { ?>
                            <div class="alert alert-danger" role="alert">
                                <?php
                                echo $_SESSION['error'];
                                unset($_SESSION['error']);
                                ?>
                            </div>
                        <?php } ?>
                        <?php if (isset($_SESSION['success'])) { ?>
                            <div class="alert alert-success" role="alert">
                                <?php
                                echo $_SESSION['success'];
                                unset($_SESSION['success']);
                                ?>
                            </div>
                        <?php } ?>
                        <?php if (isset($_SESSION['warning'])) { ?>
                            <div class="alert alert-warning" role="alert">
                                <?php
                                echo $_SESSION['warning'];
                                unset($_SESSION['warning']);
                                ?>
                            </div>
                        <?php } ?>
                        <!-- Name input-->
                        <div class="form-group row">
                            <div class="col-sm-6">
                                <div class="form-floating mb-3">
                                    <input class="form-control" id="name" name="fullname" type="text" placeholder="Enter your fullname..." data-sb-validations="required" />
                                    <label for="name">Fullname</label>

                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-floating mb-3">
                                    <input class="form-control" id="phone" name="phonenumber" type="tel" placeholder="(123) 456-7890" data-sb-validations="required" />
                                    <label for="phone">Phone number</label>

                                </div>

                            </div>
                        </div>
                        <div class="form-floating mb-3">
                            <input class="form-control" id="email" type="email" name="email" placeholder="name@example.com" data-sb-validations="required,email" />
                            <label for="email">Email address</label>

                            <div class="form-group row">
                                <div class="col-sm-6">
                                    <div class="form-floating mb-3">
                                        <input class="form-control" id="name" name="password" type="password" placeholder="Enter your password..." data-sb-validations="required" />
                                        <label for="name">Password</label>

                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-floating mb-3">
                                        <input class="form-control" id="name" name="confirmpassword" type="password" placeholder="Enter your password..." data-sb-validations="required" />
                                        <label for="name">Confirm Password</label>

                                    </div>
                                </div>
                            </div>
                            <!-- Phone number input-->



                        </div>
                        <button class="btn btn-primary btn-xl btn-block" name="registers" type="submit">Register</button>


                        <!-- Submit Button-->

                    </form>
                </div>
            </div>
        </div>
    </section>







    <!-- Copyright Section-->
    <div class="copyright py-4 text-center text-white">
        <div class="row">
            <div class="col-lg-4 mb-5 mb-lg-0">

                <p class="lead mb-0">

                    2215 John Daniel Drive

                    Clark, MO 65243
                </p>
            </div>


            <div class="col-lg-4 mb-5 mb-lg-4"><small>Copyright &copy; Preecha Crane Rental 2015</small></div>
            <div class="col-lg-4 mb-5 mb-lg-0">

                <a class="btn btn-outline-light btn-social " href="https://www.facebook.com/Preechacranekorat2"><i class="fab fa-fw fa-facebook-f"></i></a>

            </div>
        </div>
    </div>


    <!-- login Modals-->
    <div class="portfolio-modal modal fade" id="loginModal" tabindex="-1" aria-labelledby="loginModal" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header border-0"><button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"></button></div>
                <div class="modal-body text-center pb-5">
                    <div class="container">
                        <div class="row justify-content-center">
                            <div class="col-lg-8">
                                <!-- Portfolio Modal - Title-->

                                <h2 class="portfolio-modal-title text-secondary text-uppercase mb-0">เข้าสู่ระบบ</h2>
                                <!-- Icon Divider-->
                                <div class="divider-custom">
                                    <div class="divider-custom-line"></div>

                                    <div class="divider-custom-icon"><i class="fas fa-star"></i></div>
                                    <div class="divider-custom-icon"><i class="fas fa-star"></i></div>
                                    <div class="divider-custom-icon"><i class="fas fa-star"></i></div>
                                    <div class="divider-custom-line"></div>
                                </div>


                                <!-- Portfolio Modal - Text-->
                                <form action="login_db.php" method="post">
                                    <!-- Name input-->
                                    <div class="form-floating mb-3">
                                        <input class="form-control" id="email" name="email" type="text" placeholder="Enter your email..." data-sb-validations="required" />
                                        <label for="name">Email</label>

                                    </div>
                                    <div class="form-floating mb-3">
                                        <input class="form-control" id="password" name="password" type="password" placeholder="Enter your password..." data-sb-validations="required" />
                                        <label for="name">Password</label>

                                    </div>

                                    <!-- Submit Button-->
                                    <button class="btn btn-success btn-xl " name="loginbutton" id="loginbutton" type="submit">เข้าสู่ระบบ</button>
                                </form>
                                <div class="divider-custom">
                                    <div class="divider-custom-line"></div>

                                    <div class="divider-custom-icon"><i class="fas fa-star"></i></div>
                                    <div class="divider-custom-icon"><i class="fas fa-star"></i></div>
                                    <div class="divider-custom-icon"><i class="fas fa-star"></i></div>
                                    <div class="divider-custom-line"></div>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- cUpDate Modal-->
    <div class="modal fade" id="questionb" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered " role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">ส่งคำถาม</h5>
                    <button class="btn-close" type="button" data-bs-dismiss="modal">

                    </button>
                </div>
                <div class="modal-body">
                    <form action="question_check.php" method="post" class="form-group">
                        <div class="form-group row">
                            <div class="col-sm-6">
                                <div class="form-floating mb-3">
                                    <input class="form-control" id="uqt_firstname" name="uqt_firstname" type="text" placeholder="Enter your fullname..." data-sb-validations="required" />
                                    <label for="name">ชื่อ</label>

                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-floating mb-3">
                                    <input class="form-control" id="uqt_lastname" name="uqt_lastname" type="tel" placeholder="(123) 456-7890" data-sb-validations="required" />
                                    <label for="phone">นามสกุล</label>

                                </div>

                            </div>
                        </div>
                        <div class="form-floating mb-3">
                            <input class="form-control" id="uqt_phone" name="uqt_phone" type="tel" placeholder="(123) 456-7890" data-sb-validations="required" />
                            <label for="phone">เบอร์โทรติดต่อ</label>

                        </div>
                        <div class="form-floating mb-3">
                            <input class="form-control" id="uqt_details" name="uqt_details" type="text" placeholder="Enter your fullname..." data-sb-validations="required" />
                            <label for="name">คำถาม</label>

                        </div>



                        <div class="d-grid">
                            <input type="hidden" name="c_id_UpD" id="c_id_UpD" class="form-control">
                            <input type="submit" value="ส่งคำถาม" class="btn btn-primary btn-block" name="userquestion" id="userquestion">
                            <input type="hidden" id="id" name="id">
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cancel</button>
                </div>
            </div>
        </div>
    </div>


    <!-- Bootstrap core JS-->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    <!-- Core theme JS-->
    <script src="js/scripts.js"></script>
    <!-- * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *-->
    <!-- * *                               SB Forms JS                               * *-->
    <!-- * * Activate your form at https://startbootstrap.com/solution/contact-forms * *-->
    <!-- * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *-->
    <script src="https://cdn.startbootstrap.com/sb-forms-latest.js"></script>
    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.js"></script>

    <script>
        $(document).ready(function() {
            $('#table_id').DataTable();
        });

        $(document).on("click", "button[name='qtb']", function() {

            $('#questionb').modal('show');
        });
    </script>

</body>

</html>