<?php

session_start();
if ($_SESSION['login'] != true) {
    header("Location:login.php");
}


include('php/db_config.php');

if (isset($_GET['submit'])) {

    $start= $_GET["start_date"];
    $end= $_GET["end_date"];
    $sql = "SELECT * FROM purchase WHERE date BETWEEN '$start'  AND '$end'";
    $data = $db->query($sql);
} else {
    $sql = "SELECT * FROM purchase";

    $data = $db->query($sql);
}





include('layout/header.php') ?>


<!-- Left side column. contains the logo and sidebar -->
<?php include('layout/sideber.php') ?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Purchase Product Info
            <small>Control panel</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="dashboard.php"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">Purchase Product Info</li>
        </ol>
    </section>


    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="box box-primary">
                    <div class="box-header with-border">

                        <div class="row">
                            <div class="col-md-4">
                                <form action="purchase_product_info.php" method="get">
                                    <label for="">Start Date: </label>
                                    <input class="form-control" type="date" name="start_date">
                                    <label for="">End Date: </label>
                                    <input type="date" class="form-control" name="end_date"><br><br>
                                    <button class="btn btn-primary" type="submit" name="submit" value="submit">SUBMIT</button>
                                </form>
                            </div>
                        </div>

                           <button class="pull-right btn btn-primary" onclick="getprint('prinarea')">Print</button><br><hr>

                    </div>
                    <!-- /.box-header -->
                    <!-- form start -->
                    <div id="prinarea">

                    <table class="table table-striped table-bordered">
                        <thead>
                            <tr>
                                <th>No. </th>
                                <th>Supplier Name </th>
                                <th>Product Name </th>
                                <th>Product Category </th>
                                <th>Costing Price </th>
                                <th>Quantity </th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php while ($row = $data->fetch_object()) {  ?>
                                <tr>
                                    <td><?php echo $row->id; ?></td>

                                    <?php
                                    $productData = $db->query("SELECT * FROM supplier WHERE id = $row->supplier_id LIMIT 1");
                                    while ($prow = $productData->fetch_object()) {
                                    ?>
                                        <td><?php echo $prow->name; ?></td>
                                    <?php } ?>

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
                                    <td><?php echo $row->cost_price; ?></td>
                                    <td><?php echo $row->quantity; ?></td>

                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->
<?php include('layout/footer.php'); ?>

<script>
    $(function() {


        $('#category_id').change(function() {
            var category_id = $(this).val();
            // alert(category_id);
            $('#product_id').html('<option value="">Select Product</option>');

            if (category_id != '') {
                $.ajax({
                    method: "GET",
                    url: "get/get_product.php",
                    data: {
                        category_id: category_id
                    }
                }).done(function(response) {
                    $('#product_id').html(response);

                });
            }

            // $('#modal-branch').trigger('change');
        });




    });

    
  var url      = window.location.href;
    function getprint(print) {

            $('body').html($('#'+print).html());
            window.print();
             window.location.replace(url)
        }
</script>