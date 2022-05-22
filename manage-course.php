<?php
include 'inc/header.php';

/*
Page code: 4.1
Who can access: Tenant
Description: The page where user lands after login.
*/

//customer_only();

//harry joey
// select all consignment stores if they have at least 1 active product.
$qs = "select *from timetable
inner join class on class.class_ID = timetable.class_ID
inner join class_category on class_category.category_ID = class.category_ID
inner join teacher_class ON class.class_ID = teacher_class.class_ID
inner join teacher ON teacher_class.teacherID = teacher.teacher_ID
where staff_ID = '$_SESSION[staff_ID]' and is_accept = '2'";

$query = mysqli_query($conn, $qs) or die(mysqli_error($conn));

print("

<div class='container'>
<div class='row'>
<div class='col-12 my-2'>
<h4 class='text-secondary'>Manage Course</h4>
</div>
</div>
</div>

<div class='container'>

<div class='row mt-3'>
<table class='table table-hover'>
<tr>
<th>Timetable ID</th>
<th>Class ID</th>
<th>Class Name</th>
<th>Time</th>
<th>Course Online</th>
<th></th>
</tr>
");

if (mysqli_num_rows($query) > 0){
	while($result = mysqli_fetch_assoc($query)){
		if ($result['is_online'] == 0) {
  			$status_text = "No";
			$status_context = "warning";
		}else{
  			$status_text = "Yes";
			$status_context = "success";
		}
		printf("
		<tr>
		<td>$result[timetable_ID]</td>
		<td>$result[class_ID]</td>
		<td>$result[name]</td>
		<td>$result[class_StartTime] - $result[class_EndTime]</td>
		<td><span class='badge badge-$status_context'>$status_text</span></td>
		<td><a href='manage-attendance.php?timetable_ID=$result[timetable_ID]'>Attendance</a></td>
		</tr>
		");
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
