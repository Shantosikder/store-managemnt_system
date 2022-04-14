<?php
session_start();
if ($_SESSION['login'] != true) {
    header("Location:login.php");
}

include('php/db_config.php');

$sql = "SELECT * FROM stock";
$data = $db->query($sql);


include('layout/header.php') ?>

<!-- Left side column. contains the logo and sidebar -->
<?php include('layout/sideber.php') ?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Stock Info
            <small>Control panel</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="dashboard.php"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">Stock Info</li>
        </ol>
    </section>


    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="box box-primary">

                    <!-- /.box-header -->
                    <!-- form start -->
                    <table class="table table-striped table-bordered">
                        <thead>
                            <tr>
                                <th>No. </th>
                                <th>Name </th>
                                <th>Category </th>
                                <th>Quantity </th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php while ($row = $data->fetch_object()) {  ?>
                                <tr>
                                    <td><?php echo $row->id; ?></td>

                                    <?php
                                    $productData = $db->query("SELECT * FROM product WHERE id = $row->product_id LIMIT 1");
                                    while ($prow = $productData->fetch_object()) {
                                    ?>
                                        <td><?php echo $prow->name; ?></td>
                                    <?php } ?>

                                    <?php
                                    $productData = $db->query("SELECT * FROM category WHERE id = $row->category_id LIMIT 1");
                                    while ($prow = $productData->fetch_object()) {
                                    ?>
                                        <td><?php echo $prow->name; ?></td>
                                    <?php } ?>
                                    <td><?php echo $row->quantity; ?></td>

                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->
<?php include('layout/footer.php'); ?>