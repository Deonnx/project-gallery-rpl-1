<?php
include('../includes/db.php');

$sql = "SELECT * FROM categories";
$categories = mysqli_query($conn, $sql);

$category_id = isset($_GET['category_id']) ? $_GET['category_id'] : 0;
$sql = $category_id ? "SELECT * FROM photos WHERE category_id = ?" : "SELECT * FROM photos";
$stmt = mysqli_prepare($conn, $sql);
if ($category_id) mysqli_stmt_bind_param($stmt, "i", $category_id);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Gallery</title>
</head>
<body>
    <h1>Gallery</h1>
    <form method="get" action="gallery.php">
        Filter by Category: 
        <select name="category_id">
            <option value="0">All</option>
            <?php while($row = mysqli_fetch_assoc($categories)): ?>
                <option value="<?php echo $row['id']; ?>" <?php if ($row['id'] == $category_id) echo 'selected'; ?>><?php echo $row['name']; ?></option>
            <?php endwhile; ?>
        </select>
        <input type="submit" value="Filter">
    </form>

    <div class="gallery">
        <?php while($photo = mysqli_fetch_assoc($result)): ?>
            <div class="photo">
                <img src="<?php echo $photo['file_path']; ?>" alt="<?php echo $photo['title']; ?>">
                <p><?php echo $photo['title']; ?></p>
                <p><?php echo $photo['description']; ?></p>
            </div>
        <?php endwhile; ?>
    </div>
</body>
</html>
