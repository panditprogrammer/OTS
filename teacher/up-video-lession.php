<?php
require_once "config.php";
$msgPrint = array();
$file = $_FILES['lsn_vid'];
$video_file_name = $file['name'];
$video_file_type = $file['type'];
$video_file_tmp_name = $file['tmp_name'];
$video_file_size = $file['size'];


if ($file['error'] == 0 && $video_file_name != "" && $video_file_type == "video/mp4") {
    $source_file = $video_file_tmp_name;

    $final_file = time() . "-" . $video_file_name;
    $final_file_destination = "videos-lessions/" . $final_file;

    if (move_uploaded_file($source_file, $final_file_destination)) {
        array_push($msgPrint, "1&" . $final_file);
    } else {
        array_push($msgPrint, "Unable to upload!");
    }
} else {
    array_push($msgPrint, "Invalid file type!");
}

foreach ($msgPrint as $msg) {
    echo $msg;
}
