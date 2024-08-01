<?php
session_start();
include('../includes/db.php');

if ($_SESSION['role'] !== 'admin') {
    header("Location: ../index.php");
    exit;
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = $_POST['name'];
    $sql = "INSERT INTO categories (name) VALUES (?)";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "s", $name);
    mysqli_stmt_execute($stmt);
    header("Location: manage_categories.php");
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Add Category</title>
</head>
<body>
    <h1>Add Category</h1>
    <form action="add_category.php" method="post">
        Category Name: <input type="text" name="name"><br>
        <input type="submit" value="Add Category">
    </form>
</body>
</html>
