<?php
include 'inc/header.php';
?>
//jeff

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script>
$(document).ready(function(){
	$('#search_input').keyup(function(){
		var txt = $(this).val().toLowerCase().trim();

		$("table tr").each(function (index) {
			
		if (!index) return;
			$(this).find("td").each(function () {
            var id = $(this).text().toLowerCase().trim();
            var not_found = (id.indexOf(txt) == -1);
            $(this).closest('tr').toggle(!not_found);
            return not_found;
			});
		});
	});
});
</script>
<?php
/*
Page code: 4.1
Who can access: Tenant
Description: The page where user lands after login.
*/

//customer_only();
//Search Function
print("

<div class='container'>
<div class='row'>
<div class='col-12 my-2'>
<h4 class='text-secondary'>Staff Record </h4>
</div>
</div>
</div>

<div class='container'>

<div class='row mt-3'>
<div class='col-12 col-sm-8 text-secondary font-weight-bold'>
<input type='text' id='search_input' name='search_input' class='form-control' placeholder='Search in here...'><br>
</div>
</div>
</div>

<div class='container'>
<div class='row mt-3'>
	<table class='table table-hover' id='table'>
	<tr>
	<th>Staff ID</th>
	<th>Staff Name</th>
	<th>Salary</th>
	<th>Date</th>
	<th>Attendance</th>
	<th>Start Time</th>
	<th>End Time</th>
	</tr>
");		
		$sql="SELECT b.staff_ID, b.staff_name, b.salary, a.ST_Date, a.is_late, a.ST_StartDateTime, a.ST_EndDateTime FROM staff_attendance as a join staff as b join manager as c on b.staff_ID = a.staff_ID where ((c.staff_ID = '". $_SESSION['staff_ID'] ."' and c.center_ID = b.center_ID) and a.staff_ID = b.staff_ID)";
		$query = mysqli_query($conn, $sql)or die(mysqli_error($conn));
		if (mysqli_num_rows($query) > 0){
		while($result = mysqli_fetch_assoc($query)){
		printf('
		<tr>
		<td>%1$s</td>
		<td>%2$s</td>
		<td>%3$s</td>
		<td>%4$s</td>
		<td>%5$s</td>
		<td>%6$s</td>
		<td>%7$s</td>
		</tr>
		', $result['staff_ID'], $result['staff_name'], $result['salary'], $result['ST_Date'], 
		(($result['is_late'] == NULL)? ('ABSENT') : (($result['is_late'] == 0)? ('ONTIME') : ('LATE'))), 
		$result['ST_StartDateTime'], $result['ST_EndDateTime']);
		}
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
