<?php

require_once "config.php";

$firstname = $_POST["firstname"];
$lastname = $_POST["lastname"];
$username = $_POST["username"];
$password = $_POST["password"];
$repeat_password = $_POST["repeat_password"];
$userType = $_POST["userType"];


if (empty($firstname) || empty($lastname) || empty($username) || empty($password)) {
    echo "1"; // filed empty found
    return;
}

if ($password != $repeat_password) {
    echo "2"; // password missmatch
    return;
} else {
    $password = md5($repeat_password);
}



$check_username = "SELECT * FROM users WHERE username = '$username' AND user_password = '$password'";
$usernameExist = $conn->query($check_username);

if ($usernameExist->num_rows > 0) {
    echo "3"; // username already used
    return;
}

$check_username = "SELECT username FROM users WHERE username = '$username'";
$usernameExist = $conn->query($check_username);

if ($usernameExist->num_rows > 0) {
    echo "3"; // username already used
    return;
}
$sql = "INSERT INTO users (firstname, lastname, username, user_password, user_role) VALUES ('$firstname','$lastname','$username','$password','$userType')";


if ($conn->query($sql)) {
    echo "4"; // registration success
} else {
    echo "Unable to Register! Please Try again after some time.";
}
