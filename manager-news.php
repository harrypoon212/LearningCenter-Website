<?php
include 'inc/header.php';




//daniel joey
/*
Page code: 4.1
Who can access: Tenant
Description: The page where user lands after login.
*/

//customer_only();


// select all consignment stores if they have at least 1 active product.
	$qs = "select * from timetable
	inner join manager on timetable.center_ID = manager.center_ID
	where staff_ID = '$_SESSION[staff_ID]'";

$query = mysqli_query($conn, $qs) or die(mysqli_error($conn));

print("

<div class='container'>
<div class='row'>
<div class='col-12 my-2'>
<h4 class='text-secondary'>Manager News</h4>
</div>
</div>
</div>

<div class='container'>

<div class='row mt-3'>
<table class='table table-hover'>
<tr>
<th>Class ID</th>
<th>Teacher ID</th>
<th>Start Time</th>
<th>End Time</th>
<th>Is Accept</th>
</tr>
");

if (mysqli_num_rows($query) > 0){
	while($result = mysqli_fetch_assoc($query)){
		switch ($result["is_accept"]){
			case 1:
			$status_text = "No";
			$status_context = "warning";
			break;
			case 2:
			$status_text = "Yes";
			$status_context = "success";
			break;
			default:
			$status_text = "Not Accept";
			$status_context = "muted";
			break;
		}
		print("
		<tr>
		<td>$result[class_ID]</td>
		<td>$result[teacher_ID]</td>
		<td>$result[class_StartTime]</td>
		<td>$result[class_EndTime]</td>
		<td><span class='badge badge-$status_context'>$status_text</span></td>
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
