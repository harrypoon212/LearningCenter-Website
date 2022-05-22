<?php
include 'inc/header.php';
//sam 
/*
Page code: 4.1
Who can access: Tenant
Description: The page where user lands after login.
*/

//customer_only();


// select all consignment stores if they have at least 1 active product.
$qs = "select *from center";

$query = mysqli_query($conn, $qs) or die(mysqli_error($conn));

print("

<div class='container'>
<div class='row'>
<div class='col-12 my-2'>
<h4 class='text-secondary'>View Center</h4>
</div>
</div>
</div>

<div class='container'>
<div class='row mt-3'>
<table class='table table-hover'>
<tr>
<th>Center ID</th>
<th>Center Name</th>
<th>Address</th>
<th>Phone No.</th>
</tr>
");

if (mysqli_num_rows($query) > 0){
	while($result = mysqli_fetch_assoc($query)){
		printf("
		<tr>
		<td>$result[center_ID]</td>
		<td>$result[center_name]</td>
		<td>$result[center_address]</td>
		<td>$result[center_phoneNo]</td>
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
