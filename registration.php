<?php
ob_start();

include_once './includes/header.php';
if ('admin' != $_SESSION['role']) {
  header('location:index.php');
}

include_once './objects/User.php';
include_once './config/Database.php';

$database = new Database();
$db = $database->connect();
$user = new User($db);
$data = $user->getAllUsers();

// pull form data
if (isset($_POST['register']) and !empty($_POST['name']) and !empty($_POST['email'] and !empty($_POST['password'])) and !empty($_POST['role'])) {
  $user->username = $_POST['name'];
  $user->email = $_POST['email'];
  $user->password = $_POST['password'];
  $user->role = $_POST['role'];

  if ($user->createUser()) {
    echo '<script type="text/javascript">
                  jQuery(function validation(){
                swal("User registered!"," ", "success");
                  });
                </script>';
  } else {
    echo '<script type="text/javascript">
                  jQuery(function validation(){
                swal("Hmm, Seems there was a problem registering the user!"," ", "error");
                  });
                </script>';
  }
}
?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      Registration
      <small>User Registration Dashboard</small>
    </h1>
    <ol class="breadcrumb">
      <li><a href="#"><i class="fa fa-dashboard"></i> Level</a></li>
      <li class="active">Here</li>
    </ol>
  </section>

  <!-- Main content -->
  <section class="content container-fluid">

    <!--------------------------
        | Your Page Content Here |
        -------------------------->

    <!-- <body class="hold-transition register-page"> -->
    <div class="col-md-4">
      <!-- <div class="register-logo">
        <a href="../../index2.html"><b>Inventory</b>POS</a>
      </div> -->

      <div class="register-box-body">
        <p class="login-box-msg">Register a new user</p>

        <form action="" method="post">
          <div class="form-group has-feedback">
            <input type="text" class="form-control" placeholder="Full name" name="name" required>
            <span class="glyphicon glyphicon-user form-control-feedback"></span>
          </div>
          <div class="form-group has-feedback">
            <input type="email" class="form-control" placeholder="Email" name="email" required>
            <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
          </div>
          <div class="form-group has-feedback">
            <input type="password" class="form-control" placeholder="Password" name="password">
            <span class="glyphicon glyphicon-lock form-control-feedback"></span>
          </div>
          <div>
            <p class="text-left"><strong> Role </strong></p>
            <div class="form-group text-left">
              <select class="form-control" name="role">
                <option value="user">User</option>
                <option value="admin">Admistrator</option>
              </select>
            </div>
            <!-- /.col -->
            <div class="form-group">
              <button type="submit" class="btn btn-primary btn-flat btn-block btn-flat" name="register">Register</button>
            </div>
            <!-- /.col -->
          </div>
        </form>
      </div>
    </div>
    <!-- This here should be in AJAX -->
    <div class="col-md-8">
      <div class="register-box-body">
        <table class="table table-striped">
          <thead>
            <tr>
              <th>Name</th>
              <th>Email</th>
              <th>Role</th>
            </tr>
          </thead>
          <tbody>
            <?php
            while ($row = $data->fetch(PDO::FETCH_ASSOC)) {
              extract($row);
              echo '
                <tr>
                  <td>' . $row['username'] . '</td>
                  <td>' . $row['email'] . '</td>
                  <td>' . ucfirst($row['role']) . '</td>
                  <td><button type="submit" class="btn btn-warning" name="edit" value="' . $row['user_id'] . '">Edit</button></td>
                  <td><button type="submit" class="btn btn-danger" name="edit" value="' . $row['user_id'] . '">Delete</button></td>
                </tr>
                
                ';
            }
            ?>
          </tbody>
        </table>
      </div>
    </div>

  </section>
</div>
<!-- Main Footer -->
<?php
include_once './includes/footer.php';
?>