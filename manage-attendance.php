<?php
include 'inc/header.php';
?>

//jeff beeno
<script>
function stArr(checkBox, stid, workTime){
		
		var time = moment().format('YYYY-MM-DD HH:mm:ss');
		//dateformat 24hours
		var checkBox = document.getElementById(checkBox.id);
		

		
		if(checkBox.checked == true){
			workTime = moment(workTime);
			document.getElementById(stid + 'aT').innerHTML = time;
			document.getElementById(stid + 'sT').value = time;
				
			if((workTime.diff(time, 'minutes')) >= 0){
			document.getElementById(stid + 'isLate').innerHTML	 = 'ONTIME';
			document.getElementById(stid + 'isLate').style.background = 'lime';
			document.getElementById(stid + 'iL').value = '0';
			}else{
			document.getElementById(stid + 'isLate').innerHTML = 'LATE';
			document.getElementById(stid + 'isLate').style.background = 'red';
			document.getElementById(stid + 'iL').value = '1';
			}
			
		}else{
			document.getElementById(stid + 'aT').innerHTML = '';
			document.getElementById(stid + 'isLate').innerHTML = '';
			document.getElementById(stid + 'isLate').style.background = 'transparent';
			
			document.getElementById(stid + 'sT').value = '';
			}
		}
</script>
<?php
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
if(isset($_GET["timetable_ID"])){
	$timetable_ID = $conn->real_escape_string($_GET["timetable_ID"]);
	$sql = "select a.timetable_ID, a.class_StartTime, b.name from timetable as a join class_category as b join class as c on c.category_ID = b.category_ID and a.class_ID = c.class_ID where a.timetable_ID = '" . $timetable_ID . "'";
	$query = mysqli_query($conn, $sql)or die(mysqli_error($conn));
	$result = mysqli_fetch_assoc($query);
	$array = array('timetable_ID'=>$result['timetable_ID'], 'class_StartTime'=>$result['class_StartTime'], 'name'=>$result['name']);
	$class_StartTime = $array['class_StartTime'];
	$name = $array['name'];
}
if($_SERVER['REQUEST_METHOD'] == 'POST'){
	extract($_POST);
	foreach($studentID as $value){
		$sT = $value . "sT";
		$iL = $value . "iL";
		$sql = "select * from student_attendance where student_ID = '" . $value . "' and (SD_Date like '%" . date("Y-m-d") . "%' and timetable_ID = '" . $timetable_ID ."')";
		$query = mysqli_query($conn, $sql) or die(mysqli_error($conn));
		//insert data for update
		if(mysqli_num_rows($query) == 0){
			$sql = "INSERT INTO student_attendance (student_ID, timetable_ID, SD_Date) VALUES ('". $value ."', '". $timetable_ID ."', '" . date("Y-m-d") . "')";
			$query = mysqli_query($conn, $sql) or die(mysqli_error($conn));
		}

		if(!empty($$sT)){
			$sql = "update student_attendance set arrival_time = '" . $$sT . "', is_late = '" . $$iL . "' where student_ID = '" . $value . "' and (SD_Date like '%" . date("Y-m-d") . "%' and timetable_ID = '" . $timetable_ID ."')";
			$query = mysqli_query($conn, $sql) or die(mysqli_error($conn));
		}
		echo '<script>console.log("isLate : ' . $$iL . '");</script>';
		
	}
	
}

print("

<div class='container'>
<div class='row'>
<form class='row' method='post' action='manage-attendance.php?timetable_ID=$timetable_ID'>
<div class='col-12 my-2'>
<h4 class='text-secondary'>Manage Attendance - $array[name] ($class_StartTime)</h4>
</div>
</div>
</div>

<div class='container'>

<div class='row'>
		<div class='col-12 text-secondary'>
		<a href='manage-course.php' class='btn btn-default'>Return</a>
		<input type='submit' class='btn btn-default' value='Submit'><br>
		</div>
		</div>



<div class='container'>

<div class='row mt-3'>
<table class='table table-hover'>
<tr>
<th>Student ID</th>
<th>Student Name</th>
<th>Arrived Time</th>
<th>Arrived</th>
<th>Is Late</th>
</tr>
");
$sql = "select a.student_ID, a.is_late, a.arrival_time, b.student_name, c.class_StartTime from student_attendance as a join student as b join timetable as c on (a.student_ID = b.student_ID and a.timetable_ID = c.timetable_ID) where a.timetable_ID = '" . $timetable_ID . "'";
$query = mysqli_query($conn, $sql)or die(mysqli_error($conn));
if (mysqli_num_rows($query) > 0){
	while($result = mysqli_fetch_assoc($query)){
		printf('
		<tr>
		<td>%1$s</td>
		<td>%2$s</td>
		<input type="hidden" name="studentID[]" value="%1$s">
		<td id=%1$saT>%5$s</td>
		
		<td><label><input type="checkbox" class="cb" id="%1$scb" onChange="stArr(this, \'%1$s\', \'%3$s\');"%4$s/>Arrived</label></td>
		<input type="hidden" id="%1$ssT" name="%1$ssT" value="">
		<input type="hidden" id="%1$siL" name="%1$siL" value="">
		<td id=%1$sisLate %6$s>%7$s</td>
		</tr>
		', $result['student_ID'], $result['student_name'], $result['class_StartTime'], (isset($result['arrival_time'])? 'disabled' : ''),
		$result['arrival_time'], 
		(($result['is_late'] == NULL)? ('') : (($result['is_late'] == 0)? ('style=background-color:lime') : ('style=background-color:red'))), //1
		(($result['is_late'] == NULL)? ('') : (($result['is_late'] == 0)? ('ONTIME') : ('LATE'))));
	}
}else{
	$sql = "select b.student_ID, b.student_name, c.class_StartTime from enrollment as a join student as b join timetable as c on a.class_ID = c.class_ID and a.student_ID = b.student_ID where c.timetable_ID = '" . $timetable_ID . "'";
	$query = mysqli_query($conn, $sql)or die(mysqli_error($conn));

if (mysqli_num_rows($query) > 0){
	while($result = mysqli_fetch_assoc($query)){
		printf('
		<tr>
		<td>%1$s</td>
		<td>%2$s</td>
		<input type="hidden" name="studentID[]" value="%1$s">
		<td id=%1$saT></td>
		
		<td><label><input type="checkbox" class="cb" id="%1$scb" onChange="stArr(this, \'%1$s\', \'%3$s\');" %4$s/>Arrived</label></td>
		<input type="hidden" id="%1$ssT" name="%1$ssT" value="">
		<input type="hidden" id="%1$siL" name="%1$siL" value="">
		<td id=%1$sisLate></td>
		</tr>
		', $result['student_ID'], $result['student_name'], $result['class_StartTime'], (date_format(date_create($result['class_StartTime']),"Y-m-d") == date('Y-m-d'))? ('') : ('disabled'));
		}
	}
}


print("
</table>
</form>
</div>
</div>
");
?>

<?php
include 'inc/footer.php';
?>
