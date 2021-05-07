<?php
session_start();

if (0 != strcmp('user', $_SESSION['role'])) {
    header('location:index.php');
}

include_once 'header.php';

include_once 'objects/User.php';

include_once 'config/Database.php';

?>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">

        <!--------------------------- 
          | Page content goes here |
        ---------------------------->

      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->



  <!-- Main Footer -->
 <?php
 include 'footer.php';
 ?>