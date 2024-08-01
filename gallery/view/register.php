<?php
include('../includes/db.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];
    $role = $_POST['role']; // Role ditentukan oleh pengguna atau default

    // Validasi input
    if ($password !== $confirm_password) {
        echo "Passwords do not match.";
        exit;
    }

    // Hash password jika role bukan admin
    $hashed_password = $role === 'admin' ? NULL : password_hash($password, PASSWORD_BCRYPT);

    // Cek apakah username sudah ada
    $sql = "SELECT * FROM users WHERE username = ?";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "s", $username);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);

    if (mysqli_num_rows($result) > 0) {
        echo "Username already exists.";
    } else {
        // Insert user into the database
        $sql = "INSERT INTO users (username, password, role) VALUES (?, ?, ?)";
        $stmt = mysqli_prepare($conn, $sql);
        mysqli_stmt_bind_param($stmt, "sss", $username, $hashed_password, $role);
        if (mysqli_stmt_execute($stmt)) {
            echo "Registration successful. <a href='login.php'>Login here</a>";
        } else {
            echo "Registration failed.";
        }
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Register</title>
</head>
<body>
    <h1>Register</h1>
    <form action="register.php" method="post">
        Username: <input type="text" name="username" required><br>
        Password: <input type="password" name="password" required><br>
        Confirm Password: <input type="password" name="confirm_password" required><br>
        Role: 
        <select name="role">
            <option value="viewer">Viewer</option>
            <option value="admin">Admin</option>
        </select><br>
        <input type="submit" value="Register">
    </form>
</body>
</html>
