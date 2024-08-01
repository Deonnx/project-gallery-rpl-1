<?php
session_start();
include('../includes/db.php');

if ($_SESSION['role'] !== 'admin') {
    header("Location: ../index.php");
    exit;
}

$id = $_GET['id'];
$sql = "SELECT * FROM photos WHERE id = ?";
$stmt = mysqli_prepare($conn, $sql);
mysqli_stmt_bind_param($stmt, "i", $id);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);
$photo = mysqli_fetch_assoc($result);

$sql = "SELECT * FROM categories";
$categories = mysqli_query($conn, $sql);

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $title = $_POST['title'];
    $description = $_POST['description'];
    $category_id = $_POST['category_id'];
    $sql = "UPDATE photos SET title = ?, description = ?, category_id = ? WHERE id = ?";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "ssii", $title, $description, $category_id, $id);
    mysqli_stmt_execute($stmt);
    header("Location: manage_photos.php");
}
?>

<!DOCTYPE html>
<html>
head>
    <title>Edit Photo</title>
</head>
<body>
    <h1>Edit Photo</h1>
    <form action="edit_photo.php?id=<?php echo $id; ?>" method="post">
        Title: <input type="text" name="title" value="<?php echo $photo['title']; ?>"><br>
        Description: <textarea name="description"><?php echo $photo['description']; ?></textarea><br>
        Category: 
        <select name="category_id">
            <?php while($row = mysqli_fetch_assoc($categories)): ?>
                <option value="<?php echo $row['id']; ?>" <?php if ($row['id'] == $photo['category_id']) echo 'selected'; ?>><?php echo $row['name']; ?></option>
            <?php endwhile; ?>
        </select><br>
        <input type="submit" value="Update Photo">
    </form>
</body>
</html>
