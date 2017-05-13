<!DOCTYPE html>

<?php

  include_once("inc/functions.php");

  if($_SERVER["REQUEST_METHOD"] == "GET") {

    if($_GET["id"]==null) {
        header("location:/crud");
        exit;
    }

    $id = filter_input(INPUT_GET,"id",FILTER_SANITIZE_NUMBER_INT);
    $student = getStudent($id);

  }

  else if($_SERVER["REQUEST_METHOD"] == "POST") {

    $studentID = filter_input(INPUT_POST,"studentid",FILTER_SANITIZE_NUMBER_INT);
    $newFirstName = filter_input(INPUT_POST,"firstname",FILTER_SANITIZE_STRING);
    $newLastName = filter_input(INPUT_POST,"lastname",FILTER_SANITIZE_STRING);
    $newEmail = filter_input(INPUT_POST,"email",FILTER_SANITIZE_EMAIL);
    $newCourse = filter_input(INPUT_POST,"course",FILTER_SANITIZE_STRING);

    updateStudent($studentID, $newFirstName, $newLastName, $newEmail, $newCourse);

  }

 ?>


<html>
  <head>
    <title> Edit </title>
    <link rel="stylesheet" href="css/main.css">
    <link href="https://fonts.googleapis.com/css?family=News+Cycle" rel="stylesheet">
  </head>

  <body>

    <div>
      <form action="edit.php" method="POST">
        <label for="firstname">First Name: </label>
        <input type="text" id="firstname" name="firstname" value="<?php echo $student["first_name"]; ?>">

        <label for="lastname">Last Name: </label>
        <input type="text" id="lastname" name="lastname" value="<?php echo $student["last_name"]; ?>">

        <label for="email">Email: </label>
        <input type="email" id="email" name="email" value="<?php echo $student["email"]; ?>">

        <input style="display:none" type="number" name="studentid" value="<?php echo $id ?>">
        <label for="course">Course: </label>
        <select id="course" name="course">
          <option value="Bachelor of Science in Information Technology">Bachelor of Science in Information Technology</option>
          <option value="Bachelor of Science in Computer Science ">Bachelor of Science in Computer Science </option>
        </select>
        <input type="submit" value="UPDATE">

      </form>
      <a href="index.php">Cancel</a>
    </div>
    
  </body>
</html>
