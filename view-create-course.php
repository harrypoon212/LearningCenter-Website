<?php
include 'inc/header.php';

/*
Page code: 4.1
Who can access: Tenant
Description: The page where user lands after login.
*/

//customer_only();
////daniel harry

// select all consignment stores if they have at least 1 active product.
/*$qs = "select consignmentstore.consignmentStoreID, count(*) as p, consignmentStore.consignmentStoreName from consignmentstore inner join goods
on consignmentStore.consignmentStoreID = goods.consignmentStoreID and goods.status = 1
group by goods.consignmentStoreID";

$query = mysqli_query($conn, $qs) or die(mysqli_error($conn));*/


$sql = "SELECT * FROM course ORDER BY course_ID ASC";
$query = mysqli_query($conn, $sql) or die(mysqli_error($conn));
//$rc = mysqli_fetch_assoc($rs);


print("

<div class='container'>
<div class='row'>
<div class='col-12 my-2'>
<h4 class='text-secondary'>View Course</h4>
</div>
</div>
<div class='row'>
		<div class='col-12 text-secondary'>
		<a href='create-course.php' class='btn btn-default'>Create</a>
		</div>
		</div>
</div>

<div class='container'>
<div class='row mt-3'>
<table class='table table-hover'>
<tr>
<th>Course ID</th>
<th>Course Name</th>
</tr>
");

if (mysqli_num_rows($query) > 0){
	while($result = mysqli_fetch_assoc($query)){
		printf("
		<tr>
		<td>%s</td>
		<td>%s</td>
		</tr>
		", $result['course_ID'], $result['course_name']);
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
