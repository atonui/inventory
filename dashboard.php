<?php
ob_start();

include_once './includes/header.php';
//session_start();
if ('admin' != $_SESSION['role']) {
    header('location:index.php');
}

?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Dashboard
            <small>Administrator Dashboard</small>
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

    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->

<!-- Main Footer -->
<?php
include_once './includes/footer.php';
?>