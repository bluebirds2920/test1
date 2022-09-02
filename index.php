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
                    <li class="nav-item mx-0 mx-lg-1"><a class="nav-link py-3 px-0 px-lg-3 rounded" href="#portfolio">ข้อมูลรถ</a></li>
                    <li class="nav-item mx-0 mx-lg-1"><a class="nav-link py-3 px-0 px-lg-3 rounded" href="#Contact">ข้อมูลพนักงาน</a></li>
                    <li class="nav-item mx-0 mx-lg-1"><a class="nav-link py-3 px-0 px-lg-3 rounded" href="questional.php">สอบถามเรา</a></li>
                    <li class="nav-item mx-0 mx-lg-1"><a class="nav-link py-3 px-0 px-lg-3 rounded" href="#registers">สมัครสมาชิก</a></li>
                    <li class="nav-item mx-0 mx-lg-1"><a class="btn py-3 px-0 px-lg-3 rounded btn-outline-light" data-bs-toggle="modal" data-bs-target="#loginModal">เข้าสู่ระบบ</a></li>
                </ul>
            </div>
        </div>
    </nav>
    <!-- Masthead-->
    <header class="masthead bg-primary text-white text-center">
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
        <div class="container d-flex align-items-center flex-column">
            <!-- Masthead Avatar Image-->
            <img class="masthead-avatar mb-5" src="assets/img/cranelogo.svg" alt="..." />
            <!-- Masthead Heading-->
            <h1 class="masthead-heading text-uppercase mb-0">บริการให้เช่ารถเครน รถบรรทุกติดเครน</h1>
            <br>
            <h1 class="masthead-heading text-uppercase mb-0">พร้อมให้บริการทั่วประเทศ</h1>
            <!-- Icon Divider-->
            <div class="divider-custom divider-light">
                <div class="divider-custom-line"></div>
                <div class="divider-custom-icon"><i class="fas fa-snowplow text-warning"></i></div>
                <div class="divider-custom-line"></div>
            </div>
            <!-- Masthead Subheading-->


        </div>
    </header>




    <!-- Portfolio Section-->
    <section class="page-section portfolio" id="portfolio">
        <div class="container">
            <!-- Portfolio Section Heading-->
            <h2 class="page-section-heading text-center text-uppercase text-secondary mb-0">รถเครน</h2>
            <!-- Icon Divider-->
            <div class="divider-custom">
                <div class="divider-custom-line"></div>
                <div class="divider-custom-icon"><i class="fas fa-star"></i></div>
                <div class="divider-custom-line"></div>
            </div>
            <!-- Portfolio Grid Items-->
            <div class="row justify-content-center">



                <?php

                $sql = "SELECT * FROM crane ";
                $result = mysqli_query($conn, $sql) or die('sql ผิด');

                while ($row = mysqli_fetch_assoc($result)) { ?>

                    <!-- Portfolio Item 1-->
                    <div class="col-md-6 col-lg-4 mb-5">
                        <div class="portfolio-item mx-auto" data-bs-toggle="modal" data-bs-target="#portfolioModal<?php echo $row["c_id"] ?>">
                            <div class="portfolio-item-caption d-flex align-items-center justify-content-center h-100 w-100">
                                <div class="portfolio-item-caption-content text-center text-white"><i class="fas fa-plus fa-3x"></i></div>
                            </div>
                            <?php echo  "<img class='img-fluid' src='uploads/" . $row["c_img"] . "'  alt='...' >" ?>

                        </div>
                    </div>


                <?php  }

                ?>
            </div>
        </div>
    </section>


    <!-- Contact Section-->
    <section class="page-section portfolio bg-dark text-white mb-0" id="Contact">
        <div class="container">
            <!-- About Section Heading-->
            <h2 class="page-section-heading text-center text-uppercase text-white">พนักงาน</h2>
            <!-- Icon Divider-->
            <div class="divider-custom divider-light">
                <div class="divider-custom-line"></div>
                <div class="divider-custom-icon"><i class="fas fa-star"></i><i class="fas fa-star"></i></div>
                <div class="divider-custom-line"></div>
            </div>
            <!-- About Section Content-->

            <div class="row justify-content-center">



                <?php

                $sql2 = "SELECT * FROM employee ";
                $result2 = mysqli_query($conn, $sql2) or die('sql ผิด');

                while ($row2 = mysqli_fetch_assoc($result2)) { ?>
                    <!-- Portfolio Item 1-->
                    <div class="col-md-6 col-lg-4 mb-5">
                        <div class="portfolio-item mx-auto" data-bs-toggle="modal" data-bs-target="#portfolioModal2<?php echo $row2["em_id"] ?>">
                            <div class="portfolio-item-caption d-flex align-items-center justify-content-center h-100 w-100">
                                <div class="portfolio-item-caption-content text-center text-white"><i class="fas fa-plus fa-3x"></i></div>
                            </div>
                            <?php echo  "<img class='img-fluid' src='uploads/" . $row2["em_img"] . "'  alt='...' >" ?>

                        </div>
                    </div>
                <?php  }
                ?>
            </div>
        </div>
    </section>



    <!-- Register Section-->
    <section class="page-section" id="registers">
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

    <!-- About Section-->
    <section class="page-section bg-secondary text-white mb-0" id="whyus">
        <div class="container">
            <!-- About Section Heading-->
            <h2 class="page-section-heading text-center text-uppercase text-white">ทำไมต้อง ปรีชาเครน ?</h2>
            <!-- Icon Divider-->
            <div class="divider-custom divider-light">
                <div class="divider-custom-line"></div>
                <div class="divider-custom-icon"><i class="fas fa-star"></i></div>
                <div class="divider-custom-line"></div>
            </div>
            <!-- About Section Content-->
            <div class="row">
                <div class="col-lg-6 ms-auto">
                    <h1 class="  text-white">การบริการ</h1>
                    <p class="lead">การบริการด้วยความรวดเร็ว มีประสิทธิภาพ และสามารถแก้ไขปัญหางานเฉพาะหน้าได้เป็นอย่างดี</p>
                </div>
                <div class="col-lg-6 me-auto">
                    <h1 class="  text-white">ราคาเป็นมิตร</h1>
                    <p class="lead">การมอบประสบการณ์ที่ดีให้กับลูกค้า และราคาที่เป็นกันเองเพื่อให้ลูกค้าได้ผลประโยชน์ที่สูงสุด</p>
                </div>
            </div>
            <br><br>
            <div class="row">
                <div class="col-lg-6 ms-auto">
                    <h1 class="  text-white">การบำรุงรักษา</h1>
                    <p class="lead">รถเครนทุกคันของเราได้ตรวจเช็คสภาพรถก่อนออกใช้งานและหลังใช้งานเป็นอย่างดีทุกครั้งด้วยทีมช่างที่มีคุณภาพและมีความปลอดภัยสูง</p>
                </div>
                <div class="col-lg-6 me-auto">
                    <h1 class="  text-white">ประสบการณ์</h1>
                    <p class="lead">ด้วยประสบการณ์การทำงานกว่า 7 ปี ทำให้ลูกค้ามั่นใจได้ว่า ปรีชาเครน พร้อมให้บริการคุณได้ สะดวก รวดเร็ว ปลอดภัย ตรงตามงานที่คุณต้องการ </p>
                </div>
            </div>
            <!-- About Section Button-->

        </div>
    </section>







    <!-- About Section-->
    <section class="page-section bg-warning text-dark mb-0" id="whyus">
        <div class="container">
            <!-- About Section Heading-->
            <h2 class="page-section-heading text-center text-uppercase text-dark">การประเมินจากผู้ใช้บริการ</h2>
            <!-- Icon Divider-->
            <div class="divider-custom divider-dark">
                <div class="divider-custom-line"></div>
                <div class="divider-custom-icon"><i class="fas fa-star"></i> &nbsp;<i class="fas fa-star"></i>&nbsp; <i class="fas fa-star"></i>&nbsp; <i class="fas fa-star"></i>&nbsp; <i class="fas fa-star"></i></div>
                <div class="divider-custom-line"></div>
            </div>

            <!-- About Section Content-->


            <div class="card-body ">
                <br>
                <?php
                $sqlrating = "SELECT rating.*,rcpt.*,rental.*,users.* FROM rating LEFT JOIN rcpt ON rating.rcpt_id=rcpt.rcpt_id LEFT JOIN rental ON rcpt.r_id=rental.r_id LEFT JOIN users ON rental.users_id=users.users_id ORDER BY rating.rating_id  DESC ";
                $resultrating = mysqli_query($conn, $sqlrating) or die('sql ผิด'); ?>
                <div class="row">
                    <?php


                    while ($rowrating = mysqli_fetch_assoc($resultrating)) {

                        $rt = $rowrating["rating_id"];
                        $xcounting[] = $rt;
                        $cxcounting = count($xcounting);

                        $stars = $rowrating["rating_num"];
                        $detailsrating = $rowrating["rating_details"];
                        if ($cxcounting == 5) {
                            break;
                        }
                    ?>

                        <div class="col-md-6 col-lg-6 mb-5">
                            <div class="card bg-secondary">
                                <div class="card-header bg-info py-3">
                                    <span class="m-0 font-weight-bold text-dark h3">คุณ <span class="text-dark"><?php echo $rowrating["fullname"] ?> </span></span>
                                    &nbsp;&nbsp;
                                    <?php

                                    for ($x = 1; $stars >= $x; $x++) { ?>

                                        <i class="fas fa-star text-warning" style='font-size:24px'></i>&nbsp;
                                    <?php

                                    }
                                    for ($x; $x <= 5; $x++) { ?>

                                        <i class="fas fa-star text-light" style='font-size:24px'></i>&nbsp;
                                    <?php

                                    } ?>
                                </div>

                                <div class="card-footer bg-secondary text-white text-left mb-4">

                                    <br>


                                    <h3>&nbsp;&nbsp;&nbsp;<?php echo $detailsrating ?></h3>


                                </div>
                            </div>
                        </div>
                    <?php  }  ?>


                </div>
            </div>



        </div>
    </section>



    <!-- Copyright Section-->
    <div class="copyright py-4 text-center text-white">
        <div class="row">
            <div class="col-lg-5 mb-5 mb-lg-0">

                <p class="lead mb-0">

                    444/25 ม.9 ต.สุรนารี
                    อ.เมือง จ.นครราชสีมา 30000

                </p>
            </div>


            <div class="col-lg-3 mb-5 mb-lg-4"><small>Copyright &copy; Preecha Crane Rental 2015</small></div>
            <div class="col-lg-4 mb-5 mb-lg-0">
            <p class="lead mb-0">



                <a class="btn btn-outline-light btn-social " href="https://www.facebook.com/Preechacranekorat2"><i class="fab fa-fw fa-facebook-f"></i></a>
                &nbsp; 085-9281308 , 097-3287508 &nbsp;
                </p>
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

    <?php

    $sql3 = "SELECT * FROM crane ";
    $result3 = mysqli_query($conn, $sql3) or die('sql ผิด');

    while ($row3 = mysqli_fetch_assoc($result3)) { ?>




        <!-- Portfolio Modals-->
        <!-- Portfolio Modal 1-->
        <div class="portfolio-modal modal fade" id="portfolioModal<?php echo $row3["c_id"] ?>" tabindex="-1" aria-labelledby="portfolioModal1" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header border-0"><button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"></button></div>
                    <div class="modal-body text-center pb-5">
                        <div class="container">
                            <div class="row justify-content-center">
                                <div class="col-lg-8">
                                    <!-- Portfolio Modal - Title-->
                                    <h2 class="portfolio-modal-title text-secondary text-uppercase mb-0"><?php echo $row3["c_name"] ?></h2>
                                    <!-- Icon Divider-->
                                    <div class="divider-custom">
                                        <div class="divider-custom-line"></div>
                                        <div class="divider-custom-icon"><i class="fas fa-star"></i></div>
                                        <div class="divider-custom-line"></div>
                                    </div>
                                    <!-- Portfolio Modal - Image-->
                                    <?php echo  "<img class='img-fluid rounded mb-5' src='uploads/" . $row3["c_img"] . "'  alt='...' >" ?>

                                    <!-- Portfolio Modal - Text-->
                                    <p class="mb-4"><?php echo $row3["c_details"] ?></p>
                                    <button class="btn btn-primary" data-bs-dismiss="modal">
                                        <i class="fas fa-xmark fa-fw"></i>
                                        Close Window
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>


    <?php  }

    ?>
    <?php

    $sql4 = "SELECT * FROM employee ";
    $result4 = mysqli_query($conn, $sql4) or die('sql ผิด');

    while ($row4 = mysqli_fetch_assoc($result4)) { ?>




        <!-- Portfolio Modals-->
        <!-- Portfolio Modal 1-->
        <div class="portfolio-modal modal fade" id="portfolioModal2<?php echo $row4["em_id"] ?>" tabindex="-1" aria-labelledby="portfolioModal1" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header border-0"><button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"></button></div>
                    <div class="modal-body text-center pb-5">
                        <div class="container">
                            <div class="row justify-content-center">
                                <div class="col-lg-8">
                                    <!-- Portfolio Modal - Title-->
                                    <h2 class="portfolio-modal-title text-secondary text-uppercase mb-0"><?php echo $row4["em_firstname"] . " " . $row4["em_lastname"] ?></h2>
                                    <!-- Icon Divider-->
                                    <div class="divider-custom">
                                        <div class="divider-custom-line"></div>
                                        <div class="divider-custom-icon"><i class="fas fa-star"></i></div>
                                        <div class="divider-custom-line"></div>
                                    </div>
                                    <!-- Portfolio Modal - Image-->
                                    <?php echo  "<img class='img-fluid rounded mb-5' src='uploads/" . $row4["em_img"] . "'  alt='...' >" ?>

                                    <!-- Portfolio Modal - Text-->
                                    <h3>เบอร์ติดต่อ</h3>
                                    <p class="mb-4"><?php echo $row4["em_phone"] ?></p>
                                    <button class="btn btn-primary" data-bs-dismiss="modal">
                                        <i class="fas fa-xmark fa-fw"></i>
                                        Close Window
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>


    <?php  }

    ?>


    <!-- Bootstrap core JS-->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    <!-- Core theme JS-->
    <script src="js/scripts.js"></script>
    <!-- * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *-->
    <!-- * *                               SB Forms JS                               * *-->
    <!-- * * Activate your form at https://startbootstrap.com/solution/contact-forms * *-->
    <!-- * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *-->
    <script src="https://cdn.startbootstrap.com/sb-forms-latest.js"></script>
</body>

</html>