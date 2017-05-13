<?php

  include("inc/functions.php");

  if($_GET["id"]==null) // can also be  empty($_GET["id"]) {
    header("location:index.php");
    exit;
  }

  if(isset($_GET["id"])){
    $id = $_GET["id"];
    deleteStudent($id);
  }


 ?>
