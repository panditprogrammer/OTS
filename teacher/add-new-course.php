<?php
require_once "config.php";
session_start();
if ($_SESSION["user_role"] != "1" || $_SESSION["username"] == null) {
    header("location:" . $root . "/login.php");
}

$old_c_name = null;
$old_c_categroy = null;
$old_c_desc = null;
$old_c_duration = null;
$old_c_date = null;
$old_c_price = null;

$message = null;
$last_insert_id = null;
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

        $old_c_name = $c_name;
        $old_c_categroy = $c_categroy;
        $old_c_desc = $c_desc;
        $old_c_duration = $c_duration;
        $old_c_date = $c_date;
        $old_c_price = $c_price;
    } else {

        $sql = "INSERT INTO courses (teacher_id,c_name,c_desc,c_category,c_duration,c_fees,c_start) VALUES ('$teacher_id','$c_name','$c_desc','$c_categroy','$c_duration','$c_price','$c_date')";

        if ($conn->query($sql)) {
            $message = '<p class="text-success">Saved successfully!</p>';
            $last_insert_id =  $conn->insert_id;
            // preventing resubmission form 
            unset($c_name, $c_categroy, $c_desc, $c_duration, $c_date, $c_price);
            header("location:" . $root . "/teacher/course-thumb-upload.php?id=" . $last_insert_id);
        } else {
            $message = '<p class="text-danger">Unable to save Course!</p>';
            $old_c_name = $c_name;
            $old_c_categroy = $c_categroy;
            $old_c_desc = $c_desc;
            $old_c_duration = $c_duration;
            $old_c_date = $c_date;
            $old_c_price = $c_price;
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
                                        <h1 class="h4 text-gray-900 mb-4">Enter Your Course Details</h1>
                                    </div>

                                    <form class="user" action="<?php echo $_SERVER["PHP_SELF"]; ?>" method="POST">
                                        <div class="form-group row">
                                            <div class="col-sm-6 mb-3 mb-sm-0">
                                                <label for="c_name">Course Name </label>
                                                <input type="text" class="form-control form-control rounded-pill" name="c_name" id="c_name" value="<?php echo $old_c_name; ?>" placeholder="Course Name">
                                            </div>
                                            <div class="col-sm-6 mb-3 mb-sm-0">
                                                <label for="c_category">Course Category</label>
                                                <select name="c_category" id="c_category" class="form-select form-control rounded-pill">
                                                    <option value="" selected>Category</option>

                                                    <?php
                                                    $sql = "SELECT * FROM course_categories";
                                                    $result = $conn->query($sql);
                                                    if ($result->num_rows > 0) {
                                                        while ($row = $result->fetch_assoc()) {
                                                            if ($old_c_categroy == $row['cat_id']) {
                                                                $selected = "selected";
                                                            } else {
                                                                $selected = null;
                                                            }
                                                            echo '<option ' . $selected . ' value="' . $row['cat_id'] . '">' . $row['cat_name'] . '</option>';
                                                        }
                                                    }
                                                    ?>
                                                </select>
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <div class="col-sm-12 mb-3 mb-sm-0">
                                                <label for="c_desc">Course Description</label>
                                                <textarea class="form-control form-control rounded" name="c_desc" id="c_desc" placeholder="Course Description" rows="3"><?php echo $old_c_desc; ?></textarea>
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <div class="col-sm-6 mb-3 mb-sm-0">
                                                <label for="c_duration">Course Duration</label>
                                                <input type="text" class="form-control form-control rounded-pill" name="c_duration" id="c_duration" value="<?php echo $old_c_duration; ?>" placeholder="Course Duration">
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <div class="col-sm-6 mb-3 mb-sm-0">
                                                <label for="c_price">Course Price (INR)</label>
                                                <input type="number" min="0" class="form-control form-control rounded-pill" name="c_price" id="c_price" value="<?php echo $old_c_price; ?>" placeholder="Course Price">
                                            </div>
                                            <div class="col-sm-6 mb-3 mb-sm-0">
                                                <label for="c_date">Starting Course Date</label>
                                                <input type="date" class="form-control form-control rounded-pill" name="c_date" id="c_date" value="<?php echo $old_c_date; ?>" placeholder="Course Start Date">
                                            </div>
                                        </div>

                                        <button class="btn btn-primary btn-user btn-inline-block" name="save_course" id="save_course" type="submit">
                                            Save Course
                                        </button>

                                    </form>
                                    <hr class="hr">
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
                <!-- /container-fluid -->

            </div>
            <!-- End of Main Content -->

            <?php require_once "footer.php"; ?>