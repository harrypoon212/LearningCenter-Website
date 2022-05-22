<?php
include 'inc/header.php';
////daniel joey
/*
Page code: 6.1
Who can access: Customer
Description: Customer can edit their profile.
*/
$name = $conn->real_escape_string($_GET["name"]);
$class_ID = $conn->real_escape_string($_GET["class_ID"]);
$homework_ID = $conn->real_escape_string($_GET["homework_ID"]);
$work_name = $conn->real_escape_string($_GET["work_name"]);
$student_ID = $conn->real_escape_string($_GET["student_ID"]);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
	$is_valid = true;
	extract($_POST);
	
	if(!isset($mark) || !$mark || $mark<0 || $mark >100){
	$is_valid = false;
	$error_message.="Mark is missing<br>";
	}
//
	if($is_valid){
		$mark = $conn->real_escape_string($mark);

		$qs = "UPDATE student_result SET marks='$mark'
		where homework_ID = '$homework_ID' AND student_ID = '$student_ID'";
		$error_message.= $qs ."<br>";
		$query = mysqli_query($conn, $qs);

		if (mysqli_error($conn)) {
			$error_message.=mysqli_error($conn);
		} else {
			header("Location: list-student-mark.php?name=$name&class_ID=$class_ID&homework_ID=$homework_ID&work_name=$work_name");
		}
	}
}


// select all consignment stores if they have at least 1 active product.
$qs = "select * from student WHERE student_ID = '$student_ID'";
$query = mysqli_query($conn, $qs) or die(mysqli_error($conn));
print_error_message($error_message);
if (mysqli_num_rows($query) > 0){
	$result = mysqli_fetch_assoc($query);

print("	
<div class='container'>
<div class='row'>
<div class='col-12 my-2'>
<h4 class='text-secondary'>Update profile</h4>
</div>
</div>
</div>




<div class='container'>
<div class='row'>
<div class='col-12'>
<a href='list-student-mark.php?name=$name&class_ID=$class_ID&homework_ID=$homework_ID&work_name=$work_name' class='btn btn-default'>Return</a>
</div>
</div>


<div class='row mt-3'>
<div class='col-12 col-sm-3'>
Student ID
</div>
<div class='col-12 col-sm-8 text-secondary font-weight-bold'>
<!-- This cannot be changed -->
$result[student_ID]
</div>
</div>

<div class='row mt-3'>
<div class='col-12 col-sm-3'>
Student Name
</div>
<div class='col-12 col-sm-8 text-secondary font-weight-bold'>
<!-- This cannot be changed -->
$result[student_name]
</div>
</div>
");
$qs = "select * from student_result
	 WHERE homework_ID = '$homework_ID' AND student_ID = '$student_ID'
	";
	$query = mysqli_query($conn, $qs) or die(mysqli_error($conn));
	$student_mark=mysqli_fetch_assoc($query);
print("	
<form method='post'>
<div class='row mt-3'>
<div class='col-12 col-sm-3'>
Mark
</div>
<div class='col-12 col-sm-8 text-secondary font-weight-bold'>
<input type='text' class='form-control' name='mark' value='$student_mark[marks]' required>
</div>
</div>


<div class='row my-3'>
<input type='Submit' name='' value='Save' class='btn btn-default'>
</div>
</div>


</form>


");
}
include 'inc/footer.php';
?>
