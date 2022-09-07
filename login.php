<?php
require_once "config.php";
?>


<script>
    if (sessionStorage.getItem("username") !== null) {
        location.assign("<?php echo $root; ?>/index.php");
    }
</script>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Login</title>

    <!-- Custom fonts for this template-->
    <link href="admin/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="admin/css/sb-admin-2.min.css" rel="stylesheet">

</head>

<body class="bg-gradient-primary">

    <div class="container">

        <!-- Outer Row -->
        <div class="row justify-content-center">

            <div class="col-xl-10 col-lg-12 col-md-9">

                <div class="card o-hidden border-0 shadow-lg my-5">
                    <div class="card-body p-0">
                        <!-- Nested Row within Card Body -->
                        <div class="row">
                            <div class="col-lg-6 d-none d-lg-block bg-login-image"></div>
                            <div class="col-lg-6">
                                <div class="p-5">
                                    <div class="text-center">
                                        <h1 class="h4 text-gray-900 mb-4">Welcome Back!</h1>
                                    </div>

                                    <div id="success_reg_msg" class="text-center text-success">
                                        <p>You have Successfully Registered, Login with your Credentials!</p>
                                    </div>
                                    <form class="user" id="login_form">
                                        <div class="form-group">
                                            <input type="email" class="form-control form-control-user" id="login_email" aria-describedby="emailHelp" placeholder="Enter Email Address...">
                                        </div>
                                        <div class="form-group">
                                            <input type="password" class="form-control form-control-user" id="login_password" placeholder="Password">
                                        </div>
                                        <div class="form-group">
                                            <div class="custom-control custom-checkbox small">
                                                <input type="checkbox" class="custom-control-input" id="loginAsTeacher">
                                                <label class="custom-control-label" for="loginAsTeacher">Login as Teacher
                                                </label>
                                            </div>
                                        </div>
                                        <button id="login_submit" class="btn btn-primary btn-user btn-block">
                                            Login
                                        </button>
                                        <hr>
                                        <a href="index.php" class="btn btn-google btn-user btn-block">
                                            <i class="fab fa-google fa-fw"></i> Login with Google
                                        </a>
                                        <a href="index.php" class="btn btn-facebook btn-user btn-block">
                                            <i class="fab fa-facebook-f fa-fw"></i> Login with Facebook
                                        </a>
                                    </form>
                                    <hr>
                                    <div class="text-center">
                                        <a class="small" href="forgot-password.php">Forgot Password?</a>
                                    </div>
                                    <div class="text-center">
                                        <a class="small" href="registration.php">Create an Account!</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

        </div>

    </div>

    <!-- Bootstrap core JavaScript-->
    <script src="admin/vendor/jquery/jquery.min.js"></script>
    <script src="admin/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="admin/vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="admin/js/sb-admin-2.min.js"></script>

    <script>
        var url = new URL(location.href);
        var query = url.searchParams.get("registered");
        if (query === "true") {
            $("#success_reg_msg").show(500);
        } else {
            $("#success_reg_msg").hide();
        }

        // login submit 
        $("#login_submit").click(function(e) {
            e.preventDefault();
            let login_email = $("#login_email").val();
            let login_password = $("#login_password").val();
            let loginAsTeacher = $("#loginAsTeacher").is(":checked");

            let login_data = {
                login_email: login_email,
                login_password: login_password,
                loginAsTeacher: loginAsTeacher
            }

            $.ajax({
                url: "student-teacher-login.php",
                type: "POST",
                data: login_data,
                success: function(response) {
                    console.log(response);
                    if (response === "-1") {
                        $("#success_reg_msg").html("<p>Please fill required fields</p>").show(500).addClass("text-danger");
                    }
                    if (response === "0") {
                        $("#success_reg_msg").html("<p>Email or Password is incorrect!</p>").show(500).addClass("text-danger");;
                    }
                    // get the teacher or student username 
                    let response_arr = response.split("&");
                    let login_res_code = response_arr[0];
                    let login_res_user = response_arr[1];

                    if (login_res_code === "1") {
                        $("#success_reg_msg").html("<p>Logged In As Student!</p>").show(500);
                        $(location).prop('href', "<?php echo $root; ?>/index.php");
                        sessionStorage.setItem("username", login_res_user);
                    }
                    if (login_res_code === "2") {
                        $("#success_reg_msg").html("<p> Logged In As Teacher!</p>").show(500);
                        $(location).prop('href', "<?php echo $root; ?>/admin/index.php?user=" + login_res_user);
                        sessionStorage.setItem("username", login_res_user);
                    }
                }
            });
            setTimeout(() => {
                $("#success_reg_msg").hide(500).removeClass("text-danger");
            }, 5000);
        });
    </script>

</body>

</html>