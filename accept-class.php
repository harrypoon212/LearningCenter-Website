<?php
include 'inc/header.php';

/*
Page code: 4.1
Who can access: Tenant
Description: The page where user lands after login.
*/

//customer_only();
//harry
$timetable_ID = $conn->real_escape_string($_GET["timetable_ID"]);
// select all consignment stores if they have at least 1 active product.
$qs = "select * from timetable
	inner join teacher on timetable.teacher_ID = teacher.teacher_ID
	where staff_ID = '$_SESSION[staff_ID]' ";

$query = mysqli_query($conn, $qs) or die(mysqli_error($conn));

    if (isset($_POST['yes'])) {
        		$qs = "UPDATE timetable SET is_accept='2' where timetable_ID='$timetable_ID'";
		$error_message.= $qs ."<br>";
		$query = mysqli_query($conn, $qs);
		if (mysqli_error($conn)) {
			$error_message.=mysqli_error($conn);
		} else {
			header("Location: view-news.php");
		}
    }
    elseif (isset($_POST['no'])) {
        $qs = "UPDATE timetable SET is_accept='1' where timetable_ID='$timetable_ID'";
		$error_message.= $qs ."<br>";
		$query = mysqli_query($conn, $qs);
		if (mysqli_error($conn)) {
			$error_message.=mysqli_error($conn);
		} else {
			header("Location: view-news.php");
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
<form method='post'>
<div class='container'>

<div class='row mt-3'>

<table class='table table-hover'>
<tr>
<th>Class ID</th>
<th>Teacher ID</th>
<th>Start Time</th>
<th>End Time</th>
<th>Manager ID</th>
<th>Is Accept</th>
</tr>
	
");


$result = mysqli_fetch_assoc($query);
		print("
		<tr>
		<td>$result[class_ID]</td>
		<td>$result[teacher_ID]</td>
		<td>$result[class_StartTime]</td>
		<td>$result[class_EndTime]</td>
		<td>$result[manager_ID]</td>
		<td>
		<button type='submit' name='yes'value='Yes' class='btn btn-default'>Yes</button>
		<button type='submit' name='no' value='No' class='btn btn-default'>No</button></td>
		</tr>
		
		");



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
