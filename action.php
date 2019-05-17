<?php

  include "db.php";

  class DataOperation extends Database{

    public function insert_record($table, $fields){
      $sql = "";
      $sql .= "INSERT INTO " . $table;
      $sql .= " (" . implode(", ", array_keys($fields)) . ") VALUES ";
      $sql .= "('" . implode("', '", array_values($fields)) . "')";

      $query = mysqli_query($this->con, $sql);

      if($query){
        return true;
      }
    }

    public function fetch_record($table){
      $sql = "SELECT * FROM " . $table;
      $array = array();
      $query = mysqli_query($this->con, $sql);

      while($row = mysqli_fetch_assoc($query)){
        $array[] = $row;
      }

      return $array;
    }

    public function select_record($table, $where){
      $sql = "";
      $condition = "";

      foreach($where as $key => $value){
        $condition .= $key . "='" . $value . "' AND ";
      }

      $condition = substr($condition, 0, -5);
      $sql .= "SELECT * FROM " . $table . " WHERE " . $condition;
      $query = mysqli_query($this->con, $sql);
      $row = mysqli_fetch_array($query);

      return $row;
    }

    public function update_record($table, $where, $fields){
      $sql = "";
      $condition = "";

      foreach($where as $key => $value){
        $condition .= $key . "='" . $value . "' AND ";
      }

      $condition = substr($condition, 0, -5);

      foreach($fields as $key => $value){
        $sql .= $key . "='" . $value . "', ";
      }

      $sql = substr($sql, 0, -2);
      $sql = "UPDATE " .$table . " SET " . $sql . " WHERE " . $condition;

      if(mysqli_query($this->con, $sql)){
        return true;
      }
    }

    public function delete_record($table, $where){
      $sql = "";
      $condition = "";

      foreach($where as $key => $value){
        $condition .= $key . "='" . $value . "' AND ";
      }

      $condition = substr($condition, 0, -5);
      $sql = "DELETE FROM " . $table . " WHERE " . $condition;

      if(mysqli_query($this->con, $sql)){
        return true;
      }
    }

    public function truncate(){
      $sql = 'TRUNCATE TABLE medicines';
      $query = mysqli_query($this->con, $sql);
    }
  }

  $obj = new DataOperation;

  if(isset($_POST['submit'])){
    $myArray = array(
      "medicine_name" => $_POST['name'],
      "quantity" => $_POST['quantity']
    );

    if($obj->insert_record("medicines", $myArray)){
      header("location:index.php?msg=Record_Inserted");
    }
  }

  if(isset($_POST['edit'])){
    $id = $_POST['id'];

    $where = array(
      'id' => $id
    );

    $myArray = array(
      "medicine_name" => $_POST['name'],
      "quantity" => $_POST['quantity']
    );

    if($obj->update_record("medicines", $where, $myArray)){
      header("location:index.php?msg=Updated_Successfully");
    }
  }

  if(isset($_GET['delete'])){
    $id = $_GET['id'] ?? null;

    $where = array(
      'id' => $id
    );

    if($obj->delete_record("medicines", $where)){
      header("location:index.php?msg=Deleted_Successfully");
    }
  }

  // $obj->truncate();

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

    <?php 
      if(!strpos($_SERVER['REQUEST_URI'], "index.php") !== false){
        // index.php found
    ?>
        <div class="container">
          <div class="row">
            <div class="col-md-4 col-md-offset-4" style="text-align:center">
              <a href="index.php">Index</a>
              <a href="action.php">Action</a>     
            </div>
          </div>
        </div>
    <?php   
      }
    ?>

    

  </body>
  </html>
