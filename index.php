<!DOCTYPE html>

<?php
  
  include("inc/functions.php");

  $message = null;

  // for creating students
  if($_SERVER["REQUEST_METHOD"] == "POST") {

    if(empty($_POST["first_name"]) && empty($_POST["last_name"]) && empty($_POST["email"])) {
      $message = "Please, input a name and email!";
    }

    else if(!empty($_POST["firstname"]) && !empty($_POST["lastname"]) && !empty($_POST["email"])) {

      $createFirstName = filter_input(INPUT_POST,"firstname",FILTER_SANITIZE_STRING);
      $createLastName = filter_input(INPUT_POST,"lastname",FILTER_SANITIZE_STRING);
      $createEmail = filter_input(INPUT_POST,"email",FILTER_SANITIZE_EMAIL);
      $createCourse = filter_input(INPUT_POST,"course",FILTER_SANITIZE_STRING);

      insertStudent($createFirstName,$createLastName,$createEmail,$createCourse);
      $message = "Student sucessfully added";

    }
  }

  // get all students in the database
  $students = getStudents();



 ?>


<html>
  <head>
    <title>Students</title>
    <link rel="stylesheet" href="css/main.css">
    <link href="https://fonts.googleapis.com/css?family=News+Cycle" rel="stylesheet">
  </head>

  <body>

    <div>

      <?php
        if(!empty($message)) {
          echo "<h1> ".$message."</h1>";
        }
      ?>

      <form action="index.php" method="POST">
        <label for="firstname">First Name: </label>
        <input type="text" id="firstname" name="firstname">

        <label for="lastname">Last Name: </label>
        <input type="text" id="lastname" name="lastname">

        <label for="email">Email: </label>
        <input type="email" id="email" name="email">

        <label for="course">Course</label>
          <select id="course" name="course">
            <option value="Bachelor of Science in Information Technology">Bachelor of Science in Information Technology</option>
            <option value="Bachelor of Science in Computer Science ">Bachelor of Science in Computer Science </option>
          </select>
      
        <input type="submit" value="Add student">

      </form>

      <table>

        <tr>
          <th>Full name</th>
          <th>Email</th>
          <th>Course</th>
          <th>Actions</th>
        </tr>

        <?php

          foreach($students as $student) {

            $read = "read.php?id=".$student["student_id"];
            $edit = "edit.php?id=".$student["student_id"];
            $delete = "delete.php?id=".$student["student_id"];

            $html = "<tr'>
                      <td>".$student["last_name"].", ".$student["first_name"]."</td>
                      <td>".$student["email"]."</td>
                      <td>".$student["course"]."</td>
                      <td>
                        <a href='".$read."'>Read</a>
                        <a href='".$edit."'>Edit</a>
                        <a href='".$delete."'>Delete </a>
                      </td>
                    </tr>";
            echo $html;
          }

         ?>

      </table>

      <div> 

        <?php
          // if no students have been fetch then print.

          if(empty($students)) {
            echo "<tr> 
                    <td> No Students Found </td>
                  </tr>";
          }

        ?>

      </div>

    </div>

  </body>
</html>
