<?php
include_once './includes/header.php';

include_once './objects/User.php';

include_once './config/Database.php';

if (isset($_POST['btnUpdate'])) {
  $oldPassword = $_POST['oldPassword'];
  $newPassword = $_POST['newPassword'];
  $confirmPassword = $_POST['confirmPassword'];

  if (!empty($oldPassword) and !empty($newPassword) and !empty($confirmPassword)) {
    if ($confirmPassword == $newPassword) {
      // create user and db objects
      $database = new Database();
      $db = $database->connect();
      $user = new User($db);
      $user->user_id = $_SESSION['user_id'];

      if ($user->check_passwords_match($oldPassword)) {
        if ($user->update_password($newPassword)) {
          echo '<script type="text/javascript">
                  jQuery(function validation(){
                swal("Password Updated!"," ", "success");
                  });
                </script>';
        }
      } else {
        echo '<script type="text/javascript">
              jQuery(function validation(){
            swal("Wrong Password!"," ", "error");
              });
            </script>';
      }
      // check old password matches the db password
      // check new password and confirm password are the same
      // update db with new password
    } else {
      echo '<script type="text/javascript">
          jQuery(function validation(){
        swal("Passwords Do Not Match!", " ", "error");
          });
        </script>';
    }
  } else {
    echo '<script type="text/javascript">
      jQuery(function validation(){
    swal("Please Fill in all the Fields."," ", "error");
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
      Change Password
      <!-- <small>Administrator Dashboard</small> -->
    </h1>
    <ol class="breadcrumb">
      <li><a href="#"><i class="fa fa-dashboard"></i> Level</a></li>
      <li class="active">Here</li>
    </ol>
  </section>

  <!-- Main content -->
  <section class="content container-fluid">
    <div class="box box-primary">
      <div class="box-header with-border">
        <h3 class="box-title">Change Password Form</h3>
      </div>
      <!-- /.box-header -->
      <!-- form start -->
      <form role="form" method="POST">
        <div class="box-body">

          <div class="form-group">
            <label for="exampleInputPassword1">Old Password</label>
            <input type="password" class="form-control" placeholder="Old Password" name="oldPassword" required>
          </div>
          <div class="form-group">
            <label for="exampleInputPassword1">New Password</label>
            <input type="password" class="form-control" placeholder="New Password" name="newPassword" required>
          </div>
          <div class="form-group">
            <label for="exampleInputPassword1">Confirm Password</label>
            <input type="password" class="form-control" placeholder="Confirm Password" name="confirmPassword" required>
          </div>


        </div>
        <!-- /.box-body -->

        <div class="box-footer">
          <button type="submit" class="btn btn-primary" name="btnUpdate">Update</button>
        </div>
      </form>
    </div>

  </section>
  <!-- /.content -->
</div>
<!-- /.content-wrapper -->

<!-- Main Footer -->
<?php
include_once './includes/footer.php';
?>