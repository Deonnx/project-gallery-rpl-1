<?php
session_start();
include('../includes/db.php');

if ($_SESSION['role'] !== 'admin') {
    header("Location: ../index.php");
    exit;
}

$id = $_GET['id'];
$sql = "SELECT * FROM categories WHERE id = ?";
$stmt = mysqli_prepare($conn, $sql);
mysqli_stmt_bind_param($stmt, "i", $id);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);
$category = mysqli_fetch_assoc($result);

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = $_POST['name'];
    $sql = "UPDATE categories SET name = ? WHERE id = ?";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "si", $name, $id);
    mysqli_stmt_execute($stmt);
    header("Location: manage_categories.php");
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Edit Category</title>
</head>
<body>
    <h1>Edit Category</h1>
    <form action="edit_category.php?id=<?php echo $id; ?>" method="post">
        Category Name: <input type="text" name="name" value="<?php echo $category['name']; ?>"><br>
        <input type="submit" value="Update Category">
    </form>
</body>
</html>
