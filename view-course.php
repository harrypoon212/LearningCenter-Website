<?php
include 'inc/header.php';

/*
Page code: 4.1
Who can access: Student
Description: The page where user lands after login.
*/
//jeff beeno
//customer_only();


// Student_Course
$qs = "select * from class
       INNER JOIN course ON class.course_ID = course.course_ID
	   INNER JOIN class_category ON class.category_ID = class_category.category_ID
	   INNER JOIN enrollment ON class.course_ID = enrollment.course_ID AND enrollment.class_ID = class.class_ID
       where student_ID = '$_SESSION[student_ID]'";

$query = mysqli_query($conn, $qs) or die(mysqli_error($conn));

print("

<div class='container'>
<div class='row'>
<div class='col-12 my-2'>
<h4 class='text-secondary'>View Course</h4>
</div>
</div>
</div>

<div class='container'>




<div class='row mt-3'>
<table class='table table-hover'>
<tr>
<th>Course</th>
<th>Class</th>
</tr>
");

if (mysqli_num_rows($query) > 0){
	while($result = mysqli_fetch_assoc($query)){
		printf("
		<tr>
		<td>%s</td>
		<td>%s</td>
		</tr>
		", $result['course_name'], $result['name']);
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
