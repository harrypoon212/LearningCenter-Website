<?php
include 'inc/header.php';

/*
Page code: 6.1
Who can access: Customer
Description: Customer can edit their profile.
*/
//harry
student_only();


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
	$is_valid = true;
	extract($_POST);
	$staff_ID = $_SESSION[staff_ID];

	if(!isset($staff_email) || $staff_email==''){
		$is_valid = false;
		$error_message.="Email is missing<br>";
	}

	if(!isset($staff_phoneNo) || $staff_phoneNo==''){
		$is_valid = false;
		$error_message.="PhoneNo is missing<br>";
	}
	
	if(!isset($staff_description) || $staff_description==''){
	$is_valid = false;
	$error_message.="Description is missing<br>";
	}

	if($is_valid){
		$staff_email = $conn->real_escape_string($staff_email);
		$staff_phoneNo = $conn->real_escape_string($staff_phoneNo);
		$staff_description = $conn->real_escape_string($staff_description);

		$qs = "UPDATE staff SET staff_email = '$staff_email', staff_phoneNo = '$staff_phoneNo', staff_description = '$staff_description' where staff_ID = '$staff_ID';";
		$error_message.= $qs ."<br>";
		$query = mysqli_query($conn, $qs);

		if (mysqli_error($conn)) {
			$error_message.=mysqli_error($conn);
		} else {
			header("Location: view-profile-s.php");
		}
	}
}

$qs = "SELECT * FROM staff where staff_ID = '$_SESSION[staff_ID]'";
$query = mysqli_query($conn, $qs) or die(mysqli_error($conn));

$staff = mysqli_fetch_assoc($query);

extract($staff);

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
<a href='view-profile-s.php' class='btn btn-default'>Return</a>
</div>
</div>


<div class='row mt-3'>
<div class='col-12 col-sm-3'>
ID
</div>
<div class='col-12 col-sm-8 text-secondary font-weight-bold'>
<!-- This cannot be changed -->
$staff_ID
</div>
</div>

<div class='row mt-3'>
<div class='col-12 col-sm-3'>
Name
</div>
<div class='col-12 col-sm-8 text-secondary font-weight-bold'>
<!-- This cannot be changed -->
$staff[staff_name]
</div>
</div>


<div class='row mt-3'>
<div class='col-12 col-sm-3'>
Email
</div>
<div class='col-12 col-sm-8 text-secondary font-weight-bold'>
<input type='text' class='form-control' name='staff_email' value='$staff_email' required>
</div>
</div>

<div class='row mt-3'>
<div class='col-12 col-sm-3'>
PhoneNo
</div>
<div class='col-12 col-sm-8 text-secondary font-weight-bold'>
<input type='text' class='form-control' name='staff_phoneNo' value='$staff_phoneNo' required>
</div>
</div>

<div class='row mt-3'>
<div class='col-12 col-sm-3'>
Type 
</div>
<div class='col-12 col-sm-8 text-secondary font-weight-bold'>
<!-- This cannot be changed -->
$staff[job_type]
</div>
</div>

<div class='row mt-3'>
<div class='col-12 col-sm-3'>
Salary
</div>
<div class='col-12 col-sm-8 text-secondary font-weight-bold'>
<!-- This cannot be changed -->
$staff[salary]
</div>
</div>

<div class='row mt-3'>
<div class='col-12 col-sm-3'>
Description
</div>
<div class='col-12 col-sm-8 text-secondary font-weight-bold'>
<input type='text' class='form-control' name='staff_description' value='$staff_description' required>
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
