<?php
include 'inc/header.php';

/*
Page code: 4.1
Who can access: Tenant
Description: The page where user lands after login.
*/

//customer_only();

//joey beeno
// select all consignment stores if they have at least 1 active product.
/*$qs = "select consignmentstore.consignmentStoreID, count(*) as p, consignmentStore.consignmentStoreName from consignmentstore inner join goods
on consignmentStore.consignmentStoreID = goods.consignmentStoreID and goods.status = 1
group by goods.consignmentStoreID";*/

$qs = "select course.course_ID, course.course_name, class_category.name, class.course_ID, class.class_ID 
       from course
	   INNER JOIN class ON course.course_ID = class.course_ID
	   INNER JOIN class_category ON class.category_ID = class_category.category_ID
	   INNER JOIN teacher_class ON class.class_ID = teacher_class.class_ID
	   INNER JOIN teacher ON teacher_class.teacherID = teacher.teacher_ID
	   INNER JOIN timetable ON timetable.teacher_ID = teacher.teacher_ID
	   WHERE staff_ID = '$_SESSION[staff_ID]' and is_accept = '2'
	   ";
$query = mysqli_query($conn, $qs) or die(mysqli_error($conn));

print("

<div class='container'>
<div class='row'>
<div class='col-12 my-2'>
<h4 class='text-secondary'>Create Mark</h4>
</div>
</div>
</div>

<div class='container'>

<div class='row mt-3'>
<table class='table table-hover'>
<tr>
<th>Course No.</th>
<th>Course Name</th>
<th>Class ID</th>
<th>Class Name</th>
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
		<td>%s</td>
		<td><a href='view-course-mark.php?name=$result[name]&class_ID=$result[class_ID]'>Details</a></td>
		</tr>",
		$result['course_ID'], $result['course_name'],$result['class_ID'], $result['name'] 
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
