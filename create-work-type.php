<?php
include 'inc/header.php';
//beeno
/*
Page code: 6.1
Who can access: Customer
Description: Customer can edit their profile.
*/

/*teacher_only();
staff_only();
manager_only();*/

$name = $conn->real_escape_string($_GET["name"]);
$class_ID = $conn->real_escape_string($_GET["class_ID"]);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
	$is_valid = true;
	extract($_POST);

	if(!isset($work_No) || !$work_No){
		$is_valid = false;
		$error_message.="Work No. is missing<br>";
	}

	if(!isset($work_name) || !$work_name){
		$is_valid = false;
		$error_message.="Work Name is missing<br>";
	}
	
		if(!isset($work_type) || !$work_type){
		$is_valid = false;
		$error_message.="Work Type is missing<br>";
	}

	if($is_valid){
		$staff_ID = $_SESSION["staff_ID"];
		$work_No = $conn->real_escape_string($work_No);
		$work_name = $conn->real_escape_string($work_name);
		$work_type = $conn->real_escape_string($work_type);

		$qs = "INSERT INTO homework(class_ID, work_No, work_name, work_type) VALUES ('$class_ID', '$work_No', '$work_name', '$work_type')";
		$error_message.= $qs ."<br>";
		$query = mysqli_query($conn, $qs);

		$qs="select max(homework_ID) from homework";
		$query = mysqli_query($conn, $qs) or die(mysqli_error($conn));
		$works = mysqli_fetch_assoc($query);
		$work = $works['max(homework_ID)'];

		$qs = "select *  from enrollment WHERE class_ID = '$class_ID'";
		$error_message.= $qs ."<br>";
		$studentQuery = mysqli_query($conn, $qs);
if (mysqli_num_rows($studentQuery) > 0){
	while($student = mysqli_fetch_assoc($studentQuery)){
	$qs = "INSERT INTO student_result(student_ID, homework_ID, marks) VALUES ('$student[student_ID]', '$work', '0')";
		$error_message.= $qs ."<br>";
		$query = mysqli_query($conn, $qs);
	
	}
}


		if (mysqli_error($conn)) {
			$error_message.=mysqli_error($conn);
		} else {
			header("Location: view-course-mark.php?name=$name&class_ID=$class_ID");
		}
	}
}

print_error_message($error_message);
$qs = "select course.course_ID, course.course_name, class_category.name, class.course_ID 
       from course
	   INNER JOIN class ON course.course_ID = class.course_ID
	   INNER JOIN class_category ON class.category_ID = class_category.category_ID
	   INNER JOIN teacher_class ON class.class_ID = teacher_class.class_ID
	   INNER JOIN teacher ON teacher_class.teacherID = teacher.teacher_ID
	   WHERE staff_ID = '$_SESSION[staff_ID]'
	   ";
$query = mysqli_query($conn, $qs) or die(mysqli_error($conn));
$result = mysqli_fetch_assoc($query);
print("
<div class='container'>
<div class='row'>
<div class='col-12 my-2'>
<h4 class='text-secondary'>Create Work</h4>
</div>
</div>
</div>


<form method='post'>

<div class='container'>
<div class='row'>
<div class='col-12'>
	<a href='view-course-mark.php?name=$name&class_ID=$class_ID' class='btn btn-default'>Return</a>
</div>
</div>


<div class='row mt-3'>
<div class='col-12 col-sm-3'>
Work No.
</div>
<div class='col-12 col-sm-8 text-secondary font-weight-bold'>
<input type='text' class='form-control' name='work_No' value='' required>
</div>
</div>

<div class='row mt-3'>
<div class='col-12 col-sm-3'>
Work Name
</div>
<div class='col-12 col-sm-8 text-secondary font-weight-bold'>
<!-- This cannot be changed -->
<input type='text' class='form-control' name='work_name' value='' required>
</div>
</div>

<div class='row mt-3'>
<div class='col-12 col-sm-3'>
Work Type
</div>
<div class='col-12 col-sm-8 text-secondary font-weight-bold'>
<input type='radio' id='Lab' name='work_type' value='Lab'>Lab
<input type='radio' id='Test' name='work_type' value='Test'>Test
<input type='radio' id='Exam' name='work_type' value='Exam'>Exam
</div>
</div>

<div class='row my-3'>
<input type='Submit' name='' value='Save' class='btn btn-default'>
</div>
</div>


</form>


");
include 'inc/footer.php';
?>
