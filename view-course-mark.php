	<?php
include 'inc/header.php';

/*
Page code: 4.1
Who can access: Tenant
Description: The page where user lands after login.
*/
//joey harry
//customer_only();

$name = $conn->real_escape_string($_GET["name"]);
$class_ID = $conn->real_escape_string($_GET["class_ID"]);
$staff_ID = $conn->real_escape_string($_SESSION["staff_ID"]);


//select all consignment stores if they have at least 1 active product.
$qs = "select *
from homework 
WHERE class_ID = '$class_ID'
";


$query = mysqli_query($conn, $qs) or die(mysqli_error($conn));

print("

<div class='container'>
<div class='row'>
<div class='col-12 my-2'>
<h4 class='text-secondary'>View Course - $name</h4>
</div>
</div>
</div>

<div class='container'>

<div class='row'>
		<div class='col-12 text-secondary'>
		<a href='create-mark.php' class='btn btn-default'>Return</a>
		<a href='create-work-type.php?name=$name&class_ID=$class_ID' class='btn btn-default'>Create</a>
		</div>
		</div>
		
<div class='row mt-3'>
<table class='table table-hover'>
<tr>
<th>Work No.</th>
<th>Name</th>
<th></th>
</tr>
");
if (mysqli_num_rows($query) > 0){

	while($result= mysqli_fetch_assoc($query)){
		printf("
		<tr>
		<td>%s</td>
		<td>%s</td>
		<td><a href='list-student-mark.php?name=$name&class_ID=$class_ID&homework_ID=$result[homework_ID]&work_name=$result[work_name]'>Details</a></td>
		</tr>", $result['work_No'], $result['work_name']
		
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
