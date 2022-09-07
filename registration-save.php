<?php

require_once "config.php";

$first_name = $_POST["first_name"];
$last_name = $_POST["last_name"];
$email = $_POST["email"];
$password = $_POST["password"];
$repeat_password = $_POST["repeat_password"];
$userType = $_POST["userType"];


if (empty($first_name) || empty($last_name) || empty($email) || empty($password)) {
    echo "1"; // filed empty found
    return;
}



if ($password != $repeat_password) {
    echo "2"; // password missmatch
    return;
} else {
    $password = md5($repeat_password);
}


// check student or teacher 
if ($userType == "teacher") {
    // as Teacher 
    $check_email = "SELECT teacher_email FROM teachers WHERE teacher_email = '$email'";
    $emailExist = $conn->query($check_email);

    if ($emailExist->num_rows > 0) {
        echo "3"; // email already used
        return;
    }

    $sql = "INSERT INTO teachers (teacher_fname, teacher_lname, teacher_email, t_password) VALUES ('$first_name','$last_name','$email','$password')";
} else {
    // as Students 
    $check_email = "SELECT email FROM students WHERE email = '$email'";
    $emailExist = $conn->query($check_email);

    if ($emailExist->num_rows > 0) {
        echo "3"; // email already used
        return;
    }
    $sql = "INSERT INTO students (first_name, last_name, email, s_password) VALUES ('$first_name','$last_name','$email','$password')";
}


if ($conn->query($sql)) {
    echo "4"; // registration success
} else {
    echo "Unable to Register! Please Try again after some time.";
}
