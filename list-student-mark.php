<?php
include 'inc/header.php';

/*
Page code: 4.1
Who can access: Tenant
Description: The page where user lands after login.
*/

//customer_only();
$name = $conn->real_escape_string($_GET["name"]);
$class_ID = $conn->real_escape_string($_GET["class_ID"]);
$homework_ID = $conn->real_escape_string($_GET["homework_ID"]);
$work_name = $conn->real_escape_string($_GET["work_name"]);
// select all consignment stores if they have at least 1 active product.

//daniel joey
print("

<div class='container'>
<div class='row'>
<div class='col-12 my-2'>
<h4 class='text-secondary'>List Mark - $work_name</h4>
</div>
</div>
</div>

<div class='container'>

<div class='row'>
		<div class='col-12 text-secondary'>
		<a href='view-course-mark.php?name=$name&class_ID=$class_ID' class='btn btn-default'>Return</a> <br>
		</div>
		</div>
		
<div class='row mt-3'>
<table class='table table-hover'>
<tr>
<th>Student ID</th>
<th>Name</th>
<th>Mark</th>
<th></th>
</tr>
");

$qs = "select * 
       from student
	  inner join student_result on student_result.student_ID = student.student_ID
	   WHERE homework_ID = '$homework_ID'
	   ";

$query = mysqli_query($conn, $qs) or die(mysqli_error($conn));
if (mysqli_num_rows($query) > 0){



	while($result=mysqli_fetch_assoc($query)){
		printf("
		<tr>
		<td>%s</td>
		<td>%s</td>
		<td>%s</td>
		<td><a href='update-mark.php?
		name=$name 
		&class_ID=$class_ID 
		&homework_ID=$result[homework_ID]
		&work_name=$work_name
		&student_ID=$result[student_ID]
		'class='btn btn-default'>Update</a></td>
		</tr>",
		$result['student_ID'], $result['student_name'], $result['marks']
		);
	}
} else {
	echo "Not found";
}

print("
</table>
</div>
</div>
");
?>

<?php
include 'inc/footer.php';
?>
