
<?php 

session_start();
if($_SESSION['login']!=true){
  header("Location:login.php");
}




if($_SERVER['REQUEST_METHOD']=='POST'){

    include('php/db_config.php');
    extract($_POST);

    $sql = "UPDATE category SET name = '$name', status = '$status' WHERE id = '$id'";

    $db->query($sql);
    if($db->affected_rows>0){
      echo "<b>Updated</b>";
    }
  }

include('layout/header.php') ?>

 <?php 
    $id = $_REQUEST['id'];
  include('php/db_config.php');

    $sql = "SELECT * FROM category WHERE id = '$id'";
    $data = $db->query($sql);
    $row = $data->fetch_object();


   ?>


  <!-- Left side column. contains the logo and sidebar -->
  <?php include('layout/sideber.php') ?>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Category Edit
        <small>Control panel</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="dashboard.php"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Category Edit</li>
      </ol>
    </section>


    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-md-12">
          <div class="box">
            <div class="box-header with-border">
              <a class="btn btn-primary pull-right"href="add_category.php">Add</a>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
             
<form method="post">
<div class="form-group">
      <label for="name">Name:</label>
    <br>
    <input type="text" class="form-control" name="name" value="<?php echo $row->name; ?>"><br>
    
    <label for="name">Status:</label><br>

    <select class="form-control" name="status" id="">

                                    <option value="1">Active</option>
                                    <option value="0">InActive</option>
                                    
    </select>

    
   <!--  <input type="text" class="form-control" name="status" value="<?php echo $row->status; ?>"><br>  -->   
    <br>
        
        <input type="hidden"  name="id" value="<?php echo $row->id; ?>" >
    <input type="submit" name="submit" value="UPDATE" class="btn btn-default">
        
    
  </form>

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