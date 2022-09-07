<?php
require_once "config.php";

$email = $_POST["login_email"];
$password = $_POST["login_password"];
$loginAsTeacher = $_POST["loginAsTeacher"];

if (empty(trim($email)) || empty(trim($password))) {
    echo "-1";
    return;
}

$password = md5($password);

$teacher = false;
if ($loginAsTeacher == "true") {
    $teacher = true;
    $sql = "SELECT teacher_fname FROM teachers WHERE t_password = '$password' AND teacher_email = '$email'";
} else {
    $sql = "SELECT first_name FROM students WHERE s_password = '$password' AND email = '$email'";
}

$result = $conn->query($sql);

if ($result->num_rows == 1) {

    $username = $result->fetch_array()[0];

    if ($teacher)
        echo "2&$username"; // teacher
    else
        echo "1&$username"; // student 
    return;
} else {
    echo "0";
    return;
}
