<?php
require_once "config.php";
$file = $_FILES['c_thumbnail'];
$course_id = $_POST['new_course_id'];

$img_file_name = $file['name'];
$img_file_type = $file['type'];
$img_file_tmp_name = $file['tmp_name'];
$img_file_size = $file['size'];

// $previous_thumbnail_name =  $_POST['previous_thumbnail'];
// $previous_thumbnail_path = "res/course-thumbnails/" .$previous_thumbnail_name;

if ($file['error'] == 0 && $img_file_name != "") {

    $source_file = $img_file_tmp_name;

    $final_file = time() . "-" . $img_file_name;
    $final_file_destination = "res/course-thumbnails/" . $final_file;

    if (move_uploaded_file($source_file, $final_file_destination)) {
        session_start();
        $sql = "UPDATE courses SET c_thumbnail = '$final_file' WHERE course_id = '$course_id'";
        if ($conn->query($sql)) {
            echo '1';
            // if ($previous_thumbnail_name != "") {
            //     unlink($previous_thumbnail_path); // delete previous image 
            // }
        } else {
            echo '<p class="text-danger">Upload Failed!</p>';
        }
    } else {
        echo '<p class="text-danger">Unable to upload!</p>';
    }
} else {
    echo '<p class="text-danger">Invalid file type!</p>';
}
