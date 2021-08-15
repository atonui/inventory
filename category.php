<?php
ob_start();

include_once './includes/header.php';
if ('admin' != $_SESSION['role']) {
    header('location:index.php');
}

include_once './objects/Category.php';
include_once './config/Database.php';

// create database and category object
$database = new Database();
$db = $database->connect();
$category = new Category($db);
$data = $category->getAllCategories();

if (isset($_POST['btnDelete'])) {
    $category->cat_id = $_POST['btndelete'];
    if ($category->delete()) {
        echo '<script type="text/javascript">
                  jQuery(function validation(){
                swal("Category deleted!"," ", "success");
                  });
                </script>';
        header('refresh:2;category.php');
    } else {
        echo '<script type="text/javascript">
                  jQuery(function validation(){
                swal("Hmm, Seems there was a problem deleting the category!"," ", "error");
                  });
                </script>';
    }
}

if (isset($_POST['update']) and !empty($_POST['update'])) {
    $category->cat_id = $_POST['update'];
    $category->cat_name = $_POST['category'];
    if ($category->updateCategory()) {
        echo '<script type="text/javascript">
        jQuery(function validation(){
      swal("Category Updated"," ", "success");
        });
      </script>';
        header('refresh:1;category.php');
    } else {
        echo '<script type="text/javascript">
                  jQuery(function validation(){
                swal("Oops! Something went wrong."," ", "error");
                  });
                </script>';
    }
}

if (isset($_POST['save']) and !empty($_POST['category'])) {
    $category->cat_name = $_POST['category'];
    if ($category->checkCategory()) {
        echo '<script type="text/javascript">
                  jQuery(function validation(){
                swal("Category already exists"," ", "warning");
                  });
                </script>';
    } elseif ($category->createCategory()) {
        echo '<script type="text/javascript">
                  jQuery(function validation(){
                swal("Category registered!"," ", "success");
                  });
                </script>';
        header('refresh:2;category.php');
    } else {
        echo '<script type="text/javascript">
                  jQuery(function validation(){
                swal("Oops! Something went wrong."," ", "error");
                  });
                </script>';
    }
}

if (isset($_POST['update'])) {
    $category->cat_name = $_POST['category'];
    $category->cat_id = $_POST['categoryIdEdit'];
    echo $category->cat_name;
    echo $category->cat_id;
}

?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Categories
            <small>Categories Dashboard</small>
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
        <div class="col-md-4">
            <div class="register-box-body">
                <p class="login-box-msg">Create Category</p>

                <form action="" method="post">
                    <?php
                    if (isset($_POST['btnEdit'])) {
                        $category->cat_id = $_POST['btnEdit'];
                        $details = $category->getCartegory();
                        $row = $details->fetch(PDO::FETCH_ASSOC);
                        extract($row);
                        echo '<div class="form-group has-feedback">
                        <input type="text" class="form-control" name="category" value="' . $cat_name . '">
                        <span class="glyphicon glyphicon-list-alt form-control-feedback"></span>
                    </div>
                    <div>
                        <div class="form-group">
                            <button type="submit" class="btn btn-warning btn-flat" name="update" value="' . $cat_id . '">Update</button>
                        </div>
                        <!-- /.col -->
                    </div>';
                    } else {
                        echo '<div class="form-group has-feedback">
                        <input type="text" class="form-control" placeholder="Category" name="category">
                        <span class="glyphicon glyphicon-list-alt form-control-feedback"></span>
                    </div>
                    <div>
                        <div class="form-group">
                            <button type="submit" class="btn btn-primary btn-flat" name="save">Save</button>
                        </div>
                        <!-- /.col -->
                    </div>';
                    }

                    ?>

                </form>
            </div>
        </div>
        <!-- This here should be in AJAX -->
        <div class="col-md-8">
            <div class="register-box-body">
                <table class="table table-striped" id="categoryTable">
                    <thead>
                        <tr>
                            <th>Category</th>
                            <th>Edit</th>
                            <th>Delete</th>
                        </tr>
                    </thead>
                    <tbody>
                        <form action="" method="post">
                            <?php
                            while ($row = $data->fetch(PDO::FETCH_ASSOC)) {
                                extract($row);
                                echo '
                            <tr>
                                <td>' . $row['cat_name'] . '</td>
                                <td>
                                    <div class="form-group has-feedback">
                                    <button class="btn btn-link" type="submit" value="' . $row['cat_id'] . '" name="btnEdit"> <span class="glyphicon glyphicon-edit" title="edit"></span></button>
                                    </div>
                                </td>
                                <td>
                                    <button class="btn btn-link" type="submit" value="' . $row['cat_id'] . '" name="btnDelete"> <span class="glyphicon glyphicon-trash" title="delete"></span></button>
                                </td>
                            </tr>';
                                unset($row['cat_id']);
                            }

                            ?>
                        </form>
                    </tbody>
                </table>
            </div>
        </div>

    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->

<!-- Main Footer -->
<script>
    $(document).ready(function() {
        $('#categoryTable').DataTable();
    });
</script>
<?php
include_once './includes/footer.php';
?>