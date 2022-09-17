<?php
require_once "config.php";
session_start();
if ($_SESSION["user_role"] != "1" || $_SESSION["username"] == null) {
    header("location:" . $root . "/login.php");
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

    <title>All Your Courses - <?php echo $site_name; ?></title>

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
                    <h1 class="h3 mb-2 text-gray-800">All Courses</h1>
                    <?php
                    $message = null;
                    if (isset($_GET['d_res']) && $_GET['d_res'] == "1") {
                        $message = '<p class="text-success">Course Deleted!</p>';
                    }

                    if (isset($_GET['d_res']) && $_GET['d_res'] == "0") {
                        $message = '<p class="text-danger">Unable to delete Course!</p>';
                    }
                    ?>
                    <div class="text-center" id="message"> <?php echo $message; ?></div>

                    <p class="mb-4">DataTables is a third party plugin that is used to generate the demo table below.
                        For more information about DataTables, please visit the <a target="_blank" href="https://datatables.net">official DataTables documentation</a>.
                    </p>

                    <!-- DataTales Example -->
                    <div class="card shadow mb-4">
                        <div class="card-header py-3 d-flex justify-content-between">
                            <h6 class="m-0 font-weight-bold text-primary">DataTables Example</h6>
                            <h6 class="m-0 font-weight-bold text-primary"><a href="<?php echo $root . "/teacher/add-new-course.php"; ?>">Add new Course</a></h6>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>Course Name</th>
                                            <th>Category</th>
                                            <th>Chapters</th>
                                            <th>Price</th>
                                            <th>Duration</th>
                                            <th>Start date</th>
                                            <th class="text-center">Manage</th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                        <?php
                                        $teacher_id = $_SESSION["user_id"];
                                        $sql = "SELECT * FROM course_categories LEFT JOIN courses ON courses.c_category = course_categories.cat_id WHERE courses.teacher_id = '$teacher_id'";
                                        $result = $conn->query($sql);

                                        if ($result->num_rows > 0) {
                                            while ($row = $result->fetch_assoc()) {

                                                $course_id =  $row["course_id"];

                                                $sql_less = "SELECT * FROM lessions WHERE fk_course_id = '$course_id'";
                                                $total_less = $conn->query($sql_less)->num_rows;

                                                echo " <tr>
                                           <td>" . $row["c_name"] . "</td>
                                           <td>" . $row["cat_name"] . "</td>
                                           <td>" . $total_less . "</td>
                                           <td>" . $row["c_fees"] . "</td>
                                           <td>" . $row["c_duration"] . "</td>
                                           <td>" . $row["c_start"] . "</td>
                                           <td class='d-flex justify-content-between'>
                                           <a href='$root/teacher/edit-course.php?id=" . $course_id . "' class='btn-sm btn-primary'>Edit</a>
                                           <a href='$root/teacher/delete-course.php?id=" . $course_id . "' class='btn-sm btn-danger'>Delete</a>                                           
                                           </td>
                                       </tr>";
                                            }
                                        }
                                        ?>

                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                </div>
                <!-- /.container-fluid -->
            </div>

            <?php require_once "footer.php"; ?>
