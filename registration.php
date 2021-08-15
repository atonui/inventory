<?php
ob_start();

include_once './includes/header.php';
if ('admin' != $_SESSION['role']) {
  echo '<script type="text/javascript">
                  jQuery(function validation(){
                swal("Administrator Function","Please log in as an administrator.", "error");
                  });
                </script>';
  header('location:index.php');
}

include_once './objects/User.php';
include_once './config/Database.php';

$database = new Database();
$db = $database->connect();
$user = new User($db);
$data = $user->getAllUsers();

//delete code 
if (isset($_GET['delete'])) {
  $user->user_id = $_GET['delete'];
  if ($user->delete()) {
    echo '<script type="text/javascript">
                  jQuery(function validation(){
                swal("User deleted!"," ", "success");
                  });
                </script>';
    header('refresh:2;registration.php');
  } else {
    echo '<script type="text/javascript">
                  jQuery(function validation(){
                swal("Hmm, Seems there was a problem deleting the user!"," ", "error");
                  });
                </script>';
  }
}

// pull form data
if (isset($_POST['register']) and !empty($_POST['name']) and !empty($_POST['email'] and !empty($_POST['password'])) and !empty($_POST['role'])) {
  $user->username = $_POST['name'];
  $user->email = $_POST['email'];
  $user->password = $_POST['password'];
  $user->role = $_POST['role'];

  if ($user->checkUser()) {
    echo '<script type="text/javascript">
                  jQuery(function validation(){
                swal("User is already registered!"," ", "warning");
                  });
                </script>';
  } elseif ($user->createUser()) {
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
<style>
  /* Button used to open the contact form - fixed at the bottom of the page */
  .open-button {
    background-color: #555;
    color: white;
    padding: 16px 20px;
    border: none;
    cursor: pointer;
    opacity: 0.8;
    position: fixed;
    bottom: 23px;
    right: 28px;
    width: 280px;
  }

  /* The popup form - hidden by default */
  .form-popup {
    display: none;
    position: fixed;
    bottom: 0;
    right: 15px;
    border: 3px solid #f1f1f1;
    z-index: 9;
  }

  /* Add styles to the form container */
  .form-container {
    max-width: 300px;
    padding: 10px;
    background-color: white;
  }

  /* Full-width input fields */
  .form-container input[type=text],
  .form-container input[type=password] {
    width: 100%;
    padding: 15px;
    margin: 5px 0 22px 0;
    border: none;
    background: #f1f1f1;
  }

  /* When the inputs get focus, do something */
  .form-container input[type=text]:focus,
  .form-container input[type=password]:focus {
    background-color: #ddd;
    outline: none;
  }

  /* Set a style for the submit/login button */
  .form-container .btn {
    background-color: #04AA6D;
    color: white;
    padding: 16px 20px;
    border: none;
    cursor: pointer;
    width: 100%;
    margin-bottom: 10px;
    opacity: 0.8;
  }

  /* Add a red background color to the cancel button */
  .form-container .cancel {
    background-color: red;
  }

  /* Add some hover effects to buttons */
  .form-container .btn:hover,
  .open-button:hover {
    opacity: 1;
  }
</style>

<script type="text/javascript">
  function openForm() {
    document.getElementById("myForm").style.display = "block";
  }

  function closeForm() {
    document.getElementById("myForm").style.display = "none";
  }
</script>

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

    <!-- Pop up -->
    <div class="col-md-4">
      <div class="form-popup" id="myForm">
        <form action="/action_page.php" class="form-container">
          <h1>Edit</h1>
          <div class="form-group has-feedback">
            <input type="text" class="form-control" placeholder="Full name" name="name" value="<?php echo $user->username; ?>" required>
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
          </div>
          <button type="submit" class="btn cancel" onclick="closeForm()">Close</button>
        </form>
      </div>
      <!-- End of pop up -->

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
                  <td>
                    <button class="btn btn-link" value="' . $row['user_id'] . '" onclick="openForm()"><span class="glyphicon glyphicon-edit" title="edit"></span></button>
                  </td>
                  <td>
                    <a href="registration.php?delete=' . $row['user_id'] . '" class="btn btn-flat"> <span class="glyphicon glyphicon-trash" title="delete"></span></a>
                  </td>
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