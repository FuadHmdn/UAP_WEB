<?php
require_once('../koneksi.php');

$response = array();

if (isset($_FILES['profile_picture'])) {
    $allowed_types = array('jpg', 'jpeg', 'png', 'gif');
    $file_name = $_FILES['profile_picture']['name'];
    $file_tmp = $_FILES['profile_picture']['tmp_name'];
    $file_ext = strtolower(pathinfo($file_name, PATHINFO_EXTENSION));

    if (in_array($file_ext, $allowed_types)) {
        $upload_dir = "../../image/upload/";
        $new_file_name = uniqid() . '.' . $file_ext;
        $upload_path = $upload_dir . $new_file_name;

        if (move_uploaded_file($file_tmp, $upload_path)) {
            $id = $_POST['id'];
            $profile_picture_path = '../../image/upload/' . $new_file_name;

            $stmt = $connection->prepare("UPDATE admin SET profile_picture = ? WHERE id = ?");
            $stmt->bind_param("si", $profile_picture_path, $id);
            if ($stmt->execute()) {
                $response = array("success" => true, "message" => "Profile picture updated successfully", "profile_picture" => $profile_picture_path);
            } else {
                $response = array("success" => false, "message" => "Error updating profile picture in database");
            }
        } else {
            $response = array("success" => false, "message" => "Error uploading file");
        }
    } else {
        $response = array("success" => false, "message" => "File type not allowed");
    }
} else {
    $response = array("success" => false, "message" => "No file uploaded");
}

echo json_encode($response);
?>
