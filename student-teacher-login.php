<?php
require_once "config.php";

if (isset($_POST["login_btn"])) {

    $username = mysqli_real_escape_string($conn, $_POST["login_username"]);
    $password =  mysqli_real_escape_string($conn, $_POST["login_password"]);

    if (empty(trim($username)) || empty(trim($password))) {
        header("location:" . $root . "/login.php?res=0"); // empty
    } else {
        $password = md5($password);
        $sql = "SELECT * FROM users WHERE user_password = '$password' AND username = '$username'";

        $result = $conn->query($sql);

        if ($result->num_rows == 1) {
            $user = $result->fetch_array();

            // session for valid user 
            session_start();
            $_SESSION["username"] = $user["firstname"];
            $_SESSION["user_role"] = $user["user_role"];
            $_SESSION["user_id"] = $user["user_id"];

            if ($user["user_role"] == "1") {
                header("location:" . $root . "/teacher/index.php"); // teacher
            }
            if ($user["user_role"] == "0") {
                header("location:" . $root . "/student/index.php"); // student
            }
        } else {
            header("location:" . $root . "/login.php?res=-1"); /// missmatch
        }
    }
}
