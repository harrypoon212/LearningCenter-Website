<?php
include 'inc/header.php';

/*
Page code: 4.1
Who can access: Tenant
Description: The page where user lands after login.
*/

//customer_only();
//harry

// select all consignment stores if they have at least 1 active product.
$qs = "select * from timetable
 inner join teacher on timetable.teacher_ID = teacher.teacher_ID
 inner join staff on staff.staff_ID = teacher.staff_ID
 where is_accept = '2'
 ";

$query = mysqli_query($conn, $qs) or die(mysqli_error($conn));

print("

<div class='container'>
<div class='row'>
<div class='col-12 my-2'>
<h4 class='text-secondary'>View Assign</h4>
</div>
</div>
<div class='row'>
		<div class='col-12 text-secondary'>
		<a href='create-assign.php' class='btn btn-default'>Create</a>
		</div>
		</div>
</div>

<div class='container'>
<div class='row mt-3'>
<table class='table table-hover'>
<tr>
<th>Class ID</th>
<th>Time</th>
<th>Room No.</th>
<th>Teacher</th>
</tr>
");

if (mysqli_num_rows($query) > 0){
	while($result = mysqli_fetch_assoc($query)){
		print("
		<tr>
		<td>$result[class_ID]</td>
		<td>$result[class_StartTime] - $result[class_EndTime]</td>
		<td>room-$result[class_room]</td>
		<td>$result[staff_name]</td>
		</tr>
		");
	
}} else {
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
