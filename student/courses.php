<?php
require_once "config.php";
session_start();
if ($_SESSION["user_role"] != "0" || $_SESSION["username"] == null) {
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

    <title>profile - <?php echo $site_name; ?></title>

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
                    <h1 class="h3 mb-4 text-gray-800">Your Courses</h1>

                    <!-- Content Row -->
                    <div class="row d-flex justify-content-center">
                        <!-- Card -->
                        <div class="card border-left-primary shadow py-2 mx-2 mb-4" style="width: 25rem;">
                            <div class="card-body">
                                <img height="160px" src="<?php echo $root; ?>/admin/img/undraw_profile.svg" class="card-img-top" alt="...">
                                <div class="row no-gutters align-items-center">

                                    <div class="col mr-2">
                                        <h5 class="card-title h5 mb-0 font-weight-bold text-gray-800">Web Design</h5>

                                        <p class="card-text">Lorem ipsum dolor sit amet consectetur adipisicing elit. Dolorem!</p>
                                        <p class="text-xs font-weight-bold mb-1">Frontend Development</p>
                                        <div class="row">
                                            <div class="col-12 d-flex justify-content-between">
                                                <div class="font-weight-bold text-primary mt-1 text-uppercase">1299.00 (45% OFF)</div>
                                                <button class="btn-sm btn-primary px-4">Start</button>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                        <!-- /Card -->

                        <!-- Card -->
                        <div class="card border-left-primary shadow py-2 mx-2 mb-4" style="width: 25rem;">
                            <div class="card-body">
                                <img height="160px" src="<?php echo $root; ?>/admin/img/undraw_profile.svg" class="card-img-top" alt="...">
                                <div class="row no-gutters align-items-center">

                                    <div class="col mr-2">
                                        <h5 class="card-title h5 mb-0 font-weight-bold text-gray-800">Web Design</h5>
                                        <p class="card-text">Lorem ipsum dolor sit amet consectetur adipisicing elit. Dolorem!</p>

                                        <p class="text-xs font-weight-bold mb-1">Frontend Development</p>
                                        <div class="row">
                                            <div class="col-12 d-flex justify-content-between">
                                                <div class="font-weight-bold text-primary mt-1 text-uppercase">1299.00 (45% OFF)</div>
                                                <button class="btn-sm btn-primary px-4">Start</button>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                        <!-- /Card -->

                        <!-- Card -->
                        <div class="card border-left-primary shadow py-2 mx-2 mb-4" style="width: 25rem;">
                            <div class="card-body">
                                <img height="160px" src="<?php echo $root; ?>/admin/img/undraw_profile.svg" class="card-img-top" alt="...">
                                <div class="row no-gutters align-items-center">

                                    <div class="col mr-2">
                                        <h5 class="card-title h5 mb-0 font-weight-bold text-gray-800">Web Design</h5>
                                        <p class="card-text">Lorem ipsum dolor sit amet consectetur adipisicing elit. Dolorem!</p>

                                        <p class="text-xs font-weight-bold mb-1">Frontend Development</p>
                                        <div class="row">
                                            <div class="col-12 d-flex justify-content-between">
                                                <div class="font-weight-bold text-primary mt-1 text-uppercase">1299.00 (45% OFF)</div>
                                                <button class="btn-sm btn-primary px-4">Start</button>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                        <!-- /Card -->

                        <!-- Card -->
                        <div class="card border-left-primary shadow py-2 mx-2 mb-4" style="width: 25rem;">
                            <div class="card-body">
                                <img height="160px" src="<?php echo $root; ?>/admin/img/undraw_profile.svg" class="card-img-top" alt="...">
                                <div class="row no-gutters align-items-center">

                                    <div class="col mr-2">
                                        <h5 class="card-title h5 mb-0 font-weight-bold text-gray-800">Web Design</h5>
                                        <p class="card-text">Lorem ipsum dolor sit amet consectetur adipisicing elit. Dolorem!</p>

                                        <p class="text-xs font-weight-bold mb-1">Frontend Development</p>
                                        <div class="row">
                                            <div class="col-12 d-flex justify-content-between">
                                                <div class="font-weight-bold text-primary mt-1 text-uppercase">1299.00 (45% OFF)</div>
                                                <button class="btn-sm btn-primary px-4">Start</button>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                        <!-- /Card -->

                    </div>
                    <!-- Content Row -->


                    <!-- Page Heading -->
                    <h1 class="h3 mb-4 text-gray-800">Recommended Courses</h1>
                    <!-- Content Row -->
                    <div class="row d-flex justify-content-center">
                        <!-- Card -->
                        <div class="card border-left-primary shadow py-2 mx-2 mb-4" style="width: 25rem;">
                            <div class="card-body">
                                <img height="160px" src="<?php echo $root; ?>/admin/img/undraw_profile.svg" class="card-img-top" alt="...">
                                <div class="row no-gutters align-items-center">

                                    <div class="col mr-2">
                                        <h5 class="card-title h5 mb-0 font-weight-bold text-gray-800">Web Design</h5>

                                        <p class="card-text">Lorem ipsum dolor sit amet consectetur adipisicing elit. Dolorem!</p>
                                        <p class="text-xs font-weight-bold mb-1">Frontend Development</p>
                                        <div class="row">
                                            <div class="col-12 d-flex justify-content-between">
                                                <div class="font-weight-bold text-primary mt-1 text-uppercase">1299.00 (45% OFF)</div>
                                                <button class="btn-sm btn-primary px-4">Start</button>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                        <!-- /Card -->

                        <!-- Card -->
                        <div class="card border-left-primary shadow py-2 mx-2 mb-4" style="width: 25rem;">
                            <div class="card-body">
                                <img height="160px" src="<?php echo $root; ?>/admin/img/undraw_profile.svg" class="card-img-top" alt="...">
                                <div class="row no-gutters align-items-center">

                                    <div class="col mr-2">
                                        <h5 class="card-title h5 mb-0 font-weight-bold text-gray-800">Web Design</h5>
                                        <p class="card-text">Lorem ipsum dolor sit amet consectetur adipisicing elit. Dolorem!</p>

                                        <p class="text-xs font-weight-bold mb-1">Frontend Development</p>
                                        <div class="row">
                                            <div class="col-12 d-flex justify-content-between">
                                                <div class="font-weight-bold text-primary mt-1 text-uppercase">1299.00 (45% OFF)</div>
                                                <button class="btn-sm btn-primary px-4">Start</button>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                        <!-- /Card -->

                        <!-- Card -->
                        <div class="card border-left-primary shadow py-2 mx-2 mb-4" style="width: 25rem;">
                            <div class="card-body">
                                <img height="160px" src="<?php echo $root; ?>/admin/img/undraw_profile.svg" class="card-img-top" alt="...">
                                <div class="row no-gutters align-items-center">

                                    <div class="col mr-2">
                                        <h5 class="card-title h5 mb-0 font-weight-bold text-gray-800">Web Design</h5>
                                        <p class="card-text">Lorem ipsum dolor sit amet consectetur adipisicing elit. Dolorem!</p>

                                        <p class="text-xs font-weight-bold mb-1">Frontend Development</p>
                                        <div class="row">
                                            <div class="col-12 d-flex justify-content-between">
                                                <div class="font-weight-bold text-primary mt-1 text-uppercase">1299.00 (45% OFF)</div>
                                                <button class="btn-sm btn-primary px-4">Start</button>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                        <!-- /Card -->
                    </div>
                    <!-- Content Row -->

                </div>
                <!-- /.container-fluid -->

            </div>
            <!-- End of Main Content -->

            <?php require_once "footer.php"; ?>