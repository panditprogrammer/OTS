<?php
require_once "config.php";

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $site_name; ?> - FREE Online Courses (LMS in PHP & MySQL) </title>

    <link rel="stylesheet" href="style.css">

    <!-- bootstrap  -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">

    <!-- font-awesome  -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css" integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g==" crossorigin="anonymous" referrerpolicy="no-referrer" />

</head>

<body>
    <nav class="navbar navbar-expand-lg">
        <div class="container-fluid">
            <a class="navbar-brand" href="index.php">OTS</a>

            <button class="navbar-toggler" type="button" id="main_menu_toggler" data-bs-toggle="collapse" data-bs-target="#navbarTogglerDemo02" aria-controls="navbarTogglerDemo02" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="row collapse navbar-collapse" id="navbarTogglerDemo02">
                <div class="col-md-4">
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                        <li class="nav-item">
                            <a class="nav-link active" href="index.php">Home</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="course.php">Courses</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="registration.php">Registration</a>
                        </li>
                    </ul>
                </div>
                <div class="col-md-4">
                    <form class="d-flex" role="search">
                        <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
                        <button class="btn btn-outline-success" type="submit">Search</button>
                    </form>
                </div>
                <div class="col-md-4">
                    <div class="d-flex justify-content-end">
                        <span class="username" id="user_top_icon">
                            <i class="fa-solid fa-user"></i>
                            <div class="list-group list-group-flush usermenu shadow" id="user_top_menu">
                                <?php
                                session_start();

                                if (isset($_SESSION['user_role'])  ||  isset($_SESSION['user_id'])) {
                                    if ($_SESSION['user_role'] == '1') {
                                        echo '<a class="list-group-item py-3" href="' . $root . '/teacher">Dashboard</a>';
                                    }
                                    if ($_SESSION['user_role'] == '0') {
                                        echo '<a class="list-group-item py-3" href="' . $root . '/student">Dashboard</a>';
                                        echo '<a class="list-group-item py-3" href="' . $root . '/student/courses.php">Learning</a>';
                                    }

                                    echo '<a class="list-group-item py-3" href="logout.php">Logout</a>';

                                } else {
                                    echo '<a class="list-group-item py-3" href="' . $root . '/login.php">Log In</a>';

                                }
                                ?>
                            </div>
                        </span>
                    </div>
                </div>
            </div>
        </div>
    </nav>