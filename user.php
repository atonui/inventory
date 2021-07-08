<?php
ob_start();

include_once './includes/header.php';

//session_start();
if ('user' != $_SESSION['role']) {
    header('location:index.php');
}
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
 include_once './includes/footer.php';
 ?>