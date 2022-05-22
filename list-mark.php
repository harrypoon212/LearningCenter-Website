<?php
include 'inc/header.php';

/*
Page code: 4.1
Who can access: Tenant
Description: The page where user lands after login.
*/

//customer_only();
//daniel joey
$name = $conn->real_escape_string($_GET["name"]);
$student_ID = $conn->real_escape_string($_GET["student_ID"]);

// select all consignment stores if they have at least 1 active product.
$qs = "select * from homework
       inner join student_result on homework.homework_ID = student_result.homework_ID
	   WHERE student_ID = '$student_ID'";

$query = mysqli_query($conn, $qs) or die(mysqli_error($conn));

print("

<div class='container'>
<div class='row'>
<div class='col-12 my-2'>
<h4 class='text-secondary'>List Marks - $name</h4>
</div>
</div>
</div>

<div class='container'>

<div class='row'>
		<div class='col-12 text-secondary'>
		<a href='view-mark.php' class='btn btn-default'>Return</a> <br><br>
		</div>
		</div>



<div class='row mt-3'>
<table class='table table-hover'>
<tr>
<th>Work No.</th>
<th>Work Name</th>
<th>Work Type</th>
<th>Marks</th>
<th>Pass / Fail</th>
</tr>
");

if (mysqli_num_rows($query) > 0){
	while($result = mysqli_fetch_assoc($query)){
if ($result['marks']<40) {
  			$status_text = "Fail";
			$status_context = "warning";
}else{
  			$status_text = "Pass";
			$status_context = "success";
}

		printf("
		<tr>
		<td>%s</td>
		<td>%s</td>
		<td>%s</td>
		<td>%s</td>
		<td><span class='badge badge-$status_context'>$status_text</span></td>
		</tr>",
		$result['work_No'], $result['work_name'], $result['work_type'], $result['marks']);
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
