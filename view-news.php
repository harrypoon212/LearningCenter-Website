<?php
include 'inc/header.php';

/*
Page code: 4.1
Who can access: Tenant
Description: The page where user lands after login.
*/

//customer_only();

//joey  daniel beeno
// select all consignment stores if they have at least 1 active product.
$qs = "select * from timetable
	inner join teacher on timetable.teacher_ID = teacher.teacher_ID
	where staff_ID = '$_SESSION[staff_ID]' and is_accept='0'";

$query = mysqli_query($conn, $qs) or die(mysqli_error($conn));

if(isset($choice)){
	if($choice == 'Yes'){
		$qs = "UPDATE timetable SET is_accept='2' where timetable_ID='$timetable_ID'";
		$error_message.= $qs ."<br>";
		$query = mysqli_query($conn, $qs);
		if (mysqli_error($conn)) {
			$error_message.=mysqli_error($conn);
		} else {
			header("Location: view-news.php");
		}
	}else
	{
		$qs = "UPDATE timetable SET is_accept='1' where timetable_ID='$timetable_ID'";
		$error_message.= $qs ."<br>";
		$query = mysqli_query($conn, $qs);
		if (mysqli_error($conn)) {
			$error_message.=mysqli_error($conn);
		} else {
			header("Location: view-news.php");
		}
}
}

print("

<div class='container'>
<div class='row'>
<div class='col-12 my-2'>
<h4 class='text-secondary'>View News</h4>
</div>
</div>
</div>
<form method='get'>
<div class='container'>

<div class='row mt-3'>

<table class='table table-hover'>
<tr>
<th>Timetable ID</th>
<th>Class ID</th>
<th>Teacher ID</th>
<th>Manager ID</th>
<th></th>

</tr>
	
");

if (mysqli_num_rows($query) > 0){
	while($result = mysqli_fetch_assoc($query)){
		print("
		
	
		<tr>
		<td>$result[timetable_ID]</td>
		<td>$result[class_ID]</td>
		<td>$result[teacher_ID]</td>
		<td>$result[manager_ID]</td>
		<td><a href='accept-class.php?timetable_ID=$result[timetable_ID]'>Details</a></td>
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
</form>
");
?>

<?php
include 'inc/footer.php';
?>
