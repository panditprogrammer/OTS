<?php
require_once "config.php";
session_start();
if ($_SESSION["user_role"] != "1" || $_SESSION["username"] == null) {
    header("location:" . $root . "/login.php");
}

if (isset($_GET['id']))
    $last_insert_id = $_GET['id'];
else
    header("location:" . $root . "/teacher/add-new-course.php");

?>
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Upload Course thumbnail- <?php echo $site_name; ?></title>

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
                                    <div class="text-center">
                                        <h1 class="h4 text-gray-900 mb-4">Upload your Course thumbnail</h1>
                                    </div>
                                    <hr class="hr">

                                    <!-- upload thumb of course  -->
                                    <h4>Course :</h4>
                                    <form enctype="multipart/form-data" id="thumb_form">
                                        <div id="thumb_msg" class="py-2 text-center"></div>
                                        <div class="row">
                                            <div class="col-6">
                                                <label for="c_thumbnail">Course Thumbnails (340 X 160)</label>
                                                <input type="file" accept="image/*" class="form-control" name="c_thumbnail" id="c_thumbnail">
                                                <input type="hidden" name="new_course_id" id="new_course_id" value="<?php echo $last_insert_id; ?>">
                                            </div>
                                            <div class="col-6 d-flex justify-content-center align-items-end">
                                                <button type="submit" id="upload_thumb_btn" class="btn-sm btn-primary rounded-pill mt-4">Upload</button>
                                            </div>
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

            <script>
                $(document).ready(function() {

                    // course thubmnail upload 
                    $("#thumb_form").submit(function(e) {
                        e.preventDefault();
                        $.ajax({
                            url: "course-thumb-save.php",
                            type: "POST",
                            contentType: false,
                            processData: false,
                            cache: false,
                            data: new FormData(this),
                            success: function(response) {
                                if (response === '1') {
                                    console.log(response);
                                    location.href = "add-new-course.php";
                                }
                                $("#thumb_msg").html(response);
                            }
                        });
                    });

                });
            </script>