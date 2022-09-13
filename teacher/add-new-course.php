<?php
require_once "config.php";
session_start();
if ($_SESSION["user_role"] != "1" || $_SESSION["username"] == null) {
    header("location:" . $root . "/login.php");
}

$message = null;
// save course details 
if (isset($_POST["save_course"])) {

    $c_name = mysqli_real_escape_string($conn, $_POST["c_name"]);
    $c_categroy = mysqli_real_escape_string($conn, $_POST["c_category"]);
    $c_desc = mysqli_real_escape_string($conn, $_POST["c_desc"]);
    $c_duration = mysqli_real_escape_string($conn, $_POST["c_duration"]);
    $c_date = mysqli_real_escape_string($conn, $_POST["c_date"]);
    $c_price = mysqli_real_escape_string($conn, $_POST["c_price"]);

    $teacher_id = $_SESSION["user_id"];

    if (empty(trim($c_name)) || empty(trim($c_categroy)) || empty(trim($c_desc)) || empty(trim($c_duration)) || empty(trim($c_price))) {
        $message = '<p class="text-danger">Please fill the required fields!</p>';
    } else {

        $sql = "INSERT INTO courses (teacher_id,c_name,c_desc,c_category,c_duration,c_fees,c_start) VALUES ('$teacher_id','$c_name','$c_desc','$c_categroy','$c_duration','$c_price','$c_date')";

        if ($conn->query($sql)) {
            $message = '<p class="text-success">Saved successfully!</p>';
            // preventing resubmision form 
            unset($c_name, $c_categroy, $c_desc, $c_duration, $c_date, $c_price);
        } else {
            $message = '<p class="text-danger">Unable to save Course!</p>';
        }
    }
}

?>
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Add New Course - <?php echo $site_name; ?></title>

    <!-- Custom fonts for this template-->
    <link href="<?php echo $root; ?>/admin/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="<?php echo $root; ?>/admin/css/sb-admin-2.min.css" rel="stylesheet">

</head>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->
        <?php require_once "sidebar.php"; ?>

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <?php require_once "header.php"; ?>

                <!-- Begin Page Content -->
                <div class="container-fluid">

                    <!-- Page Heading -->
                    <div class="d-flex justify-content-between">
                        <h1 class="h3 mb-4 text-gray-800">Add New Course</h1>
                        <h1 class="h3 mb-4"><a class="btn-primary btn" href="<?php echo $root . "/teacher/courses.php"; ?>">View Courses</a></h1>
                    </div>
                    <hr>

                    <div class="container">

                        <!-- Nested Row within Card Body -->
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="p-3">
                                    <div class="text-center my-2" id="message"><?php echo $message; ?></div>

                                    <div class="text-center">
                                        <h1 class="h4 text-gray-900 mb-4">Your Course Details</h1>
                                    </div>

                                    <form class="user" action="<?php echo $_SERVER["PHP_SELF"]; ?>" method="POST">
                                        <div class="form-group row">
                                            <div class="col-sm-6 mb-3 mb-sm-0">
                                                <input type="text" class="form-control form-control rounded-pill" name="c_name" id="c_name" placeholder="Course Name">
                                            </div>
                                            <div class="col-sm-6 mb-3 mb-sm-0">
                                                <select name="c_category" id="c_category" class="form-select form-control rounded-pill">
                                                    <option value="" selected>Category</option>
                                                    <option value="frontend">Front-End</option>
                                                    <option value="backend">Back-End</option>
                                                    <option value="android">Android App</option>
                                                </select>
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <div class="col-sm-12 mb-3 mb-sm-0">
                                                <textarea class="form-control form-control rounded" name="c_desc" id="c_desc" placeholder="Course Description" rows="3"></textarea>
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <div class="col-sm-6 mb-3 mb-sm-0">
                                                <input type="text" class="form-control form-control rounded-pill" name="c_duration" id="c_duration" placeholder="Course Duration">
                                            </div>
                                            <div class="col-sm-6 mb-3 mb-sm-0">
                                                <input type="text" class="form-control form-control rounded-pill" name="c_price" id="c_price" placeholder="Course Price">
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <div class="col-sm-6 mb-3 mb-sm-0">
                                                <input type="date" class="form-control form-control rounded-pill" name="c_date" id="c_date" placeholder="Course Start Date">
                                            </div>
                                        </div>

                                        <button class="btn btn-primary btn-user btn-inline-block" name="save_course" id="save_course">
                                            Save Course
                                        </button>

                                    </form>

                                </div>
                            </div>
                        </div>
                    </div>

                </div>
                <!-- /container-fluid -->

            </div>
            <!-- End of Main Content -->

            <!-- Footer -->
            <footer class="sticky-footer bg-white">
                <div class="container my-auto">
                    <div class="copyright text-center my-auto">
                        <span>Copyright &copy; <?php echo $site_name; ?> 2021</span>
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
                    <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">x</span>
                    </button>
                </div>
                <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                    <a class="btn btn-primary" href="<?php echo $root; ?>/logout.php">Logout</a>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap core JavaScript-->
    <script src="<?php echo $root; ?>/admin/vendor/jquery/jquery.min.js"></script>
    <script src="<?php echo $root; ?>/admin/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="<?php echo $root; ?>/admin/vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="<?php echo $root; ?>/admin/js/sb-admin-2.min.js"></script>

    <!-- Page level plugins -->
    <script src="<?php echo $root; ?>/admin/vendor/chart.js/Chart.min.js"></script>

    <!-- Page level custom scripts -->
    <script src="<?php echo $root; ?>/admin/js/demo/chart-area-demo.js"></script>
    <script src="<?php echo $root; ?>/admin/js/demo/chart-pie-demo.js"></script>

</body>

</html>