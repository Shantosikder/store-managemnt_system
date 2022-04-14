
<?php 

session_start();
if($_SESSION['login']!=true){
  header("Location:login.php");
}




if($_SERVER['REQUEST_METHOD']=='POST'){

    include('php/db_config.php');
    extract($_POST);

    $sql = "UPDATE supplier SET name = '$name',  phone = '$phone', address = '$address', Status = '$status' WHERE id = '$id'";

    $db->query($sql);
    if($db->affected_rows>0){
      echo "<b>Updated</b>";
    }
  }
 ?>

 <?php 
    $id = $_REQUEST['id'];
  include('php/db_config.php');

    $sql = "SELECT * FROM supplier WHERE id = '$id'";
    $data = $db->query($sql);
    $row = $data->fetch_object();

   ?>



<?php include('layout/header.php') ?>


  <!-- Left side column. contains the logo and sidebar -->
  <?php include('layout/sideber.php') ?>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Supplier Edit
        <small>Control panel</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="dashboard.php"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Supplier Edit</li>
      </ol>
    </section>


    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-md-12">
          <div class="box">
            <div class="box-header with-border">
              <h3 class="box-title">Bordered Table</h3>
              <a class="btn btn-primary pull-right"href="manage_product.php">Back</a>
            </div>
            <!-- /.box-header -->
            <div class="box-body">

              <form method="post">
<div class="form-group">

      <label for="name">Name:</label>
    <br>
    <input type="text" class="form-control" name="name" value="<?php echo $row->name; ?>"><br>

      <label for="text">Phone:</label>
    <br>
    <input type="text" class="form-control" name="phone" value="<?php echo $row->phone; ?>"><br>
    

    <label for="text">Address:</label>
    <br>
    <input type="text" class="form-control" name="address" value="<?php echo $row->address; ?>"><br>

    <select class="form-control" name="status" id="">

         <option value="1">Active</option>
         <option value="0">InActive</option>
                                    
    </select>
    <br>   
        <input type="hidden"  name="id" value="<?php echo $row->id; ?>" >
    <input type="submit" name="submit" value="UPDATE" class="btn btn-default">
  </form>    
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