<?php

session_start();
if ($_SESSION['login'] != true) {
    header("Location:login.php");
}


include('php/db_config.php');

$sql= "SELECT * FROM supplier";
$data=$db->query($sql);

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    extract($_POST);
   


    $sql= "SELECT * FROM stock WHERE product_id = $product_id";
    $data=$db->query($sql);
    $row=$data->fetch_object();
    if($row){

        $total= $selling_price * $quantity;
        $ssql = "INSERT INTO sales VALUES (NULL,CURDATE(),$customer_id,$product_id,$quantity,$selling_price,$total)";
      // var_dump($ssql);
        $db->query($ssql);
        if ($db->affected_rows > 0) {
            $msg = "Sale Success.";
        } else {
            $msg = "Failure.";
        }


           $usql="UPDATE stock SET quantity = $row->quantity-$quantity WHERE product_id = $product_id";
           $data=$db->query($usql);
    } else {
        $msg = "Not in Stock.";
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
           Sales Product
            <small>Control panel</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="dashboard.php"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">Sales Product</li>
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
                        <a class="btn btn-primary pull-right"href="selesinfo.php">Back</a>
                    </div>
                    <!-- /.box-header -->
                    <!-- form start -->
                    <form role="form" action="" method="post">
                        <div class="box-body">
                               <div class="form-group">
                                <label for="">Customer Name</label>
                                <select class="form-control" name="customer_id" id="">
                                    <?php $sql= "SELECT * FROM customar";
                                        $data=$db->query($sql); ?>
                                     <?php
                                         while($row = $data->fetch_object()){
          
                                          ?>
                                    <option value=" <?php echo $row->id; ?> "><?php echo $row->name; ?></option>

                                <?php } ?>
                                  
                                </select>
                            </div>
                            <div class="form-group">
                                <label for=""> Category Product</label>
                                <select class="form-control" name="category_id" id="category_id">
                                    <?php  $sql= "SELECT * FROM category";
                                    $data=$db->query($sql); ?>
                                     <?php
                                         while($row = $data->fetch_object()){
          
                                          ?>
                                    <option value=" <?php echo $row->id; ?> "><?php echo $row->name; ?></option>

                                <?php } ?>
                                  
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="">Product Name</label>
                                <select class="form-control" name="product_id" id="product_id">
                                    <?php  $sql= "SELECT * FROM product";
                                    $data=$db->query($sql); ?>
                                     <?php
                                         while($row = $data->fetch_object()){
          
                                          ?>
                                    <option value=" <?php echo $row->id; ?> "><?php echo $row->name; ?></option>

                                <?php } ?>
                                                                 
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="selling_price"> Price</label>
                                <input type="number" name="selling_price" class="form-control" placeholder="Enter Selling price ">
                            </div>

                            <div class="form-group">
                                <label for="quantity">Quantity</label>
                                <input type="number" name="quantity" class="form-control" placeholder="Enter Product Quantity">
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

<script>
    
    $(function () {


    $('#category_id').change(function () {
    var category_id = $(this).val();
   // alert(category_id);
    $('#product_id').html('<option value="">Select Product</option>');
   
    if (category_id != '') {
        $.ajax({
            method: "GET",
            url: "get/get_product.php",
            data: { category_id: category_id }
        }).done(function( response ) {
            $('#product_id').html(response);
        
        });
    }

   // $('#modal-branch').trigger('change');
    });


});

</script>