<?php
session_start();
include('../includes/db.php');

if ($_SESSION['role'] !== 'admin') {
    header("Location: ../index.php");
    exit;
}

$sql = "SELECT photos.*, categories.name as category_name FROM photos LEFT JOIN categories ON photos.category_id = categories.id";
$result = mysqli_query($conn, $sql);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Manage Photos</title>
</head>
<body>
    <h1>Manage Photos</h1>
    <a href="upload.php">Upload Photo</a>
    <table border="1">
        <tr>
            <th>ID</th>
            <th>Title</th>
            <th>Description</th>
            <th>Category</th>
            <th>Image</th>
            <th>Actions</th>
        </tr>
        <?php while($row = mysqli_fetch_assoc($result)): ?>
        <tr>
            <td><?php echo $row['id']; ?></td>
            <td><?php echo $row['title']; ?></td>
            <td><?php echo $row['description']; ?></td>
            <td><?php echo $row['category_name']; ?></td>
            <td><img src="<?php echo $row['file_path']; ?>" alt="<?php echo $row['title']; ?>" width="100"></td>
            <td>
                <a href="edit_photo.php?id=<?php echo $row['id']; ?>">Edit</a>
                <a href="delete_photo.php?id=<?php echo $row['id']; ?>" onclick="return confirm('Are you sure?')">Delete</a>
            </td>
        </tr>
        <?php endwhile; ?>
    </table>
</body>
</html>
