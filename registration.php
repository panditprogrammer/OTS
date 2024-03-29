<?php require_once "config.php"; ?>
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title> Register - <?php echo $site_name; ?></title>

    <!-- Custom fonts for this template-->
    <link href="admin/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="admin/css/sb-admin-2.min.css" rel="stylesheet">

</head>

<body class="bg-gradient-primary">

    <div class="container">

        <div class="card o-hidden border-0 shadow-lg my-5">
            <div class="card-body p-0">
                <!-- Nested Row within Card Body -->
                <div class="row">
                    <div class="col-lg-5 d-none d-lg-block bg-register-image"></div>
                    <div class="col-lg-7">
                        <div class="p-5">
                            <div class="text-center">
                                <h1 class="h4 text-gray-900 mb-4">Create an Account!</h1>
                            </div>
                            <form class="user" id="submit_form">
                                <div class="form-group row">
                                    <div class="col-sm-6 mb-3 mb-sm-0">
                                        <input type="text" class="form-control form-control rounded-pill" id="firstname" placeholder="First Name">
                                    </div>
                                    <div class="col-sm-6">
                                        <input type="text" class="form-control form-control rounded-pill" id="lastname" placeholder="Last Name">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-sm-6 mb-3 mb-sm-0">
                                        <input type="text" class="form-control form-control rounded-pill" id="username" placeholder="username">
                                    </div>
                                    <div class="col-sm-6 mb-3 mb-sm-0">
                                        <select name="userType" id="userType" class="form-select form-control rounded-pill">
                                            <option value="0" selected>Student</option>
                                            <option value="1">Teacher</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <div class="col-sm-6 mb-3 mb-sm-0">
                                        <input type="password" class="form-control form-control rounded-pill" id="password" placeholder="Password">
                                    </div>
                                    <div class="col-sm-6">
                                        <input type="password" class="form-control form-control rounded-pill" id="repeat_password" placeholder="Repeat Password">
                                    </div>
                                </div>

                                <button class="btn btn-primary btn-user btn-block" id="register_btn">
                                    Register Account
                                </button>
                                <div class="text-center my-2" id="message"></div>

                                <hr>
                                <a href="index.html" class="btn btn-google btn-user btn-block">
                                    <i class="fab fa-google fa-fw"></i> Register with Google
                                </a>
                                <a href="index.html" class="btn btn-facebook btn-user btn-block">
                                    <i class="fab fa-facebook-f fa-fw"></i> Register with Facebook
                                </a>
                            </form>
                            <hr>
                            <div class="text-center">
                                <a class="small" href="forgot-password.php">Forgot Password?</a>
                            </div>
                            <div class="text-center">
                                <a class="small" href="login.php">Already have an account? Login!</a>
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


    <!-- JavaScript to login  -->
    <script>
        $(document).ready(function() {

            $("#register_btn").click(function(e) {
                e.preventDefault();

                let firstname = $("#firstname").val();
                let lastname = $("#lastname").val();
                let username = $("#username").val();
                let password = $("#password").val();
                let repeat_password = $("#repeat_password").val();
                let userType = $("#userType").val();

                let data = {
                    firstname: firstname,
                    lastname: lastname,
                    username: username,
                    password: password,
                    repeat_password: repeat_password,
                    userType: userType
                }

                $.ajax({
                    url: "registration-save.php",
                    type: "POST",
                    data: data,
                    success: function(response) {
                        if (response === "1") {
                            $("#message").text("Please fill all required Fields").addClass("text-danger").show(500);
                        }
                        if (response === "3") {
                            $("#message").text("Username already exist!").addClass("text-danger").show(500);
                        }
                        if (response === "2") {
                            $("#message").text("Password Missmatch!").addClass("text-danger").show(500);;
                        }
                        if (response === "4") {
                            $("#message").text("Registration Successful!").removeClass("text-danger").addClass("text-success").show(500);
                            $(location).prop('href', "<?php echo $root; ?>/login.php?registered=true");
                        }
                        setTimeout(() => {
                            $("#message").hide(500);
                        }, 5000);
                    }
                });

            });

        });
    </script>

</body>

</html>