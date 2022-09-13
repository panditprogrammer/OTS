<?php
require_once "config.php";
$file = $_FILES['profile_img_field'];
$img_file_name = $file['name'];
$img_file_type = $file['type'];
$img_file_tmp_name = $file['tmp_name'];
$img_file_size = $file['size'];

$previous_profile = $_POST['previous_profile'];

if ($file['error'] == 0 && $img_file_name != "") {

    $source_file = $img_file_tmp_name;
    $destination_file = "res/" . time() . "-" . $img_file_name;

    if (move_uploaded_file($source_file, $destination_file)) {
        session_start();
        $user_id = $_SESSION["user_id"];
        $sql = "UPDATE users SET profile_img = '$destination_file' WHERE user_id = '$user_id'";
        if ($conn->query($sql)) {
            echo "Profile picture uploaded!";
            if ($previous_profile != "") {
                unlink($previous_profile); // delete previous image 
            }
        } else {
            echo "Upload Failed!";
        }
    } else {
        echo "Unable to upload!";
    }
} else {
    echo "Invalid file type!";
}
