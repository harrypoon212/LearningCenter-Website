<?php
include 'inc/header.php';

/*
Page code: 4.1
Who can access: Tenant
Description: The page where user lands after login.
*/

//customer_only();
//joey

// select all consignment stores if they have at least 1 active product.
$qs = "select * from student
  ";

$query = mysqli_query($conn, $qs) or die(mysqli_error($conn));

print("

<div class='container'>
<div class='row'>
<div class='col-12 my-2'>
<h4 class='text-secondary'>View Student</h4>
</div>
</div>
<div class='row'>
		<div class='col-12 text-secondary'>
		<a href='create-student.php' class='btn btn-default'>Create</a>
		</div>
		</div>
</div>

<div class='container'>
<div class='row mt-3'>
<table class='table table-hover'>
<tr>
<th>Student ID</th>
<th>Student Name</th>
<th>Is Active</th>
<th>Password</th>
</tr>
");

if (mysqli_num_rows($query) > 0){
	while($result = mysqli_fetch_assoc($query)){
		if ($result['student_isActive'] == 0) {
  			$status_text = "No";
			$status_context = "warning";
		}else{
  			$status_text = "Yes";
			$status_context = "success";
		}
		print("
		<tr>
		<td>$result[student_ID]</td>
		<td>$result[student_name]</td>
		<td><span class='badge badge-$status_context'>$status_text</span></td>
		<td>$result[student_password]</td>
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
