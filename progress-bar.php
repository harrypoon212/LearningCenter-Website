<link rel="stylesheet" href="css/ProgressBar.css">

<?php
include 'inc/header.php';
//peter sam//

/*student login page/*
/*
Page code: 4.1
Who can access: Tenant
Description: The page where user lands after login.
*/

//customer_only();


// select all consignment stores if they have at least 1 active product.
/*$qs = "select consignmentstore.consignmentStoreID, count(*) as p, consignmentStore.consignmentStoreName from consignmentstore inner join goods
on consignmentStore.consignmentStoreID = goods.consignmentStoreID and goods.status = 1
group by goods.consignmentStoreID";

$query = mysqli_query($conn, $qs) or die(mysqli_error($conn));*/

print("

<div class='container'>
<div class='row'>
<div class='col-12 my-2'>
<h4 class='text-secondary'>Progress Bar</h4>
</div>
</div>
</div>
<div class='container'>
<div class='row'>
<div class='col-12'>
	<a href='view-profile.php' class='btn btn-default'>Return</a>
</div>
</div>
</div>");

print("
<div class='container'>
<div class='row'>
<div class='col-12 my-2'>
<table class='table table-hover'>
<tr>
		<td></td>
		<td></td>
		<td><a style='font-size:1rem;'>Color Specification : </a>
		<a style='font-size:1rem; color:red;'>&#9679;Late</a>
		<a style='font-size:1rem; color:green;'>&#9679;Ontime</a>
		<a style='font-size:1rem; color:silver;'>&#9679;Absent</a></td>
		</tr>
<tr>
<th><h5 class='text-secondary'>Class Name</h5></th>
<th><h5 class='text-secondary'>Class ID</h5></th>
<th><h5 class='text-secondary'>Progress Bar</h5></th>
</tr>
");
    $sql5="select DISTINCT class_ID from timetable,student_attendance 
		where timetable.timetable_ID=student_attendance.timetable_ID AND
		student_attendance.student_ID='$_SESSION[student_ID]'";
	  	$query5 = mysqli_query($conn, $sql5)or die(mysqli_error($conn));

    while($result5=mysqli_fetch_array($query5)){
	$a=0;
	$sql="select *  from student_attendance,student,timetable,class,class_category
    WHERE student.student_ID=student_attendance.student_ID AND 
    timetable.timetable_ID=student_attendance.timetable_ID AND
    timetable.class_ID=class.class_ID AND
    class.category_ID=class_category.category_ID AND
	timetable.class_ID=".$result5[$a]." AND
    student_attendance.student_ID='$_SESSION[student_ID]'";
    
	$query = mysqli_query($conn, $sql)or die(mysqli_error($conn));
	$result=mysqli_fetch_assoc($query);
	
	echo"
		<tr>
		<td>$result[name]</td>
		<td>$result[class_ID]</td>
		<td>
		<div class='scrollmenu'>
		<ol class='progtrckr' data-progtrckr-steps='$result[total_lessons]'>";

	    $i = 1;
	    while($result){
		$sql2="select student_attendance.is_late from student_attendance,timetable where timetable.timetable_ID=student_attendance.timetable_ID AND
		timetable.class_ID = $result[class_ID] AND student_ID = '".$_SESSION['student_ID']."' AND lesson = ". $i ;
		$query2 = mysqli_query($conn, $sql2)or die(mysqli_error($conn));
	    $result2 = mysqli_fetch_assoc($query2);
		
		if($result2['is_late']==null){
		echo "<li class='progtrckr-todo'>Lesson". $i ."</li>";
		}else if($result2['is_late']==1){
		echo "<li class='progtrckr-late'>Lesson". $i ."</li>";
		}else if($result2['is_late']==0){	
		echo "<li class='progtrckr-done'>Lesson". $i ."</li>";
		}
		
		$sql3=" select count(student_ID) as numOfRecord from student_attendance,timetable where timetable.timetable_ID=student_attendance.timetable_ID AND
		class_ID = $result[class_ID] AND student_ID = '".$_SESSION['student_ID']."'";
		$query3 = mysqli_query($conn, $sql3)or die(mysqli_error($conn));
	    $result3=mysqli_fetch_assoc($query3);
		
		
		
		$i++;
		if($i>$result3['numOfRecord']){
			break;
		}
		}
		for($j=$i ; $j<=$result['total_lessons']; $j++){
			echo "<li class='progtrckr-todo'>Lesson". $j ."</li>";
		}
		echo"
		</ol>
        </div>
		</td>
		</tr>
		";
		
		$a++;
	
	

}
		
	

print("
</table>
</div>
</div>
</div>
");
?>

<?php
include 'inc/footer.php';
?>
