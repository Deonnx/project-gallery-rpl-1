<?php
session_start();
include('../includes/db.php');

if ($_SESSION['role'] !== 'admin') {
    header("Location: ../index.php");
    exit;
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $title = $_POST['title'];
    $description = $_POST['description'];
    $category_id = $_POST['category_id'];
    $file = $_FILES['file'];

    $target_dir = "../images/";
    $target_file = $target_dir . basename($file["name"]);

    if (move_uploaded_file($file["tmp_name"], $target_file)) {
        $sql = "INSERT INTO photos (title, description, file_path, uploaded_by, category_id) VALUES (?, ?, ?, ?, ?)";
        $stmt = mysqli_prepare($conn, $sql);
        mysqli_stmt_bind_param($stmt, "sssii", $title, $description, $target_file, $_SESSION['user_id'], $category_id);
        mysqli_stmt_execute($stmt);
        header("Location: manage_photos.php");
    } else {
        echo "Sorry, there was an error uploading your file.";
    }
}
?>
