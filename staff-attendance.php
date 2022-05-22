<?php
include 'inc/header.php';
//jeff
?>
<script>		
		function showTimeArrived(checkBox, stid, workTime){
		
		var time = moment().format('YYYY-MM-DD HH:mm:ss');
		//dateformat 24hours
		var checkBox = document.getElementById(checkBox.id);
		
		if(checkBox.checked == true){
			if(checkBox.id == (stid + 'startTimeArrived')){
				document.getElementById(stid + 'arrivedTime').innerHTML = time;
				document.getElementById(stid + 'aT').value = time;
				
				
				time = (new Date().getHours() * 60) + new Date().getMinutes();
				//workTime = workTime.substring(0, 2);workTime.substring(3, 5)
				workTime = parseInt((workTime.substring(0, 2) * 60)) + parseInt((workTime.substring(3, 5))) ;
				//console.log('Time : ' + time);
				//console.log('work Time : ' + workTime);
				document.getElementById(stid + 'endTimeArrived').disabled = false;
				
				if(time < workTime){
				document.getElementById(stid + 'isLate').innerHTML	 = 'ONTIME';
				document.getElementById(stid + 'isLate').style.background = 'lime';
				document.getElementById(stid + 'iL').value = '0';
				
				}else{
				document.getElementById(stid + 'isLate').innerHTML = 'LATE';
				document.getElementById(stid + 'isLate').style.background = 'red';
				document.getElementById(stid + 'iL').value = '1';
				
				}
			}else{
				document.getElementById(stid + 'departureTime').innerHTML = time;
				document.getElementById(stid + 'dT').value = time;
				if((document.getElementById(stid +'departureTime').innerHTML != '') && (document.getElementById(stid +'arrivedTime').innerHTML != '')){
					var now = document.getElementById(stid + 'arrivedTime').innerHTML;
					var then = document.getElementById(stid + 'departureTime').innerHTML;
					var diff = moment.duration(moment(then).diff(moment(now)));
					var seconds = parseInt(diff.asSeconds());
					document.getElementById(stid + 'wH').value = seconds;
				}
			}
		}else{
			if(checkBox.id == (stid + 'startTimeArrived')){
				document.getElementById(stid + 'arrivedTime').innerHTML = '';
				document.getElementById(stid + 'departureTime').innerHTML = '';
				document.getElementById(stid + 'isLate').style.background = 'transparent';
				document.getElementById(stid + 'isLate').innerHTML = '';
				document.getElementById(stid + 'endTimeArrived').disabled = true;
				document.getElementById(stid + 'endTimeArrived').checked = false;
				document.getElementById(stid + 'aT').value = '';
				
			}else{
				document.getElementById(stid + 'departureTime').innerHTML = '';
				document.getElementById(stid + 'dT').value = '';
				document.getElementById(stid + 'wH').value = '';
				}
			}
		}
		
		function showTimeBreak(checkBox, stid){
		
		var dateTime = moment().format('YYYY-MM-DD HH:mm:ss');
		var time = moment().format('HH:mm:ss');
		//dateformat 24hours
		//var checkBox = document.getElementById(checkBox.id);
		
		if(checkBox.checked == true){
			if(checkBox.id == (stid +'startBreak')){
				document.getElementById(stid +'startBreakTime').innerHTML = dateTime;
				document.getElementById(stid + 'sB').value = time;
			}else{
				document.getElementById(stid +'endBreakTime').innerHTML = dateTime;
				document.getElementById(stid + 'eB').value = time;
				if((document.getElementById(stid +'endBreakTime').innerHTML != '') && (document.getElementById(stid +'startBreakTime').innerHTML != '')){
					var now = document.getElementById(stid + 'startBreakTime').innerHTML;
					var then = document.getElementById(stid + 'endBreakTime').innerHTML;
					var diff = moment.duration(moment(then).diff(moment(now)));
					var seconds = parseInt(diff.asSeconds());
					document.getElementById(stid + 'bT').value = seconds;
					
					//console.log('BreakTime Seconds : ' + seconds);
				}
			}
		}else{
			if(checkBox.id == (stid +'startBreak')){
				document.getElementById(stid +'startBreakTime').innerHTML = '';
				document.getElementById(stid + 'sB').value = '';
			}else{
				document.getElementById(stid +'endBreakTime').innerHTML = '';
				document.getElementById(stid + 'eB').value = '';
				document.getElementById(stid + 'bT').value = '';
				}
			}
		}
</script>
<?php

/*
Page code: 4.1
Who can access: Tenant
Description: The page where user lands after login.
*/
if($_SERVER['REQUEST_METHOD'] === 'POST'){
	extract($_POST);
	
	if(isset($staffID)){
		foreach($staffID as $name => $value){
		
		$aT = $value . "aT";
		$dT = $value . "dT";
		$iL = $value . "iL";
		$sB = $value . "sB";
		$eB = $value . "eB";
		$bT = $value . "bT";
		
			$sql = "select * from staff_attendance where staff_ID = '" . $value . "' and ST_Date like '%" . date("Y-m-d") . "%'";
			$query = mysqli_query($conn, $sql) or die(mysqli_error($conn));
			//insert data for update
			if(mysqli_num_rows($query) == 0){
				$sql = "INSERT INTO staff_attendance (staff_ID, center_ID, ST_Date) VALUES ('". $value ."', '". $center_ID ."', '" . date("Y-m-d") . "')";
				mysqli_query($conn, $sql) or die(mysqli_error($conn));
			}
			
			//set arrivedTime
			if(!empty($$aT)){
				$sql = "update staff_attendance set ST_StartDateTime = '" . $$aT . "', is_late = '" . $$iL . "' where staff_ID = '" . $value . "' and ST_Date like '%" . date("Y-m-d") . "%'";
				mysqli_query($conn, $sql) or die(mysqli_error($conn));
				$_SESSION[$aT] = $$aT;
			}
			
			//set departureTime
			if(!empty($$dT)){
				$sql = "update staff_attendance set ST_EndDateTime = '" . $$dT . "' where staff_ID = '" . $value . "' and ST_Date like '%" . date("Y-m-d") . "%'";
				mysqli_query($conn, $sql) or die(mysqli_error($conn));
			}
			//session set Start Break Time
			if(!empty($$sB)){
				$_SESSION[$sB] = $$sB;
			}
			//session set End Break Time
			if(!empty($$eB)){
				$_SESSION[$eB] = $$eB;
				
				if(isset($_SESSION[$sB]) && isset($_SESSION[$eB])){
				$bts = strtotime($_SESSION[$sB]);
				$bte = strtotime($_SESSION[$eB]);
				$diff = ($bte - $bts) / 60 / 60;
				$_SESSION[$bT] = $diff;
				//echo '<script>console.log("Break Time to Minute : ' . $diff . '");</script>';
				$sql = "update staff_attendance set break_Time = '" . number_format((float)$diff, 2, '.', '') . "' where staff_ID = '" . $value . "' and ST_Date like '%" . date("Y-m-d") . "%'";
				mysqli_query($conn, $sql) or die(mysqli_error($conn));
				
				}
			}
			
			//calucuate workHours
			if(isset($_SESSION[$bT]) && isset($_SESSION[$aT]) && !empty($$dT)){
				//set Work Hours
				echo '<script>console.log("Before Work Hour to Minute : ' . $_SESSION[$bT] . '");</script>';
				$wts = strtotime($_SESSION[$aT]);
				$wte = strtotime($$dT);
				$diff = (($wte - $wts) / 60 / 60) - $_SESSION[$bT];
				//echo '<script>console.log("AT : ' . $$aT . '");</script>';
				//echo '<script>console.log("DT : ' . $$dT . '");</script>';
				echo '<script>console.log("After Work Hour to Minute : ' . $diff . '");</script>';
				$sql = "update staff_attendance set real_workhours = '" . number_format((float)$diff, 2, '.', '') . "' where staff_ID = '" . $value . "' and ST_Date like '%" . date("Y-m-d") . "%'";
				mysqli_query($conn, $sql) or die(mysqli_error($conn));
				}
		}
	}
}

print("
<div class='container'>
<div class='row'>
<div class='col-12 my-2'>
<h4 class='text-secondary'>Staff Attendance </h4>
</div>
</div>
</div>
<div class='container'>
<form class='row' method='post' action='staff-attendance.php'>
<div class='col-12 text-secondary'>
<input type='submit' class='btn btn-default' value='Submit'><br>");
	
print("
</div>
<div class='container'>

<div class='row mt-3'>
<table class='table table-hover'>
<tr>
<th>Staff ID</th>
<th>Staff Name</th>
<th>Arrived Time</th>
<th>Departure Time</th>
<th>Arrived</th>
<th>Is Late</th>
<th>Arrived Break</th>
<th>Departure Break</th>
<th>Break Time</th>
</tr>
");
		$sql="SELECT * FROM staff_attendance as a join staff as b join preferral_workday as c on (b.staff_ID = a.staff_ID and a.staff_ID = c.staffID) where (a.ST_Date like '%" . date("Y-m-d") ."%' and c.weekday = '" . date('l') ."')";
		
		$query = mysqli_query($conn, $sql)or die(mysqli_error($conn));
		if (mysqli_num_rows($query) > 0){
		while($result = mysqli_fetch_assoc($query)){
		printf('
		<tr>
		<td>%1$s</td><input type="hidden" name="staffID[]" value="%1$s">
		<td>%2$s</td>
		
		<input type="hidden" name="center_ID" value="%5$s">
		
		<td id ="%1$sarrivedTime">%6$s</td><input type="hidden" id="%1$saT" name="%1$saT" value="">
		<td id ="%1$sdepartureTime">%11$s</td><input type="hidden" id="%1$sdT" name="%1$sdT" value="">
		
		<td><input type="checkbox" id="%1$sstartTimeArrived" style="margin: 3px" onChange="showTimeArrived(this, \'%1$s\', \'%3$s\');" %9$s><B>Start</B>
		<input type="checkbox" id="%1$sendTimeArrived" style="margin: 3px" onChange="showTimeArrived(this, \'%1$s\', \'%3$s\');" %10$s><B>End</B></td>
		
		<td id ="%1$sisLate" %7$s>%8$s</td><input type="hidden" id="%1$siL" name="%1$siL" value="">
		
		<td id ="%1$sstartBreakTime">%12$s</td><input type="hidden" id="%1$ssB" name="%1$ssB" value="">
		<td id ="%1$sendBreakTime">%13$s</td><input type="hidden" id="%1$seB" name="%1$seB" value="">
		
		<input type="hidden" id="%1$sbT" name="%1$sbT" value="">
		<input type="hidden" id="%1$swH" name="%1$swH" value="">
		<td><input type="checkbox" id="%1$sstartBreak" style="margin: 3px" onChange="showTimeBreak(this, \'%1$s\');" %14$s><B> Start</B>
		<input type="checkbox" id="%1$sendBreak" style="margin: 3px" onChange="showTimeBreak(this, \'%1$s\');" %15$s><B> End</B></td>
		
		</tr>
		', $result['staff_ID'] ,$result['staff_name'], $result['workday_startTime'], //3
		$result['weekday'], $result['center_ID'], $result['ST_StartDateTime'] , //3
		(($result['is_late'] == NULL)? ('') : (($result['is_late'] == 0)? ('style=background-color:lime') : ('style=background-color:red'))), //1
		(($result['is_late'] == NULL)? ('') : (($result['is_late'] == 0)? ('ONTIME') : ('LATE'))), // 1
		(isset($result['ST_StartDateTime'])? 'disabled' : ''), // 1
		(isset($result['ST_EndDateTime'])? 'disabled' : ''), // 1
		$result['ST_EndDateTime'], (isset($_SESSION[$result['staff_ID'] . 'sB'])? (date("Y-m-d") . ' ' . $_SESSION[$result['staff_ID'] . 'sB']) : ''), (isset($_SESSION[$result['staff_ID'] . 'eB'])? (date("Y-m-d") . ' ' . $_SESSION[$result['staff_ID'] . 'eB']) : ''), // 3
		(isset($_SESSION[$result['staff_ID'] . 'sB'])? 'disabled' : ''), (isset($_SESSION[$result['staff_ID'] . 'eB'])? 'disabled' : '')); // 1
		}
		}else{
			$sql="SELECT a.staff_ID , a.staff_name , b.workday_startTime , b.weekday , a.center_ID FROM staff as a join preferral_workday as b join manager as c on b.staffID = a.staff_ID WHERE (((a.job_type != 'manager' and b.weekday ='". date('l') ."') and c.staff_ID = '". $_SESSION['staff_ID'] ."') and c.center_ID = a.center_ID) order by a.staff_ID asc";
			$query = mysqli_query($conn, $sql)or die(mysqli_error($conn));
			if (mysqli_num_rows($query) > 0){
			while($result = mysqli_fetch_assoc($query)){
			printf('
			<tr id="%1$str">
			<td>%1$s</td><input type="hidden" name="staffID[]" value="%1$s">
			<td>%2$s</td>
		
			<input type="hidden" name="center_ID" value="%5$s">
		
			<td id ="%1$sarrivedTime"></td><input type="hidden" id="%1$saT" name="%1$saT" value="">
			<td id ="%1$sdepartureTime"></td><input type="hidden" id="%1$sdT" name="%1$sdT" value="">
		
			<td><input type="checkbox" id="%1$sstartTimeArrived" style="margin: 3px" onChange="showTimeArrived(this, \'%1$s\', \'%3$s\');" ><B>Start</B>
			<input type="checkbox" id="%1$sendTimeArrived" style="margin: 3px" onChange="showTimeArrived(this, \'%1$s\', \'%3$s\');" disabled><B>End</B></td>
		
			<td id ="%1$sisLate"></td><input type="hidden" id="%1$siL" name="%1$siL" value="">
		
			<td id ="%1$sstartBreakTime"></td><input type="hidden" id="%1$ssB" name="%1$ssB" value="">
			<td id ="%1$sendBreakTime"></td><input type="hidden" id="%1$seB" name="%1$seB" value="">
			<input type="hidden" id="%1$sbT" name="%1$sbT" value="">
			<input type="hidden" id="%1$swH" name="%1$swH" value="">
			<td><input type="checkbox" id="%1$sstartBreak" style="margin: 3px" onChange="showTimeBreak(this, \'%1$s\');" ><B> Start</B>
			<input type="checkbox" id="%1$sendBreak" style="margin: 3px" onChange="showTimeBreak(this, \'%1$s\');"><B> End</B></td>
		
			</tr>
			', $result['staff_ID'] ,$result['staff_name'], $result['workday_startTime'], $result['weekday'], $result['center_ID']);
			unset($_SESSION[$result['staff_ID'] . 'sB']);
			unset($_SESSION[$result['staff_ID'] . 'eB']);
				}
			}
		}
		
		
print("
</table>
</form>
</div>
</div>
");

include 'inc/footer.php';
?>
