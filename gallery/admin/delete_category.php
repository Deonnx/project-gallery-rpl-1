<?php
session_start();
include('../includes/db.php');

if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
    header("Location: ../login.php");
    exit;
}

if (isset($_GET['id'])) {
    $id = intval($_GET['id']);

    // Check if category is in use
    $sql = "SELECT COUNT(*) FROM photos WHERE category_id = ?";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "i", $id);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_bind_result($stmt, $count);
    mysqli_stmt_fetch($stmt);
    mysqli_stmt_close($stmt);

    // Debugging output
    error_log("Category ID: $id, In Use Count: $count");

    if ($count > 0) {
        // Redirect with error message if category is in use
        header("Location: manage_categories.php?error=1");
    } else {
        // Delete the category
        $sql = "DELETE FROM categories WHERE id = ?";
        $stmt = mysqli_prepare($conn, $sql);
        mysqli_stmt_bind_param($stmt, "i", $id);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_close($stmt);

        // Redirect with success message
        header("Location: manage_categories.php?success=1");
    }
}
?>
