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
    $photo_id = $_POST['photo_id'];
    $file = $_FILES['file'];

    if ($file['error'] == 0) {
        $target_dir = "../images/";
        $target_file = $target_dir . basename($file["name"]);

        if (move_uploaded_file($file["tmp_name"], $target_file)) {
            $sql = "UPDATE photos SET title=?, description=?, file_path=?, category_id=? WHERE id=?";
            $stmt = mysqli_prepare($conn, $sql);
            mysqli_stmt_bind_param($stmt, "sssii", $title, $description, $target_file, $category_id, $photo_id);
            mysqli_stmt_execute($stmt);
        } else {
            echo "Sorry, there was an error uploading your file.";
            exit;
        }
    } else {
        $sql = "UPDATE photos SET title=?, description=?, category_id=? WHERE id=?";
        $stmt = mysqli_prepare($conn, $sql);
        mysqli_stmt_bind_param($stmt, "ssii", $title, $description, $category_id, $photo_id);
        mysqli_stmt_execute($stmt);
    }

    header("Location: manage_photos.php");
}
?>
