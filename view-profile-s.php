<?php
include 'inc/header.php';

/*
Page code:1 .4
Who can access: Customer
Description: Page where customer can edit their profile.
*/
//joey
student_only();

$qs = "SELECT * FROM staff 
 where staff_ID = '$_SESSION[staff_ID]'";
$query = mysqli_query($conn, $qs) or die(mysqli_error($conn));

$staff = mysqli_fetch_assoc($query);

extract($staff);

print("

<div class='container'>
	<div class='row'>
		<div class='col-12 my-2'>
			<h4 class='text-secondary'>View Profile - $staff[staff_name]</h4> 
		</div>
	</div>
</div>

<div class='container'>
	<div class='row'>
		<div class='col-12 col-sm-3'>
			ID
		</div>

		<div class='col-12 col-sm-8 text-secondary font-weight-bold'>
			$staff_ID
		</div>
	</div>

	<div class='row mt-3'>
		<div class='col-12 col-sm-3'>
			Name
		</div>
		<div class='col-12 col-sm-8 text-secondary font-weight-bold'>
			$staff_name
		</div>
	</div>

	<div class='row mt-3'>
		<div class='col-12 col-sm-3'>
			PhoneNo
		</div>
		<div class='col-12 col-sm-8 text-secondary font-weight-bold'>
			$staff_phoneNo
		</div>
	</div>
	
	<div class='row mt-3'>
		<div class='col-12 col-sm-3'>
			Email 
		</div>
		<div class='col-12 col-sm-8 text-secondary font-weight-bold'>
			$staff_email
		</div>
	</div>
	
	<div class='row mt-3'>
		<div class='col-12 col-sm-3'>
			Type
		</div>
		<div class='col-12 col-sm-8 text-secondary font-weight-bold'>
			$job_type
		</div>
	</div>
	
	<div class='row mt-3'>
		<div class='col-12 col-sm-3'>
			Salary
		</div>
		<div class='col-12 col-sm-8 text-secondary font-weight-bold'>
			$salary
		</div>
	</div>
	
	<div class='row mt-3'>
		<div class='col-12 col-sm-3'>
			Description
		</div>
		<div class='col-12 col-sm-8 text-secondary font-weight-bold'>
			$staff_description
		</div>
	</div>


	<div class='row my-3'>
		<div class='col-12'>
			<a href='update-profile-s.php' class='btn btn-default'>Update</a>
			<a href='change-password-s.php' class='btn btn-default ml-2'>Change password</a>");
			if($_SESSION['type'] == 'teacher'){
			$qs = "SELECT * FROM teacher 
			where staff_ID = '$_SESSION[staff_ID]'";
			$query = mysqli_query($conn, $qs) or die(mysqli_error($conn));
			$result = mysqli_fetch_assoc($query);
		if($result['is_PartTime'] == '1'){
			print("<a href='view-preferredday.php' class='btn btn-default ml-2'>View Time</a>");
			}else{print("");}
			}else{print("");}
		
	print("	
		</div>
	</div>
</div>

");

?>

<?php
include 'inc/footer.php';
?>
