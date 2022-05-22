<?php
include 'inc/header.php';
//joey
/*
Page code:1 .4
Who can access: Customer
Description: Page where customer can edit their profile.
*/

teacher_only();
staff_only();
manager_only();

$qs = "SELECT * FROM student where student_ID = '$_SESSION[student_ID]'";
$query = mysqli_query($conn, $qs) or die(mysqli_error($conn));

$student = mysqli_fetch_assoc($query);

extract($student);

print("

<div class='container'>
	<div class='row'>
		<div class='col-12 my-2'>
			<h4 class='text-secondary'>View Profile - $student[student_name]</h4> 
		</div>
	</div>
</div>
<div class='container'>
	<div class='row my-3'>
		<div class='col-12'>
			<a href='progress-bar.php' class='btn btn-default'>Progress</a>
		</div>
	</div>
</div>
<div class='container'>
	<div class='row'>
		<div class='col-12 col-sm-3'>
			ID
		</div>

		<div class='col-12 col-sm-8 text-secondary font-weight-bold'>
			$student_ID
		</div>
	</div>

	<div class='row mt-3'>
		<div class='col-12 col-sm-3'>
			Name
		</div>
		<div class='col-12 col-sm-8 text-secondary font-weight-bold'>
			$student_name
		</div>
	</div>

	<div class='row mt-3'>
		<div class='col-12 col-sm-3'>
			PhoneNo
		</div>
		<div class='col-12 col-sm-8 text-secondary font-weight-bold'>
			$student_phoneNo
		</div>
	</div>

	<div class='row mt-3'>
		<div class='col-12 col-sm-3'>
			Email 
		</div>
		<div class='col-12 col-sm-8 text-secondary font-weight-bold'>
			$student_email
		</div>
	</div>

	<div class='row mt-3'>
		<div class='col-12 col-sm-3'>
			Date of Birth 
		</div>
		<div class='col-12 col-sm-8 text-secondary font-weight-bold'>
			$student_dateOfBirth
		</div>
	</div>

	<div class='row mt-3'>
		<div class='col-12 col-sm-3'>
			Full Marks 
		</div>
		<div class='col-12 col-sm-8 text-secondary font-weight-bold'>
			$fullmark
		</div>
	</div>

	<div class='row my-3'>
		<div class='col-12'>
			<a href='update-profile.php' class='btn btn-default'>Update</a>
			<a href='change-password.php' class='btn btn-default ml-2'>Change password</a>
			
		</div>
	</div>
</div>

");

?>

<?php
include 'inc/footer.php';
?>
