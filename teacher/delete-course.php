<?php
require_once "config.php";
session_start();
if ($_SESSION["user_role"] != "1" || $_SESSION["username"] == null) {
    header("location:" . $root . "/login.php");
}


if(isset($_GET['id'])){
    $course_id = $_GET['id'];
    $teacher_id = $_SESSION['user_id']; //teacher id 

    $sql = "DELETE FROM courses WHERE course_id = '$course_id' AND teacher_id = '$teacher_id'";
    
    if($conn->query($sql)){
        header("location:".$root."/teacher/courses.php?d_res=1");
    }else{
        header("location:".$root."/teacher/courses.php?d_res=0");
    }

}else{
    die("page not found");
}
