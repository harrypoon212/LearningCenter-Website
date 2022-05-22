<?php
include 'inc/header.php';

/*
Page code: 6.1
Who can access: Customer
Description: Customer can edit their profile.
*/
//beeno
teacher_only();
staff_only();
manager_only();


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
	$is_valid = true;
	extract($_POST);
	$student_ID = $_SESSION[student_ID];

	if(!isset($student_email) || $student_email==''){
		$is_valid = false;
		$error_message.="Email is missing<br>";
	}

	if(!isset($student_phoneNo) || $student_phoneNo==''){
		$is_valid = false;
		$error_message.="PhoneNo is missing<br>";
	}

	if($is_valid){
		$student_email = $conn->real_escape_string($student_email);
		$student_phoneNo = $conn->real_escape_string($student_phoneNo);

		$qs = "UPDATE student SET student_email = '$student_email', student_phoneNo = '$student_phoneNo' where student_ID = '$student_ID';";
		$error_message.= $qs ."<br>";
		$query = mysqli_query($conn, $qs);

		if (mysqli_error($conn)) {
			$error_message.=mysqli_error($conn);
		} else {
			header("Location: view-profile.php");
		}
	}
}

$qs = "SELECT * FROM student where student_ID = '$_SESSION[student_ID]'";
$query = mysqli_query($conn, $qs) or die(mysqli_error($conn));

$student = mysqli_fetch_assoc($query);

extract($student);

print_error_message($error_message);

print("

<div class='container'>
<div class='row'>
<div class='col-12 my-2'>
<h4 class='text-secondary'>Update profile</h4>
</div>
</div>
</div>


<form method='post'>

<div class='container'>
<div class='row'>
<div class='col-12'>
<a href='view-profile.php' class='btn btn-default'>Return</a>
</div>
</div>


<div class='row mt-3'>
<div class='col-12 col-sm-3'>
ID
</div>
<div class='col-12 col-sm-8 text-secondary font-weight-bold'>
<!-- This cannot be changed -->
$student_ID
</div>
</div>

<div class='row mt-3'>
<div class='col-12 col-sm-3'>
Name
</div>
<div class='col-12 col-sm-8 text-secondary font-weight-bold'>
<!-- This cannot be changed -->
$student[student_name]
</div>
</div>

<div class='row mt-3'>
<div class='col-12 col-sm-3'>
PhoneNo
</div>
<div class='col-12 col-sm-8 text-secondary font-weight-bold'>
<input type='text' class='form-control' name='student_phoneNo' value='$student_phoneNo' required>
</div>
</div>

<div class='row mt-3'>
<div class='col-12 col-sm-3'>
Email
</div>
<div class='col-12 col-sm-8 text-secondary font-weight-bold'>
<input type='text' class='form-control' name='student_email' value='$student_email' required>
</div>
</div>

<div class='row mt-3'>
<div class='col-12 col-sm-3'>
Date of Birth 
</div>
<div class='col-12 col-sm-8 text-secondary font-weight-bold'>
<!-- This cannot be changed -->
$student[student_dateOfBirth]
</div>
</div>

<div class='row mt-3'>
<div class='col-12 col-sm-3'>
Full Marks
</div>
<div class='col-12 col-sm-8 text-secondary font-weight-bold'>
<!-- This cannot be changed -->
$student[fullmark]
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
