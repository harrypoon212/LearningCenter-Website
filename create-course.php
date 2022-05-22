<?php
include 'inc/header.php';

/*
Page code: 4.1
Who can access: Tenant
Description: The page where user lands after login.
*/
//harry
//customer_only();
$qs = "select * from course";
$query = mysqli_query($conn, $qs) or die(mysqli_error($conn));
$num = mysqli_num_rows($query) + 1;
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
	$is_valid = true;
	extract($_POST);
	
	if(!isset($courseID) || !$courseID){
	$is_valid = false;
	$error_message.="Course ID is missing<br>";
	}
	
		if(!isset($courseName) || !$courseName){
	$is_valid = false;
	$error_message.="Course Name is missing<br>";
	}

	if($is_valid){
		$courseID = $conn->real_escape_string($courseID);
		$courseName = $conn->real_escape_string($courseName);

		$qs = "INSERT INTO course(course_ID, course_name) VALUES ('$courseID', '$courseName')";

		$error_message.= $qs ."<br>";
		$query = mysqli_query($conn, $qs);

		if (mysqli_error($conn)) {
			$error_message.=mysqli_error($conn);
		} else {
			header("Location: view-create-course.php");
		}
	}
}
print_error_message($error_message);


print("

<div class='container'>
<div class='row'>
<div class='col-12 my-2'>
<h4 class='text-secondary'>Create Course</h4>
</div>
</div>
</div>


<form method='post'>

<div class='container'>
<div class='row'>
<div class='col-12'>
	<a href='view-create-course.php' class='btn btn-default'>Return</a>
</div>
</div>


<div class='row mt-3'>
<div class='col-12 col-sm-3'>
Course ID
</div>
<div class='col-12 col-sm-8 text-secondary font-weight-bold'>
<input type='text' class='form-control' name='courseID' value='$num' required>
</div>
</div>

<div class='row mt-3'>
<div class='col-12 col-sm-3'>
Course Name
</div>
<div class='col-12 col-sm-8 text-secondary font-weight-bold'>
<input type='text' class='form-control' name='courseName' value='' required>
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
