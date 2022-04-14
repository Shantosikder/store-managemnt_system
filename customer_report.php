<?php

session_start();
if ($_SESSION['login'] != true) {
    header("Location:login.php");
}


include('php/db_config.php');

if (isset($_GET['submit'])) {

    $customer = $_GET['customer'];
    // $start = $_GET["start_date"];
    // $end = $_GET["end_date"];
    $sql = "SELECT * FROM sales WHERE customer_id = '$customer' ";
    $data = $db->query($sql);

    $sqlc = "SELECT * FROM customar";
    $datac = $db->query($sqlc);
} else {
    $sql = "SELECT * FROM sales";
    $data = $db->query($sql);


    $sqlc = "SELECT * FROM customar";
    $datac = $db->query($sqlc);
}


include('layout/header.php') ?>


<!-- Left side column. contains the logo and sidebar -->
<?php include('layout/sideber.php') ?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Customer Report
            <small>Control panel</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="dashboard.php"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">customer report</li>
        </ol>
    </section>


    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="box box-primary">
                    <div class="box-header with-border">

                        <div class="row">
                            <form action="customer_report.php" method="get">
                                <!-- <div class="col-md-4">

                                    <label for="">Start Date: </label>
                                    <input class="form-control" type="date" name="start_date">
                                    <label for="">End Date: </label>
                                    <input type="date" class="form-control" name="end_date"><br><br>

                                </div> -->
                                <div class="col-md-4">

                                    <label for=""> Select Customer </label>
                                    <select name="customer" class="form-control">
                                        <option value="">Select Customer</option>
                                        <?php while ($customers = $datac->fetch_object()) { ?>
                                            <option value="<?php echo $customers->id ?>"><?php echo $customers->name ?></option>
                                        <?php  } ?>
                                    </select><br>
                                    <button class="btn btn-primary" type="submit" name="submit" value="submit">SUBMIT</button>

                                </div>
                            </form>
                        </div>

                        <button class="pull-right btn btn-primary" onclick="getprint('prinarea')">Print</button><br>
                        <hr>
                        <!-- form start -->

                        <div id="prinarea">
                            <table class="table table-striped table-bordered">
                                <thead>
                                    <tr>
                                        <th>No. </th>
                                        <th>Customer Name </th>
                                        <th>Product Name </th>
                                        <th>Salling Price </th>
                                        <th>Quantity </th>
                                        <th>Total </th>
                                        <th>Date </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php while ($row = $data->fetch_object()) {  ?>
                                        <tr>
                                            <td><?php echo $row->id; ?></td>

                                            <?php
                                            $productData = $db->query("SELECT * FROM customar WHERE id = $row->customer_id LIMIT 1");
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


                                            <td><?php echo $row->selling_price; ?></td>
                                            <td><?php echo $row->quantity; ?></td>
                                            <td><?php echo $row->total; ?></td>
                                            <td><?php echo $row->date; ?></td>

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



    });

    var url = window.location.href;

    function getprint(print) {

        $('body').html($('#' + print).html());
        window.print();
        window.location.replace(url)
    }
</script>