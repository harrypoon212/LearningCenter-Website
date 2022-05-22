<?php
include 'inc/header.php';
//harry
/*
Page code: 4.1
Who can access: Tenant
Description: The page where user lands after login.
*/

//customer_only();


// select all consignment stores if they have at least 1 active product.
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
	$is_valid = true;
	extract($_POST);
	
	if(!isset($studentID) || !$studentID){
	$is_valid = false;
	$error_message.="Student ID is missing<br>";
	}
	
	if(!isset($studentname) || !$studentname){
	$is_valid = false;
	$error_message.="Student Name is missing<br>";
	}
	
	if(!isset($phoneNo) || !$phoneNo){
	$is_valid = false;
	$error_message.="Phone No. is missing<br>";
	}
	
	if(!isset($email) || !$email){
	$is_valid = false;
	$error_message.="Email is missing<br>";
	}
	
	if(!isset($joindate) || !$joindate){
	$is_valid = false;
	$error_message.="Joindate is missing<br>";
	}

	if(!isset($birth) || !$birth){
	$is_valid = false;
	$error_message.="Birth is missing<br>";
	}
	
	if(!isset($category_ID) || !$category_ID){
	$is_valid = false;
	$error_message.="Category ID is missing<br>";
	}
	
	if($is_valid){
		$studentID = $conn->real_escape_string($studentID);
		$studentname = $conn->real_escape_string($studentname);
		$phoneNo = $conn->real_escape_string($phoneNo);
		$email = $conn->real_escape_string($email);
		$joindate = $conn->real_escape_string($joindate);
		$birth = $conn->real_escape_string($birth);
		$category_ID = $conn->real_escape_string($category_ID);
 
	$qs = "select * from student ";
	$query = mysqli_query($conn, $qs) or die(mysqli_error($conn));
	$result = mysqli_fetch_assoc($query);



		$qs = "INSERT INTO student(student_ID, student_name, student_phoneNo, student_email, student_joinDate, student_dateOfBirth, student_isActive, fullmark, student_password) VALUES ('$studentID', '$studentname', '$phoneNo', '$email', '$joindate', '$birth', '1', '0', '$phoneNo')";
		$error_message.= $qs ."<br>";
		$query = mysqli_query($conn, $qs);


		$classqs = "select * from class where category_ID ='$category_ID'";
		$classquery = mysqli_query($conn, $classqs) or die(mysqli_error($conn));
		$classresult = mysqli_fetch_assoc($classquery);
		$classID = $conn->real_escape_string($classresult['class_ID']);
		$courseID = $conn->real_escape_string($classresult['course_ID']);

$qs = "INSERT INTO enrollment(course_ID, student_ID, class_ID) VALUES ('$courseID', '$studentID', '$classID')";


		$error_message.= $qs ."<br>";
		$query = mysqli_query($conn, $qs);

		if (mysqli_error($conn)) {
			$error_message.=mysqli_error($conn);
		} else {
			header("Location: view-student.php");
		}
	}
}



print_error_message($error_message);

print("

<div class='container'>
<div class='row'>
<div class='col-12 my-2'>
<h4 class='text-secondary'>Create Student</h4>
</div>
</div>
</div>


<form method='post'>

<div class='container'>
<div class='row'>
<div class='col-12'>
	<a href='view-student.php' class='btn btn-default'>Return</a>
</div>
</div>

<div class='row mt-3'>
<div class='col-12 col-sm-3'>
Student ID
</div>
<div class='col-12 col-sm-8 text-secondary font-weight-bold'>
<input type='text' class='form-control' name='studentID' value='SD'  required>
</div>
</div>

<div class='row mt-3'>
<div class='col-12 col-sm-3'>
Student Name
</div>
<div class='col-12 col-sm-8 text-secondary font-weight-bold'>
<input type='text' class='form-control' name='studentname' value=''  required>
</div>
</div>

<div class='row mt-3'>
<div class='col-12 col-sm-3'>
Phone No.
</div>
<div class='col-12 col-sm-8 text-secondary font-weight-bold'>
<input type='text' class='form-control' name='phoneNo' value=''  required>
</div>
</div>

<div class='row mt-3'>
<div class='col-12 col-sm-3'>
Email
</div>
<div class='col-12 col-sm-8 text-secondary font-weight-bold'>
<input type='text' class='form-control' pattern='[a-zA-Z0-9.-_]{1,}@[a-zA-Z.-]{2,}[.]{1}[a-zA-Z]{2,}' name='email' value=''  required>
</div>
</div>

<div class='row mt-3'>
<div class='col-12 col-sm-3'>
Join Date
</div>
<div class='col-12 col-sm-8 text-secondary font-weight-bold'>
<input type='date' class='form-control' name='joindate' value=''  required>
</div>
</div>

<div class='row mt-3'>
<div class='col-12 col-sm-3'>
Birth
</div>
<div class='col-12 col-sm-8 text-secondary font-weight-bold'>
<input type='date' class='form-control' name='birth' value='Y-m-d' required>
</div>
</div>

<div class='row mt-3'>
<div class='col-12 col-sm-3'>
Class
</div>
<div class='col-12 col-sm-8 text-secondary font-weight-bold'>
<select class='form-control' name='category_ID' id='category_ID' >
					<option value='1'>IELTS 1st Lesson</option>
					<option value='2'>DSE 1st Lesson</option>
					<option value='5'>IELTS Class</option>
					<option value='6'>IELTS VIP</option>
					<option value='7'>IELTS Marking</option>
					<option value='8'>DSE Marking</option>
					<option value='9'>DSE Skype channel</option>
					<option value='10'>DSE Eng Speaking Mock</option>
					<option value='11'>Business Eng - Accounting</option>
					<option value='12'>Business Eng - IT</option>
					<option value='13'>High Dip - English</option>
</select>
</div>
</div>
");










print("
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
