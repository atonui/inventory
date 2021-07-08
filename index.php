  <!-- Sweet alerts -->
  <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
  <!-- jQuery 3 -->
  <script src="bower_components/jquery/dist/jquery.min.js"></script>
  <!-- Bootstrap 3.3.7 -->
  <script src="bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
  <!-- iCheck -->
  <script src="plugins/iCheck/icheck.min.js"></script>

<?php

include_once './objects/User.php';

include_once './config/Database.php';

if (isset($_POST['login']) && !empty($_POST['email']) && !empty($_POST['password'])) {
    // create database and user objects
    $database = new Database();
    $db = $database->connect();
    $user = new User($db);
    $user->email = $_POST['email'];
    $user->password = $_POST['password'];

    if ($user->login()) {
        if ('admin' == $_SESSION['role']) {
            echo '<script type="text/javascript">
            jQuery(function validation(){
          swal("Welcome!", "'.$_SESSION['username'].'", "success");
            });
          </script>';
            header('refresh:1;dashboard.php');
        } else {
            echo '<script type="text/javascript">
            jQuery(function validation(){
          swal("Welcome!", "'.$_SESSION['username'].'", "success");
            });
          </script>';
            header('refresh:1;user.php');
        }
    } else {
        echo '<script type="text/javascript">
            jQuery(function validation(){
          swal("Login Failed", "Wrong username/ password", "error");
            });
          </script>';
        header('refresh:1;index.php');
    }
}

?>

<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Inventory | POS</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.7 -->
  <link rel="stylesheet" href="bower_components/bootstrap/dist/css/bootstrap.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="bower_components/font-awesome/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="bower_components/Ionicons/css/ionicons.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="dist/css/AdminLTE.min.css">
  <!-- iCheck -->
  <link rel="stylesheet" href="plugins/iCheck/square/blue.css">

  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->

  <!-- Google Font -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
</head>

<body class="hold-transition login-page">
  <div class="login-box">
    <div class="login-logo">
      <a href="../../index2.html"><b>Inventory</b>POS</a>
    </div>
    <!-- /.login-logo -->
    <div class="login-box-body">
      <p class="login-box-msg">Sign in to start your session</p>

      <form action="" method="post">
        <div class="form-group has-feedback">
          <input type="email" class="form-control" placeholder="Email" required name="email">
          <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
        </div>
        <div class="form-group has-feedback">
          <input type="password" class="form-control" placeholder="Password" required name="password">
          <span class="glyphicon glyphicon-lock form-control-feedback"></span>
        </div>
        <div class="row">
          <div class="col-xs-8">
            <a href="#" onclick="swal('To Get Password', 'Please Contact Admin', 'warning');">I forgot my password</a>
          </div>
          <!-- /.col -->
          <div class="col-xs-4">
            <button type="submit" class="btn btn-primary btn-block btn-flat" name="login">Login</button>
          </div>
          <!-- /.col -->
        </div>

      </form>


      <!-- /.social-auth-links -->
    </div>
    <!-- /.login-box-body -->
  </div>
  <!-- /.login-box -->

  <script>
    $(function() {
      $('input').iCheck({
        checkboxClass: 'icheckbox_square-blue',
        radioClass: 'iradio_square-blue',
        increaseArea: '20%' /* optional */
      });
    });
  </script>
</body>

</html>