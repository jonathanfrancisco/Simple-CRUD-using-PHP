<!DOCTYPE html>


<?php

  include("inc/functions.php");


  // IF ID IS NOT SET REDIRECT TO INDEX.PHP
  if($_GET["id"]==null) {
      header("location:/crud");
      exit;
  }

  // IF ID is set sanitize input and get student at database
  if(isset($_GET["id"])) {

    $id = filter_input(INPUT_GET,"id",FILTER_SANITIZE_STRING);
    $student = getStudent($id);
  }

 ?>

<html>
  <head>
    <title>
      Student Info
    </title>
    <link rel="stylesheet" href="css/main.css">
    <link href="https://fonts.googleapis.com/css?family=News+Cycle" rel="stylesheet">
  </head>

  <body>
    <div>

      <h1>
        Name: <?php  echo $student["first_name"]." ".$student["last_name"]; ?>
      </h1>

      <h2>
        Course: <?php echo $student["course"]; ?>
      </h2>
      <a href="index.php">Go back </a>
    </div>

  </body>
</html>
