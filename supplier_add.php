<?php

session_start();
if ($_SESSION['login'] != true) {
    header("Location:login.php");
}


include('php/db_config.php');
if ($_SERVER['REQUEST_METHOD'] == 'POST') {


    extract($_POST);
    $sql = "INSERT INTO supplier VALUES(NULL,'$name','$phone','$address','$status')";
    $db->query($sql);
    if ($db->affected_rows > 0) {
        $msg = "Insert Success.";
    } else {
        $msg = "Insert Failure.";
    }
}

include('layout/header.php') ?>


<!-- Left side column. contains the logo and sidebar -->
<?php include('layout/sideber.php') ?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
           Supplier Info
        </h1>
        <ol class="breadcrumb">
            <li><a href="dashboard.php"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">Supplier Info</li>
        </ol>
    </section>


    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <?php
                        if (isset($msg)) {
                        ?>
                            <h3 class="box-title"> <?php echo $msg; ?></h3>
                        <?php
                        }
                        ?>
                        <a class="btn btn-primary pull-right"href="supplier_manage.php">Back</a>
                    </div>
                    <!-- /.box-header -->
                    <!-- form start -->
                    <form role="form" action="" method="post">
                        <div class="box-body">
                            <div class="form-group">
                                <label for="name">Supplier Name</label>
                                <input type="text" name="name" class="form-control" id="name" placeholder="Enter Supplier Name.">
                            </div>

                              <div class="form-group">
                                <label for="name">Supplier Phone</label>
                                <input type="text" name="phone" class="form-control" id="name" placeholder="Enter Supplier Phone">
                            </div>

                            <div class="form-group">
                                <label for="name">Supplier Address</label>
                                <input type="text" name="address" class="form-control" id="name" placeholder="Enter Supplier Address">
                            </div>


                            <div class="form-group">
                                <label for="name">Supplier Status</label>
                                <select class="form-control" name="status" id="">
                                    <option value="1">Active</option>
                                    <option value="0">InActive</option>
                                </select>
                            </div>

                        </div>
                        <!-- /.box-body -->

                        <div class="box-footer">
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->
<?php include('layout/footer.php'); ?>