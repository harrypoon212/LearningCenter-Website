<?php
include 'inc/header.php';

/*
Page code: 4.1
Who can access: Tenant
Description: The page where user lands after login.
*/

//customer_only();

//harry
// select all consignment stores if they have at least 1 active product.
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
	$is_valid = true;
	extract($_POST);
	
	if(!isset($classID) || !$classID){
	$is_valid = false;
	$error_message.="Class ID is missing<br>";
	}
	
	if(!isset($lesson) || !$lesson){
	$is_valid = false;
	$error_message.="Lesson is missing<br>";
	}
	
	if(!isset($startTime) || !$startTime){
	$is_valid = false;
	$error_message.="Start Time is missing<br>";
	}
	
	if(!isset($endTime) || !$endTime){
	$is_valid = false;
	$error_message.="End Time is missing<br>";
	}
	
	if(!isset($roomNo) || !$roomNo){
	$is_valid = false;
	$error_message.="Room No. is missing<br>";
	}

	if(!isset($teacherID) || !$teacherID){
	$is_valid = false;
	$error_message.="Teacher is missing<br>";
	}
	
	if($is_valid){
		$classID = $conn->real_escape_string($classID);
		$lesson = $conn->real_escape_string($lesson);
		$startTime = $conn->real_escape_string($startTime);
		$endTime = $conn->real_escape_string($endTime);
		$roomNo = $conn->real_escape_string($roomNo);
		$teacherID = $conn->real_escape_string($teacherID);
 
	$qs = "select * from manager where staff_ID = '$_SESSION[staff_ID]'";
	$query = mysqli_query($conn, $qs) or die(mysqli_error($conn));
	$result = mysqli_fetch_assoc($query);



		$qs = "INSERT INTO timetable(class_ID, center_ID, teacher_ID, class_StartTime, class_EndTime, lesson, is_online, class_room, manager_ID, is_accept) VALUES ('$classID', '$result[center_ID]', '$teacherID', '$startTime', '$endTime', '$lesson', '0', '$roomNo', '$result[manager_ID]', '0')";

		$error_message.= $qs ."<br>";
		$query = mysqli_query($conn, $qs);

		if (mysqli_error($conn)) {
			$error_message.=mysqli_error($conn);
		} else {
			header("Location: view-assign.php");
		}
	}
}



print_error_message($error_message);

print("

<div class='container'>
<div class='row'>
<div class='col-12 my-2'>
<h4 class='text-secondary'>Create Assign</h4>
</div>
</div>
</div>


<form method='post'>

<div class='container'>
<div class='row'>
<div class='col-12'>
	<a href='view-assign.php' class='btn btn-default'>Return</a>
</div>
</div>

<div class='row mt-3'>
<div class='col-12 col-sm-3'>
Class ID
</div>
<div class='col-12 col-sm-8 text-secondary font-weight-bold'>
<input type='text' class='form-control' name='classID' value=''  required>
</div>
</div>

<div class='row mt-3'>
<div class='col-12 col-sm-3'>
Lesson
</div>
<div class='col-12 col-sm-8 text-secondary font-weight-bold'>
<input type='text' class='form-control' name='lesson' value=''  required>
</div>
</div>

<div class='row mt-3'>
<div class='col-12 col-sm-3'>
Start Time
</div>
<div class='col-12 col-sm-8 text-secondary font-weight-bold'>
<input type='datetime-local' id='startTime' name='startTime' required>
</div>
</div>

<div class='row mt-3'>
<div class='col-12 col-sm-3'>
End Time
</div>
<div class='col-12 col-sm-8 text-secondary font-weight-bold'>
<input type='datetime-local' id='endTime' name='endTime' required>
</div>
</div>

<div class='row mt-3'>
<div class='col-12 col-sm-3'>
Room No.
</div>
<div class='col-12 col-sm-8 text-secondary font-weight-bold'>
<input type='text' class='form-control' name='roomNo' value='' required>
</div>
</div>

<div class='row mt-3'>
<div class='col-12 col-sm-3'>
Teacher
</div>
<div class='col-12 col-sm-8 text-secondary font-weight-bold'>
<input type='text' class='form-control' name='teacherID' value='' required>
</div>
</div>

<div class='row my-3'>
<input type='Submit' name='' value='Save' class='btn btn-default'>
</div>
</div>


</form>

");
?>

<?php
include 'inc/footer.php';
?>
