<?php

include_once 'includes/header.php';

if (0 != strcmp('admin', $_SESSION['role'])) {
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
 include 'includes/footer.php';
 ?>