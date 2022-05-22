<?php
include 'inc/header.php';
 
//jeff
/*
Page code: 4.1
Who can access: Tenant
Description: The page where user lands after login.
*/

//customer_only();


// select all consignment stores if they have at least 1 active product.
/*$qs = "select consignmentstore.consignmentStoreID, count(*) as p, consignmentStore.consignmentStoreName from consignmentstore inner join goods
on consignmentStore.consignmentStoreID = goods.consignmentStoreID and goods.status = 1
group by goods.consignmentStoreID";

$query = mysqli_query($conn, $qs) or die(mysqli_error($conn));*/

print("

<div class='container'>
<div class='row'>
<div class='col-12 my-2'>
<h4 class='text-secondary'>View Attendance</h4>
</div>
</div>
</div>

<div class='container'>




<div class='row mt-3'>
<table class='table table-hover'>
<tr>
<th>Lesson</th>
<th>Class</th>
<th>Attendance</th>
<th>Is Late</th>
<th></th>
</tr>
");
		$sql="SELECT lesson ,name ,arrival_time, is_late FROM class_category ,student_attendance,timetable,class
		WHERE timetable.timetable_ID = student_attendance.timetable_ID AND class.category_ID = class_category.category_ID AND timetable.class_ID=class.class_ID 
		AND student_attendance.student_ID ='".$_SESSION['student_ID']."'";
		$query = mysqli_query($conn, $sql)or die(mysqli_error($conn));

		if (mysqli_num_rows($query) > 0){
		while($result = mysqli_fetch_assoc($query)){
		if ($result['is_late'] == NULL) {
  			$status_text = "Absent";
			$status_context = "muted";
		}else if ($result['is_late'] == 0){
  			$status_text = "Arrived";
			$status_context = "success";
		}else {
  			$status_text = "Late";
			$status_context = "warning";
		}
		printf("
		<tr>
		<td>%s</td>
		<td>%s</td>
		<td>%s</td>
		<td><span class='badge badge-$status_context'>$status_text</span></td>
		
		</tr>
		", $result['lesson'] ,$result['name'] ,$result['arrival_time'] ,(($result['is_late'] == NULL)? ('') : (($result['is_late'] == 0)? ('ONTIME') : ('LATE'))));
	}
} else {
	echo "Not found";
}
//<td><a href='list-attendance.php'> Details</a></td>
print("
</table>
</div>
</div>
");
?>

<?php
include 'inc/footer.php';
?>
