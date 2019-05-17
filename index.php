<?php

  include "action.php";

?>


<!DOCTYPE html>
<html class="no-js">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>OOP PHP CRUD</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- BOOTSTRAP CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <!-- JQUERY  -->
    <script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
    <!-- BOOTSTRAP JS -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  </head>
  <body>

    <div class="container">
      <div class="jumbotron">
        <h1>Medicine Stock</h1>
      </div>
    </div>

    <div class="container">
      <div class="row">
        <div class="col-md-6 col-md-offset-3">
          <div class="panel panel-primary">
            <div class="panel-heading">Enter Medicine Details</div>
            <div class="panel-body">
            <?php
              if(isset($_GET['update'])){
                if(isset($_GET['id'])){
                  $id = $_GET['id'];
                }
                // php 7
                // $id = $_GET['id'] ?? null;
                $where = array(
                  'id' => $id
                );
                $row = $obj->select_record("medicines", $where);
            ?>
              <form action="action.php" method="POST">
                <table class="table table-hover">
                  <tr>
                    <td><input type="hidden"  name="id" value="<?php echo $row['id']; ?>"></td>
                  </tr>
                  <tr>
                    <td>Medicine Name</td>
                    <td><input type="text" class="form-control" name="name" placeholder="Enter Medicine Name" value="<?php echo $row['medicine_name']; ?>"></td>
                  </tr>
                  <tr>
                    <td>Quantity</td>
                    <td><input type="number" class="form-control" name="quantity" placeholder="Enter Quantity" value="<?php echo $row['quantity']; ?>"></td>
                  </tr>
                  <tr>
                    <td colspan="2" align="center"><input type="submit" class="btn btn-primary" name="edit" value="Update"></td>
                  </tr>
                </table>
              </form> 
            <?php
              }else{
            ?>
              <form action="action.php" method="POST">
                <table class="table table-hover">
                  <tr>
                    <td>Medicine Name</td>
                    <td><input type="text" class="form-control" name="name" placeholder="Enter Medicine Name"></td>
                  </tr>
                  <tr>
                    <td>Quantity</td>
                    <td><input type="number" class="form-control" name="quantity" placeholder="Enter Quantity"></td>
                  </tr>
                  <tr>
                    <td colspan="2" align="center"><input type="submit" class="btn btn-primary" name="submit" value="Submit"></td>
                  </tr>
                </table>
              </form>  
            <?php
              }
            ?>          
            </div>
          </div>
        </div>
      </div> 
    </div>

    <div class="container">
      <div class="row">
        <div class="col-md-8 col-md-offset-2">
          <table class="table table-bordered">
            <tr>
              <th>#</th>
              <th>Medicine Name</th>
              <th>Available Stock</th>
              <th>&nbsp;</th>
              <th>&nbsp;</th>
            </tr>
            <?php
              $myRow = $obj->fetch_record("medicines");
              foreach($myRow as $row){
                // BREAKING POINT
            ?>
                <tr>
                  <td><?php echo $row['id']; ?></th>
                  <td><?php echo $row['medicine_name']; ?></th>
                  <td><strong><?php echo $row['quantity']; ?></strong></th>
                  <td><a href="index.php?update=1&id=<?php echo $row['id']; ?>" class="btn btn-info">Edit</a></th>
                  <td><a href="action.php?delete=1&id=<?php echo $row['id']; ?>" class="btn btn-danger">Delete</a></th>
                </tr>
            <?php
              }
            ?>
            
          </table>
        </div>
      </div>
    </div>


    <div class="container">
      <div class="row">
        <div class="col-md-4 col-md-offset-4" style="text-align:center">
          <a href="index.php">Index</a>
          <a href="action.php">Action</a>     
        </div>
      </div>
    </div>

  </body>
</html>