<?php

session_start();
if ($_SESSION['login'] != true) {
  header("Location:login.php");
}

include('php/db_config.php');

$sql = "SELECT * FROM product";
$data = $db->query($sql);

include('layout/header.php') ?>

<!-- Left side column. contains the logo and sidebar -->
<?php include('layout/sideber.php') ?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      Manage Product
      <small>Control panel</small>
    </h1>
    <ol class="breadcrumb">
      <li><a href="dashboard.php"><i class="fa fa-dashboard"></i> Home</a></li>
      <li class="active"> Manage Product</li>
    </ol>
  </section>
  <!-- Main content -->
  <section class="content">
    <div class="row">
      <div class="col-md-12">
        <div class="box">
          <div class="box-header with-border">
            <h3 class="box-title">Bordered Table</h3>
            <a class="btn btn-primary pull-right" href="add_product.php">Add</a>
          </div>
          <!-- /.box-header -->
          <div class="box-body">
            <table class="table table-bordered">
              <tr>
                <th style="width: 10px">Id</th>
                <th>Name</th>
                <th>Category</th>
                <th>Discription</th>
                <th>Status</th>
                <th>Action</th>
              </tr>
              <?php
              while ($row = $data->fetch_object()) {

              ?>
                <tr>
                  <td><?php echo $row->id; ?></td>
                  <td><?php echo $row->name; ?></td>


                  <td>
                    <?php


                    $csql = "SELECT * FROM category";
                    $cdata = $db->query($csql);

                    while ($crow = $cdata->fetch_object()) {

                      if ($crow->id == $row->category_id) {
                    ?>

                        <?php echo $crow->name;    ?>

                    <?php
                      }
                    }
                    ?>
                  </td>
                  <td><?php echo $row->description; ?></td>
                  <td>

                    <?php

                    if ($row->status == 1) {

                      echo "Active";
                    } else {
                      echo "Inactive";
                    }
                    ?>
                  </td>
                  <td>
                    <a class="btn btn-primary" href="edit_product.php?id=<?php echo $row->id; ?>">Edit</a>
                    <a class="btn btn-danger" href="delete_product.php?id=<?php echo $row->id; ?>">Delete</a>
                  </td>
                </tr>
              <?php
              }
              ?>

            </table>
          </div>
          <!-- /.box-body -->

        </div>
      </div>
    </div>
  </section>
  <!-- /.content -->
</div>
<!-- /.content-wrapper -->
<?php include('layout/footer.php'); ?>