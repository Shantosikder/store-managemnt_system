<?php

session_start();
if ($_SESSION['login'] != true) {
    header("Location:login.php");
}


include('php/db_config.php');

$sql= "SELECT * FROM category";
 $data=$db->query($sql);


if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    extract($_POST);
    $sql = "INSERT INTO product VALUES(NULL,'$name','$category_id','$description','$status')";
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
            Add Product
            <small>Control panel</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="dashboard.php"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">Product Add</li>
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
                        <a class="btn btn-primary pull-right"href="manage_product.php">Back</a>
                    </div>
                    <!-- /.box-header -->
                    <!-- form start -->
                    <form role="form" action="" method="post">
                        <div class="box-body">
                               <div class="form-group">
                                <label for="name">Category Name</label>
                                <select class="form-control" name="category_id" id="">
                                     <?php
                                         while($row = $data->fetch_object()){
          
                                          ?>
                                    <option value=" <?php echo $row->id; ?> "><?php echo $row->name; ?></option>

                                <?php } ?>
                                  
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="name">Product Name</label>
                                <input type="text" name="name" class="form-control" id="name" placeholder="Enter Category Name.">
                            </div>
                             <div class="form-group">
                                <label for="name">Product Description</label>
                                <input type="text" name="description" class="form-control" id="name" placeholder="Enter Category Name.">
                            </div>

                            <div class="form-group">
                                <label for="name">Product Status</label>
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