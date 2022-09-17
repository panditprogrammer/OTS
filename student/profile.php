<?php
require_once "config.php";
session_start();
if ($_SESSION["user_role"] != "0" || $_SESSION["username"] == null) {
    header("location:" . $root . "/login.php");
}

$user_id = $_SESSION["user_id"];
$message = null;
if (isset($_POST["save_std_profile"])) {
    $user_fname = mysqli_real_escape_string($conn, $_POST["user_fname"]);
    $user_lname = mysqli_real_escape_string($conn, $_POST["user_lname"]);
    $user_gender = mysqli_real_escape_string($conn, $_POST["user_gender"]);
    $user_dob = mysqli_real_escape_string($conn, $_POST["user_dob"]);
    $user_email = mysqli_real_escape_string($conn, $_POST["user_email"]);
    $user_phone = mysqli_real_escape_string($conn, $_POST["user_phone"]);
    $user_address = mysqli_real_escape_string($conn, $_POST["user_address"]);


    if (empty(trim($user_fname)) || empty(trim($user_lname)) || empty(trim($user_email))) {
        $message = '<p class="text-danger">Please fill the require filed</p>';
    } else {
        $sql = "UPDATE users SET firstname = '$user_fname', lastname = '$user_lname',gender = '$user_gender', dob = '$user_dob', email = '$user_email',phone = '$user_phone', address = '$user_address' WHERE user_id = '$user_id'";

        if ($conn->query($sql)) {
            $message = '<p class="text-success">Profile Updated</p>';
        } else {
            $message = '<p class="text-danger">Unable to Update</p>';
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

    <title>Student profile - <?php echo $site_name; ?></title>

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
                    <h1 class="h3 mb-4 text-gray-800">Student Profile</h1>

                    <div class="container">
                        <!-- Nested Row within Card Body -->
                        <div class="row">
                            <div class="col-lg-12">

                                <div class="p-3">
                                    <div class="text-center my-2" id="message"><?php echo $message; ?></div>
                                    <div class="text-center">
                                        <h1 class="h4 text-gray-900 mb-4">Your Profile Details</h1>
                                    </div>

                                    <?php
                                    $sql = "SELECT * FROM users WHERE user_id = '$user_id'";
                                    $user_result = $conn->query($sql);
                                    if ($user_result->num_rows > 0) {
                                        while ($row = $user_result->fetch_assoc()) {
                                    ?>
                                            <div class="py-2 m-auto mb-0" style="width: 10rem;">
                                                <img title="click to change profile picture" height="160px" width="160px" src="<?php echo $root; ?>/student/res/<?php echo $row['profile_img']; ?>" class="card-img-top rounded-circle" style="cursor: pointer;" id="profile_img" alt="user profile">
                                                <h4 class="py-2 text-center"><?php echo $_SESSION["username"]; ?></h4>
                                            </div>
                                            <p class="text-center" id="profile_img_msg"></p>
                                            <!-- profile image upload  -->
                                            <div id="profile_wrapper">
                                                <form enctype="multipart/form-data" id="profile_form" class="form-group row d-flex justify-content-center">
                                                    <div class="col-md-2 col-sm-6 mb-3 mb-sm-0">

                                                        <input type="hidden" name="previous_profile" value="<?php echo $row["profile_img"]; ?>">

                                                        <input type="file" accept="image/*" id="profile_img_field" name="profile_img_field" class="btn-sm m-auto">
                                                    </div>
                                                    <div class="col-md-2 col-sm-6 mb-3 mb-sm-0 d-flex justify-content-center">
                                                        <button type="submit" class="btn-sm btn-primary" id="profile_upload_btn">Upload</button>
                                                    </div>
                                                </form>
                                            </div>

                                            <form class="user my-4" action="<?php echo $_SERVER["PHP_SELF"]; ?>" method="POST">
                                                <div class="form-group row">
                                                    <div class="col-sm-6 mb-3 mb-sm-0">
                                                        <label for="user_fname">First Name</label>
                                                        <input type="text" class="form-control form-control rounded-pill" name="user_fname" id="user_fname" value="<?php echo $row["firstname"]; ?>" placeholder="First Name">
                                                    </div>

                                                    <div class="col-sm-6 mb-3 mb-sm-0">
                                                        <label for="user_lname">Last Name</label>
                                                        <input type="text" class="form-control form-control rounded-pill" name="user_lname" value="<?php echo $row["lastname"]; ?>" id="user_lname" placeholder="Last Name">
                                                    </div>
                                                </div>

                                                <div class="form-group row">
                                                    <div class="col-sm-6 mb-3 mb-sm-0">
                                                        <label for="user_gender">Select Your Gender</label>
                                                        <select name="user_gender" id="user_gender" class="form-select form-control rounded-pill">
                                                            <option selected>Select Your Gender</option>
                                                            <?php
                                                            $gender = array('m' => 'Male', 'f' => 'Female', 'o' => 'Other');
                                                            foreach ($gender as $key => $value) {
                                                                if ($row['gender'] == $key) {
                                                                    $selected = "selected";
                                                                } else {
                                                                    $selected = null;
                                                                }
                                                                echo '<option ' . $selected . ' value="' . $key . '">' . $value . '</option>';
                                                            }
                                                            ?>
                                                        </select>
                                                    </div>

                                                    <div class="col-sm-6 mb-3 mb-sm-0">
                                                        <label for="user_dob">Date of Birth</label>
                                                        <input type="date" class="form-control form-control rounded-pill" name="user_dob" value="<?php echo $row["dob"]; ?>" id="user_dob" placeholder="Date Of Birth">
                                                    </div>
                                                </div>

                                                <div class="form-group row">
                                                    <div class="col-sm-6 mb-3 mb-sm-0">
                                                        <label for="user_email">Email Address</label>
                                                        <input type="email" class="form-control form-control rounded-pill" name="user_email" value="<?php echo $row["email"]; ?>" id="user_email" placeholder="Email Address">
                                                    </div>
                                                    <div class="col-sm-6 mb-3 mb-sm-0">
                                                        <label for="user_phone">Phone Number</label>
                                                        <input type="tel" class="form-control form-control rounded-pill" name="user_phone" value="<?php echo $row["phone"]; ?>" id="user_phone" placeholder="Mobile Number">
                                                    </div>
                                                </div>

                                                <div class="form-group row">
                                                    <div class="col-sm-6 mb-3 mb-sm-0">
                                                        <label for="user_address">Your Address</label>
                                                        <textarea name="user_address" class="form-control form-control rounded" id="user_address" cols="10" rows="3" placeholder="Address"><?php echo $row["address"]; ?></textarea>
                                                    </div>
                                                </div>

                                                <button class="btn btn-primary btn-user btn-inline-block" name="save_std_profile" id="save_std_profile">
                                                    Save Profile
                                                </button>

                                            </form>
                                    <?php

                                        }
                                    }
                                    ?>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
                <!-- /.container-fluid -->

            </div>
            <!-- End of Main Content -->


            <?php require_once "footer.php"; ?>

            <script>
                $(document).ready(function() {

                    //  profile img js  
                    $("#profile_wrapper").hide();
                    $("#profile_img").click(function() {
                        $("#profile_wrapper").toggle(500);
                    });

                    // profile upload 
                    $("#profile_form").submit(function(e) {
                        e.preventDefault();
                        $.ajax({
                            url: "st-profile-img-upload.php",
                            type: "POST",
                            contentType: false,
                            processData: false,
                            cache: false,
                            data: new FormData(this),
                            success: function(response) {
                                $("#profile_img_msg").text(response);
                                $("#profile_wrapper").hide();
                            }
                        });
                    });

                });
            </script>