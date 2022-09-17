<?php
require_once "config.php";
session_start();
if ($_SESSION["user_role"] != "1" || $_SESSION["username"] == null) {
    header("location:" . $root . "/login.php");
}

$message = null;
$teacher_id = $_SESSION["user_id"];
// save course details 
if (isset($_POST["add_lession"])) {

    $lsn_name = mysqli_real_escape_string($conn, $_POST["lsn_name"]);
    $lsn_desc = mysqli_real_escape_string($conn, $_POST["lsn_desc"]);
    $fk_course_id = mysqli_real_escape_string($conn, $_POST["course_id"]);


    if (empty(trim($lsn_name)) || empty(trim($lsn_desc)) || empty(trim($fk_course_id))) {
        $message = '<p class="text-danger">Please fill the required fields!</p>';
    } else {

        $sql = "INSERT INTO lessions (fk_course_id, lsn_title, lsn_desc) VALUES ('$fk_course_id','$lsn_name','$lsn_desc')";

        if ($conn->query($sql)) {
            $message = '<p class="text-success">Lession added successfully!</p>';
            // preventing resubmision form 
            unset($lsn_name, $lsn_desc);
        } else {
            $message = '<p class="text-danger">Unable to add lession!</p>';
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

    <title>update Course - <?php echo $site_name; ?></title>

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
                        <h1 class="h3 mb-4 text-gray-800">Add a Lession to Course</h1>
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
                                        <h1 class="h4 text-gray-900 mb-4">Enter Your Lession Details</h1>
                                    </div>

                                    <form class="user" action="<?php echo $_SERVER["PHP_SELF"]; ?>" method="POST">
                                        <div class="form-group row">
                                            <div class="col-sm-6 mb-3 mb-sm-0">
                                                <label for="lsn_name">Lession Title</label>
                                                <input type="text" class="form-control form-control rounded-pill" name="lsn_name" placeholder="Lession title">
                                            </div>

                                            <div class="col-sm-6 mb-3 mb-sm-0">
                                                <label for="course_id">Select Your Course</label>
                                                <select name="course_id" id="course_id" class="form-select form-control rounded-pill">
                                                    <option selected>Select Course</option>
                                                    <?php
                                                    $sql = "SELECT course_id,c_name FROM courses WHERE teacher_id = '$teacher_id'";
                                                    $result = $conn->query($sql);

                                                    if ($result->num_rows > 0) {
                                                        while ($row = $result->fetch_assoc()) {
                                                            echo '<option value="' . $row['course_id'] . '">' . $row['c_name'] . '</option>';
                                                        }
                                                    }
                                                    ?>
                                                </select>
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <div class="col-sm-6 mb-3 mb-sm-0">
                                                <label for="lsn_name">Video Lecture</label>
                                                <input type="file" accept="video/*" class="form-control rounded" name="lsn_video">
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <div class="col-sm-12 mb-3 mb-sm-0">
                                                <label for="lsn_desc">Description</label>
                                                <textarea class="form-control rounded" name="lsn_desc" placeholder="Lession Description" rows="10"></textarea>
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <div class="col-sm-6 mb-3 mb-sm-0">
                                                <button class="btn btn-primary btn-user btn-inline-block" name="add_lession" id="add_lession">
                                                    Add Lession
                                                </button>
                                            </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
                <!-- /container-fluid -->

            </div>
            <!-- End of Main Content -->

            <?php require_once "footer.php"; ?>