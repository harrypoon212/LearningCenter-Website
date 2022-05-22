<?php
include 'inc/header.php';

/*
Page code: 4.1
Who can access: Tenant
Description: The page where user lands after login.
*/

//customer_only();
////daniel beeno

// select all consignment stores if they have at least 1 active product.
$qs = "select * from class
       inner join class_category on class_category.category_ID = class.category_ID
	   inner join homework on class.class_ID = homework.class_ID
	   inner join student_result on homework.homework_ID = student_result.homework_ID
	   inner join student on student_result.student_ID = student.student_ID
	   where student_result.student_ID = '$_SESSION[student_ID]'
	   ";

$query = mysqli_query($conn, $qs) or die(mysqli_error($conn));

print("

<div class='container'>
<div class='row'>
<div class='col-12 my-2'>
<h4 class='text-secondary'>View Mark</h4>
</div>
</div>
</div>

<div class='container'>


<div class='row mt-3'>
<table class='table table-hover'>
<tr>
<th>Class ID</th>
<th>Class Name</th>
<th>Full Mark</th>

<th></th>
</tr>
");

if (mysqli_num_rows($query) > 0){
	while($result = mysqli_fetch_assoc($query)){
		printf("
		<tr>
		<td>%s</td>
		<td>%s</td>
		<td>%s</td>	
		<td><a href='list-mark.php?name=$result[name]&student_ID=$result[student_ID]'>Details</a></td>
		</tr>
		", $result['class_ID'], $result['name'], $result['fullmark']);
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
