<?php 

session_start();
if($_SESSION['login']!=true){
  header("Location:login.php");
}

include('php/db_config.php');

$sql= "SELECT * FROM customar";
 $data=$db->query($sql);

include('layout/header.php') ?>

  <!-- Left side column. contains the logo and sidebar -->
  <?php include('layout/sideber.php') ?>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Manage Customer
        <small>Control panel</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="dashboard.php"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Manage Customer</li>
      </ol>
    </section>
    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-md-12">
          <div class="box">
            <div class="box-header with-border">
              <h3 class="box-title">Bordered Table</h3>
              <a class="btn btn-primary pull-right"href="customer_add.php">Add</a>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <table class="table table-bordered">
                <tr>
                  <th style="width: 10px">Id</th>
                  <th>Name</th>
                  <th>Phone</th>
                  <th>Address</th>
                  <th>Status</th>
                  <th>Action</th>
                </tr>
                <?php
                while($row = $data->fetch_object()){
                ?>
                <tr>
                  <td><?php echo $row->id; ?></td>
                  <td><?php echo $row->name; ?></td>
                  <td><?php echo $row->phone; ?></td>
                  <td><?php echo $row->address; ?></td>
                  <td>
                  <?php 
                  if($row->status==1){
                    echo "Active";
                  }else {
                    echo "Inactive";
                  }
                   ?>
                  </td>
                  <td>
                    <a class="btn btn-primary"href="customer_edit.php?id=<?php echo $row->id; ?>">Edit</a>
                    <a class="btn btn-danger"href="customer_delete.php?id=<?php echo $row->id; ?>">Delete</a> 
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