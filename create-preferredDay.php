<?php
include 'inc/header.php';

//peter
/*
Page code: 4.1
Who can access: Tenant
Description: The page where user lands after login.
*/

//customer_only();


print("
<div class='container'>
<div class='row'>
<div class='col-12 my-2'>
<form action='view-preferredday.php' method='POST'>
<h4 class='text-secondary'>Preferred Day</h4>
</div>
</div>
</div>

<div class='container'>
<div class='row'>
<div class='col-12'>
<a href='view-preferredday.php' class='btn btn-default'>Return</a>
</div>
</div>

<div class='row mt-3'>
<div class='col-12 col-sm-3'>
<h5>Weekday :</h5>
</div>
<div class='col-12 col-sm-8 text-secondary font-weight-bold'>
<h5><select name='days' id='days'>
    <option value='Monday'>Monday</option>
    <option value='Tuesday'>Tuesday</option>
    <option value='Wednesday'>Wednesday</option>
    <option value='Thursday'>Thursday</option>
    <option value='Friday'>Friday</option>
    <option value='Saturday'>Saturday</option>
    <option value='Sunday'>Sunday</option>
 </select></h5>
</div>
</div>

<div class='row mt-3'>
<div class='col-12 col-sm-3'>
<h5>Start Time :</h5>
</div>
<div class='col-12 col-sm-8 text-secondary font-weight-bold'>
<h5><input type='time' name='starttime' id='starttime' onChange='showHours()'/></h5>
</div>
</div>

<div class='row mt-3'>
<div class='col-12 col-sm-3'>
<h5>End Time :</h5>
</div>
<div class='col-12 col-sm-8 text-secondary font-weight-bold'>
<h5><input type='time' name='endtime' id='endtime' onChange='showHours()'/></h5>
</div>
</div>

<div class='row mt-3'>
<div class='col-12 col-sm-3'>
<h5>Work Hours :</h5>
</div>
<div class='col-12 col-sm-8 text-secondary font-weight-bold'>
<h5><a name='workhours' id='workhours' value='' >/</a></h5>
</div>
</div>

<div class='row my-3'>
<input type='submit' name='submit' value='save' id='save' class='btn btn-default' disabled/>
</div>
</div>

</form>

</div>
</div>
</div>
");
        
		   
       
		   



?>
<script>
function showHours(){
	var startTime = moment(document.getElementById("starttime").value,"hh:mm:ss");
	var endTime = moment(document.getElementById("endtime").value,"hh:mm:ss");
	var result = (endTime-startTime)/3600000;
	document.getElementById("workhours").innerHTML=result.toFixed(2) + " hours";
	if(parseInt(document.getElementById("workhours").innerHTML) <= 0 || document.getElementById("workhours").innerHTML == "NaN hours"){
        document.getElementById("save").disabled = true;
		document.getElementById("workhours").innerHTML=" Your entry may be not completed or wrong";
    }else{
		document.getElementById("save").disabled = false;
    }
}
</script>
<?php
include 'inc/footer.php';
?>