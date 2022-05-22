<?php
include 'inc/header.php';
//peter
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
	$is_valid = true;
	extract($_POST);

	if(!isset($days) || !$days){
		$is_valid = false;
		$error_message.="Days is missing<br>";
	}


	if($is_valid){
		$days = $conn->real_escape_string($days);
		$qs = "UPDATE preferral_workday SET workday_startTime='00:00:00',workday_endTime='00:00:00 
		',workday_workhour = 0 WHERE staffID='".$_SESSION['staff_ID']."' AND weekday='".$days."'";
		$error_message.= $qs ."<br>";
		$query = mysqli_query($conn, $qs);
		if (mysqli_error($conn)) {
			$error_message.=mysqli_error($conn);
		} else {
			header("Location: ViewPreferredday.php");
		}
	}
}

print("

<div class='container'>
<div class='row'>
<div class='col-12 my-2'>
<h4 class='text-secondary'>Remove Time</h4>
</div>
</div>
</div>




<form method='post'>
<div class='container'>
<div class='row'>
<div class='col-12'>
<a href='view-preferredday.php' class='btn btn-default'>Return</a>
</div>
</div>

		
		<div class='row mt-3'>
<div class='col-12 col-sm-3'>
<h5>Weekday</h5>
</div>
<div class='col-12 col-sm-8 text-secondary font-weight-bold'>
		<select name='days' id='days'>
        <option value='Monday'>Monday</option>
        <option value='Tuesday'>Tuesday</option>
        <option value='Wednesday'>Wednesday</option>
        <option value='Thursday'>Thursday</option>
        <option value='Friday'>Friday</option>
        <option value='Saturday'>Saturday</option>
        <option value='Sunday'>Sunday</option>
        </select>
</div>
</div>
		
		
		<div class='row my-3'>
		<div class='col-12'>
			 <input type='Submit' name='' value='Save' class='btn btn-default' >
			
		</div>
	</div>
		
		
		
		</div>
		</form>



");

?>

<?php
include 'inc/footer.php';
?>