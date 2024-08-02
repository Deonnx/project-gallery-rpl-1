<?php
session_start();
if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
    header("Location: ../login.php");
    exit;
}

include('../includes/db.php');
$sql = "SELECT * FROM categories";
$categories = mysqli_query($conn, $sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Manage Photos</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="../plugins/fontawesome-free/css/all.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="../dist/css/adminlte.min.css">
  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="../plugins/bootstrap/css/bootstrap.min.css">
</head>
<body class="hold-transition sidebar-mini layout-fixed">
<div class="wrapper">

  <!-- Preloader -->
  <div class="preloader flex-column justify-content-center align-items-center">
    <img class="animation__shake" src="../dist/img/admin1.png" alt="" height="100" width="350">
  </div>

  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
      </li>
    </ul>

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
      <li class="nav-item">
        <a class="nav-link" href="../view/login.php">
          <i class="fas fa-sign-out-alt"></i> Logout
        </a>
      </li>
    </ul>
  </nav>
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="index.php" class="brand-link">
      <span class="brand-text font-weight-light">Admin</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <li class="nav-item menu-open">
            <a href="#" class="nav-link active">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>
                Dashboard
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="manage_categories.php" class="nav-link">
                  <i class="nav-icon fas fa-th"></i>
                  <p>Manage Categories</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="manage_photos.php" class="nav-link active">
                  <i class="nav-icon fas fa-images"></i>
                  <p>Manage Photos</p>
                </a>
              </li>
            </ul>
          </li>
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Manage Photos</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Manage Photos</li>
            </ol>
          </div>
        </div>
      </div>
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-md-12">
            <!-- Your content here -->
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Photos</h3>
                <button type="button" class="btn btn-success float-right" data-toggle="modal" data-target="#photoModal" data-action="add">Add Photo</button>
              </div>
              <div class="card-body">
                <table class="table table-bordered">
                  <thead>
                    <tr>
                      <th>ID</th>
                      <th>Title</th>
                      <th>Photo</th>
                      <th>Actions</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php
                    $sql = "SELECT * FROM photos";
                    $result = mysqli_query($conn, $sql);
                    while ($row = mysqli_fetch_assoc($result)): ?>
                    <tr>
                      <td><?php echo $row['id']; ?></td>
                      <td><?php echo $row['title']; ?></td>
                      <td><img src="../images/<?php echo $row['file_path']; ?>" width="100" alt="<?php echo $row['title']; ?>"></td>
                      <td>
                        <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#photoModal" data-action="edit" data-id="<?php echo $row['id']; ?>" data-title="<?php echo $row['title']; ?>" data-description="<?php echo $row['description']; ?>" data-category="<?php echo $row['category_id']; ?>">Edit</button>
                        <a href="delete_photo.php?id=<?php echo $row['id']; ?>" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure?')">Delete</a>
                      </td>
                    </tr>
                    <?php endwhile; ?>
                  </tbody>
                </table>
              </div>
            </div>
            <!-- /.card -->
          </div>
        </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

  <!-- Photo Modal -->
  <div class="modal fade" id="photoModal" tabindex="-1" role="dialog" aria-labelledby="photoModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="photoModalLabel">Add Photo</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form id="photoForm" action="upload.php" method="post" enctype="multipart/form-data">
          <div class="modal-body">
            <input type="hidden" id="photo_id" name="photo_id">
            <div class="form-group">
              <label for="title">Title</label>
              <input type="text" class="form-control" id="title" name="title" required>
            </div>
            <div class="form-group">
              <label for="description">Description</label>
              <textarea class="form-control" id="description" name="description" rows="3" required></textarea>
            </div>
            <div class="form-group">
              <label for="category_id">Category</label>
              <select class="form-control" id="category_id" name="category_id" required>
                <?php
                mysqli_data_seek($categories, 0); // Reset the result pointer
                while ($row = mysqli_fetch_assoc($categories)): ?>
                <option value="<?php echo $row['id']; ?>"><?php echo $row['name']; ?></option>
                <?php endwhile; ?>
              </select>
            </div>
            <div class="form-group">
              <label for="file">Select image to upload</label>
              <input type="file" class="form-control-file" id="file" name="file" required>
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-primary">Save changes</button>
          </div>
        </form>
      </div>
    </div>
  </div>

  <footer class="main-footer">
    <strong>Copyright &copy; 2024 <a href="https://adminlte.io">XII RPL 1</a>.</strong>
    All rights reserved.
    <div class="float-right d-none d-sm-inline-block">
      <b>Version</b> 3.1.0
    </div>
  </footer>

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>

</div>
<!-- ./wrapper -->

<!-- jQuery -->
<script src="../plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="../plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="../dist/js/adminlte.min.js"></script>

<script>
$(document).ready(function () {
    $('#photoModal').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget);
        var action = button.data('action');
        var modal = $(this);

        if (action === 'edit') {
            var id = button.data('id');
            var title = button.data('title');
            var description = button.data('description');
            var category = button.data('category');

            modal.find('.modal-title').text('Edit Photo');
            modal.find('#photoForm').attr('action', 'edit_photo.php');
            modal.find('#photo_id').val(id);
            modal.find('#title').val(title);
            modal.find('#description').val(description);
            modal.find('#category_id').val(category);
            modal.find('#file').prop('required', false);
        } else {
            modal.find('.modal-title').text('Add Photo');
            modal.find('#photoForm').attr('action', 'upload.php');
            modal.find('#photo_id').val('');
            modal.find('#title').val('');
            modal.find('#description').val('');
            modal.find('#category_id').val('');
            modal.find('#file').prop('required', true);
        }
    });
});
</script>

</body>
</html>
