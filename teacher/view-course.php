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
                        <h1 class="h3 mt-4 text-gray-800">Course Details</h1>
                        <h1 class="h3 mb-4"><a class="btn-primary btn" href="<?php echo $root . "/teacher/courses.php"; ?>">All Courses</a></h1>
                    </div>
                    <hr>


                    <div class="row my-5">
                        <div class="col-lg-4 col-md-8 col-sm-12">
                            <?php
                            $course_desc = null;
                            if (isset($_GET['id'])) {
                                $course_id = $_GET["id"];
                            } else {
                                die("Page Not Found!");
                            }
                            $sql = "SELECT * FROM course_categories RIGHT JOIN courses ON courses.c_category = course_categories.cat_id WHERE course_id = '$course_id'";
                            $result = $conn->query($sql);

                            if ($result->num_rows > 0) {
                                while ($row = $result->fetch_assoc()) {
                                    $course_desc = $row['c_desc'];
                            ?>
                                    <!-- Card -->
                                    <div class="card border-left-primary shadow py-2 mb-4" style="width: 100%;">
                                        <div class="card-body">
                                            <img height="160px" src="https://cdn.pixabay.com/photo/2020/05/07/12/11/web-development-company-5141298_1280.jpg" class="card-img-top" alt="...">
                                            <div class="row no-gutters align-items-center">

                                                <div class="col mr-2">
                                                    <h4 class="card-title my-2 text-gray-800"><?php echo $row["c_name"]; ?></h4>
                                                    <p class="card-text"><?php echo substr($row['c_desc'], 0, 100); ?></p>

                                                    <h6 class="text-xs mb-1"><?php echo $row["cat_name"]; ?></h6>
                                                    <div class="d-flex justify-content-between">
                                                        <h5 class="text-primary mt-1 text-uppercase"> ₹ <?php echo $row['c_fees']; ?></h5>
                                                        <a href="view-course.php?id=<?php echo $row['course_id']; ?>" class="btn btn-primary">Start Course</a>
                                                    </div>
                                                </div>

                                            </div>
                                        </div>
                                    </div>
                                    <!-- /Card -->
                            <?php
                                }
                            }
                            ?>

                            <h3 class="h5 my-4 text-gray-800">Course Contents</h3>
                            <ul class="list-group">
                                <?php
                                $lsn_sql = "SELECT * FROM lessions WHERE fk_course_id = '$course_id'";
                                $lsn_res = $conn->query($lsn_sql);
                                if ($lsn_res->num_rows > 0) {
                                    $lsn_count = 0;
                                    while ($lsn_row = $lsn_res->fetch_assoc()) {
                                        $lsn_count++;
                                ?>
                                        <li class="list-group-item d-flex justify-content-between align-items-start">
                                            <div class="ms-2 me-auto">
                                                <div class="fw-bold">Lession #<?php echo $lsn_count; ?></div>
                                                <?php echo $lsn_row['lsn_title']; ?>
                                            </div>
                                            <span class="badge bg-dark rounded-pill">14</span>
                                        </li>
                                <?php
                                    }
                                }
                                ?>
                            </ul>
                        </div>


                        <div class="col-lg-8 col-md-6 col-sm-12">
                            <h3>Course Description</h3>
                            <p><?php echo $course_desc; ?> </p>

                            <h3>what you will learn in this course?</h3>
                            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Quaerat repellat sed commodi, delectus, qui in mollitia sint facere exercitationem deleniti odit perferendis assumenda aliquam nisi hic vitae possimus suscipit. Distinctio enim corrupti reiciendis necessitatibus repellendus autem obcaecati quisquam voluptatum alias voluptatem vero, odio nostrum aspernatur iusto tempora quae neque cupiditate consequuntur, officia optio repudiandae? Harum dolores aliquam ut debitis quidem esse pariatur aliquid et nulla quis veniam, sapiente unde rem natus illo autem alias vitae itaque. Neque sed numquam praesentium amet ullam voluptas recusandae aliquam voluptates? Sit assumenda autem reiciendis dicta, sequi nobis soluta labore repellat, nostrum ratione id modi veniam delectus ipsam tempore quisquam qui culpa rerum molestias facere deserunt!</p>
                            <a href="" class="btn btn-primary"> get course</a>
                            <a href="" class="btn btn-primary"> start course</a>
                        </div>
                    </div>
                    <!-- </div> -->


                </div>
                <!-- /container-fluid -->

            </div>
            <!-- End of Main Content -->

            <?php require_once "footer.php"; ?>