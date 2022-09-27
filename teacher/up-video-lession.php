<?php
require_once "config.php";
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
        echo "1&".$final_file;
    } else {
        echo "Unable to upload!";
    }
} else {
    echo "Invalid file type!";
}
