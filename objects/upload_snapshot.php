<?php
session_start();
include_once "../config/database.php";

$userId = $_SESSION['user_id'];

$dir = "../uploads/$userId/snapshots/";

if (!file_exists($dir)) {
    mkdir($dir, 0777, true);
}

if (!isset($_FILES['snapshot'])) {
    echo json_encode(["status" => "error", "message" => "No file uploaded"]);
    exit;
}

$file = $_FILES['snapshot'];
$ext = pathinfo($file['name'], PATHINFO_EXTENSION);

$filename = "snap_" . time() . "." . $ext;
$path = $dir . $filename;

if (move_uploaded_file($file['tmp_name'], $path)) {
    echo json_encode(["status" => "success", "file" => $filename]);
} else {
    echo json_encode(["status" => "error", "message" => "Upload failed"]);
}