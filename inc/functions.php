<?php
	
	include_once("database.php");

	// FETCH ALL STUDENTS IN THE DATABASE AND RETURN
	function getStudents() {

	    try {
	      $db = Database::connect();
	      $result = $db->prepare("SELECT * FROM STUDENTS ORDER BY student_id DESC");
	      $result -> execute();
	      Database::disconnect();

	    } catch(Exception $e) {
	      echo "There was an error in getting the students!";
	    }

	    $students = $result->fetchAll(PDO::FETCH_ASSOC);

	    return $students;

	}

	// FETCH A STUDENT IN THE DATABASE using $id
	function getStudent($id) {
	    
	    try {
	      $db = Database::connect();
	      $results = $db -> prepare("SELECT * FROM students WHERE student_id = :id ");
	      $results -> bindParam(":id",$id,PDO::PARAM_INT);
	      $results -> execute();
	      Database::disconnect();
	    } catch(Exception $e) {
	      echo "ERROR READ.PHP";
	    }

	    $student = $results -> fetch(PDO::FETCH_ASSOC);

	    // if the retrieve student is empty redirect to index.php
	    if(empty($student)) {
	      header("location:/crud");
	      exit;
	    }

	    return $student;

	}

	// INSERT A STUDENT IN THE DATABASE
	function insertStudent($firstname,$lastname,$email,$course) {

      try {
      	$db = Database::connect();
        $statement = $db->prepare(" INSERT INTO students VALUES(NULL,:first_name,:last_name,:email,:course) ");
        $statement->bindParam(':first_name',$firstname,PDO::PARAM_STR);
        $statement->bindParam(':last_name',$lastname,PDO::PARAM_STR);
        $statement->bindParam(':email',$email,PDO::PARAM_STR);
        $statement->bindParam(':course',$course,PDO::PARAM_STR);
        $statement->execute();
        Database::disconnect();
      } catch(Exception $e) {
        echo $e->getMessage();
      }

	}


	// DELETE A STUDENT IN THE DATABSE using $id
	function deleteStudent($id) {

	    $studentID =  filter_input(INPUT_GET,"id",FILTER_SANITIZE_NUMBER_INT);
	   
	    try {
	      $db = Database::connect();
	      $statement = $db->prepare("DELETE FROM students WHERE student_id = :id");
	      $statement->bindParam(":id",$studentID,PDO::PARAM_INT);
	      $statement->execute();
	      Database::disconnect();
	      header("location:index.php");

	    } catch(Exception $e) {
	      echo $e->getMessage();
	    }
	}

	// UPDATE STUDENT INFORMATION
	function updateStudent($studentID, $firstname,$lastname, $mail,$course) {

		try {
	      $db = Database::connect();
	      $statement = $db->prepare("UPDATE students SET first_name = :first_name, last_name = :last_name, email = :email, course = :course WHERE student_id = :student_id");
	      $statement->bindParam(':student_id',$studentID,PDO::PARAM_INT);
	      $statement->bindParam(':first_name',$firstname,PDO::PARAM_STR);
	      $statement->bindParam(':last_name',$lastname,PDO::PARAM_STR);
	      $statement->bindParam(':email',$mail,PDO::PARAM_STR);
	      $statement->bindParam(':course',$course,PDO::PARAM_STR);
	      $statement->execute();
	      Database::disconnect();

	    } catch(Exception $e) {
	      echo $e->getMessage();
	    }

	    header("location:index.php");
	    exit;

	}

	

?>