<?php
session_start();
if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
    header("Location: ../login.php");
    exit;
}
include('../includes/db.php');

if (isset($_GET['id'])) {
    $id = intval($_GET['id']);

    // Fetch file path to delete the file
    $sql = "SELECT file_path FROM photos WHERE id = ?";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "i", $id);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_bind_result($stmt, $filePath);
    mysqli_stmt_fetch($stmt);
    mysqli_stmt_close($stmt);

    // Delete the photo record
    $sql = "DELETE FROM photos WHERE id = ?";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "i", $id);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);

    // Delete the photo file
    if (!empty($filePath) && file_exists('../' . $filePath)) {
        unlink('../' . $filePath);
    }

    header("Location: manage_photos.php");
}
?>
