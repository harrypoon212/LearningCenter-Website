<?php
include 'inc/header.php';
//peter sam
if(isset($_POST['submit']))
{
	/*/$starttime = $_POST['starttime'];
	$endtime = $_POST['endtime'];
	$workhours = $_POST['workhours'];/*/
	$sql = "UPDATE preferral_workday SET workday_startTime='".$_POST['starttime']."',workday_endTime='".$_POST['endtime'].
		"',workday_workhour =".number_format(((strtotime($_POST['endtime'])-strtotime($_POST['starttime']))%86400/3600),2).
		" WHERE staffID='".$_SESSION['staff_ID']."' AND weekday='".$_POST['days']."'";
           mysqli_query($conn,$sql)
           or die(mysqli_error($conn));
}     
print("

<div class='container'>
<div class='row'>
<div class='col-12 my-2'>
<h4 class='text-secondary'>View Preffered Work Day</h4>
</div>
</div>
</div>

<div class='container'>
<div class='row'>
		<div class='col-12 text-secondary'>
		<a href='view-profile-s.php' class='btn btn-default'>Return</a>
		<a href='create-preferredDay.php' class='btn btn-default'>Update</a>
		<a href='remove-time.php' class='btn btn-default'>Remove</a>
		<br>		
		</div>
		</div>
		
		");

print("

<div class='row mt-3'>
<table class='table table-hover'>
<tr>
<th>Monday</th>
<th>Tuesday</th>
<th>Wednesday</th>
<th>Thursday</th>
<th>Friday</th>
<th>Saturday</th>
<th>Sunday</th>
</tr>
<tr>
");
           $sql = "SELECT * FROM preferral_workday Where staffID ='".$_SESSION['staff_ID']."' AND weekday = 'Monday'";
           $rs = mysqli_query($conn,$sql)
           or die(mysqli_error($conn));
		   if(mysqli_num_rows($rs)>0){
           while ($rcmon = mysqli_fetch_assoc($rs)) {
	       $Monday =(strtotime($rcmon['workday_endTime'])-strtotime($rcmon['workday_startTime']))%86400/3600;
		   $formattedMon=number_format($Monday,2);
		echo
		"
		<td>$rcmon[workday_startTime] - $rcmon[workday_endTime]</td>
		";
		
       }
   }else{
	   echo"<td></td>";
   }
		   $sql = "SELECT * FROM preferral_workday Where staffID ='".$_SESSION['staff_ID']."' AND weekday = 'Tuesday'";
           $rs = mysqli_query($conn,$sql)
           or die(mysqli_error($conn));
		   if(mysqli_num_rows($rs)>0){
           while ($rctue = mysqli_fetch_assoc($rs)) {
	       $Tuesday =(strtotime($rctue['workday_endTime'])-strtotime($rctue['workday_startTime']))%86400/3600;
		   $formattedTue=number_format($Tuesday,2);
		echo
		"
		<td>$rctue[workday_startTime] - $rctue[workday_endTime]</td>
		";
        }
		   }else{
	   echo"<td></td>";
   }
		$sql = "SELECT * FROM preferral_workday Where staffID ='".$_SESSION['staff_ID']."' AND weekday = 'Wednesday'";
           $rs = mysqli_query($conn,$sql)
           or die(mysqli_error($conn));
		  if(mysqli_num_rows($rs)>0){

           while ($rcwed = mysqli_fetch_assoc($rs)) {
	       $Wednesday =(strtotime($rcwed['workday_endTime'])-strtotime($rcwed['workday_startTime']))%86400/3600;
		   $formattedWed=number_format($Wednesday,2);
		echo
		"
		<td>$rcwed[workday_startTime] - $rcwed[workday_endTime]</td>
		";
	
        }
		   }else{
	   echo"<td></td>";
   }
		$sql = "SELECT * FROM preferral_workday Where staffID ='".$_SESSION['staff_ID']."' AND weekday = 'Thursday'";
           $rs = mysqli_query($conn,$sql)
           or die(mysqli_error($conn));
		   		   if(mysqli_num_rows($rs)>0){

           while ($rcthu = mysqli_fetch_assoc($rs)) {
	       $Thursday =(strtotime($rcthu['workday_endTime'])-strtotime($rcthu['workday_startTime']))%86400/3600;
           $formattedThu=number_format($Thursday,2);
		echo
		"
		<td>$rcthu[workday_startTime] - $rcthu[workday_endTime]</td>
		";
		   }
        }else{
	   echo"<td></td>";
   }
		$sql = "SELECT * FROM preferral_workday Where staffID ='".$_SESSION['staff_ID']."' AND weekday = 'Friday'";
           $rs = mysqli_query($conn,$sql)
           or die(mysqli_error($conn));
		   if(mysqli_num_rows($rs)>0){
           while ($rcfri = mysqli_fetch_assoc($rs)) {
           $Friday =(strtotime($rcfri['workday_endTime'])-strtotime($rcfri['workday_startTime']))%86400/3600;
           $formattedFri=number_format($Friday,2);
		echo
		"
		<td>$rcfri[workday_startTime] - $rcfri[workday_endTime]</td>
		";
		   }
        }else{
	   echo"<td></td>";
   }
		$sql = "SELECT * FROM preferral_workday Where staffID ='".$_SESSION['staff_ID']."' AND weekday = 'Saturday'";
           $rs = mysqli_query($conn,$sql)
           or die(mysqli_error($conn));
		  if(mysqli_num_rows($rs)>0){
           while ($rcsat = mysqli_fetch_assoc($rs)) {
	       $Saturday =(strtotime($rcsat['workday_endTime'])-strtotime($rcsat['workday_startTime']))%86400/3600;
           $formattedSat=number_format($Saturday,2);

		echo
		"
		<td>$rcsat[workday_startTime] - $rcsat[workday_endTime]</td>
		";
		   }
        }else{
	   echo"<td></td>";
   }
		$sql = "SELECT * FROM preferral_workday Where staffID ='".$_SESSION['staff_ID']."' AND weekday = 'Sunday'";
           $rs = mysqli_query($conn,$sql)
           or die(mysqli_error($conn));
		   	if(mysqli_num_rows($rs)>0){
           while ($rcsun = mysqli_fetch_assoc($rs)) {
	       $Sunday =(strtotime($rcsun['workday_endTime'])-strtotime($rcsun['workday_startTime']))%86400/3600;
           $formattedSun=number_format($Sunday,2);
		echo
		"
		<td>$rcsun[workday_startTime] - $rcsun[workday_endTime]</td>";
		}
        }else{
			echo "<td></td>";
		}
		$Totalhrs=$formattedMon+$Tuesday+$Wednesday+$Thursday+$Friday+$Saturday+$Sunday;
print("
<tr>
<td>$formattedMon hours</td>
<td>$formattedTue hours</td>
<td>$formattedWed hours</td>
<td>$formattedThu hours</td>
<td>$formattedFri hours</td>
<td>$formattedSat hours</td>
<td>$formattedSun hours</td>
</tr>
</table>



<h4>Total : $Totalhrs hours<h4>
</div>
");

 

		   
?>

<?php
include 'inc/footer.php';
?>