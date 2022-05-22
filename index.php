<?php
include 'inc/header.php';
//harry
if (isset($_SESSION["type"])){
	header("Location: dashboard.php");
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
	$is_valid = true;
	extract($_POST);
	if(isset($student_login)){
		//Validation when user is a tenant
		if(!isset($student_ID) || !$student_ID){
			$is_valid = false;
			$error_message .= "Student Login missing<br>";
		}

		if(!isset($student_password) || !$student_password){
			$is_valid = false;
			$error_message .= "Student Password missing<br>";
		}

		if ($is_valid){
			/*
			Check in the database to see if there's a tenant with the corresponding tenantID and password.
			If so, log the tenant in.
			Otherwise, prompt tenant to enter password again.
			*/
			$student_ID = $conn->real_escape_string($student_ID);
			$student_password = $conn->real_escape_string($student_password);
			$qs = "SELECT * FROM student WHERE student_ID = '$student_ID' and student_password = '$student_password'";
			$query = mysqli_query($conn, $qs) or die(mysqli_error($conn));

			if (mysqli_num_rows($query) == 1){
				$tenant = mysqli_fetch_assoc($query);
				$_SESSION["type"] = "student";
				$_SESSION["student_ID"] = $tenant["student_ID"];
				header("Location: dashboard.php");
			} else {
				$error_message = "Student ID / password incorrect<br>";
			}

		} else {
			//echo "Failed"; // invalid
		}

	} else if (isset($manager_login)){
		//Validation when user is a customer
		if(!isset($staff_ID) || !$staff_ID){
			$is_valid = false;
			$error_message .= "Manager ID missing<br>";
		}

		if(!isset($staff_password) || !$staff_password){
			$is_valid = false;
			$error_message .= "Password missing<br>";
		}
		if ($is_valid){
			/*
			Check in the database to see if there's a tenant with the corresponding tenantID and password.
			If so, log the tenant in.
			Otherwise, prompt tenant to enter password again.
			*/

			$staff_ID = $conn->real_escape_string($staff_ID);
			$staff_password = $conn->real_escape_string($staff_password);
			$qs = "SELECT manager.manager_ID, manager.staff_ID, staff.staff_ID, staff.staff_password  
			FROM manager 
			INNER JOIN staff 
			ON manager.staff_ID = staff.staff_ID
			WHERE manager_ID = '$staff_ID' and staff_password = '$staff_password'";
			
			$query = mysqli_query($conn, $qs) or die(mysqli_error($conn));
			if (mysqli_num_rows($query) == 1){
					$tenant = mysqli_fetch_assoc($query);
					$_SESSION["type"] = "manager";
					$_SESSION["staff_ID"] = $tenant["staff_ID"];				
					header("Location: dashboard.php");		
			} else {
				$error_message = "Manager ID incorrect<br>";
			};
		}
	}
	else if (isset($teacher_login)){
		//Validation when user is a customer
		if(!isset($staff_ID) || !$staff_ID){
			$is_valid = false;
			$error_message .= "Teacher ID missing<br>";
		}

		if(!isset($staff_password) || !$staff_password){
			$is_valid = false;
			$error_message .= "Password missing<br>";
		}
		if ($is_valid){
			/*
			Check in the database to see if there's a tenant with the corresponding tenantID and password.
			If so, log the tenant in.
			Otherwise, prompt tenant to enter password again.
			*/

			$staff_ID = $conn->real_escape_string($staff_ID);
			$staff_password = $conn->real_escape_string($staff_password);
			$qs = "SELECT teacher.teacher_ID, teacher.staff_ID, staff.staff_ID, staff.staff_password  
			FROM teacher 
			INNER JOIN staff 
			ON teacher.staff_ID = staff.staff_ID
			WHERE teacher_ID = '$staff_ID' and staff_password = '$staff_password'";
			$query = mysqli_query($conn, $qs) or die(mysqli_error($conn));
				if (mysqli_num_rows($query) == 1){
					$tenant = mysqli_fetch_assoc($query);
					$_SESSION["type"] = "teacher";
					$_SESSION["staff_ID"] = $tenant["staff_ID"];				
					header("Location: dashboard.php");
			} else {
				$error_message = "Teacher ID incorrect<br>";
			};
		}
	}

else if (isset($service_login)){
		//Validation when user is a customer
		if(!isset($staff_ID) || !$staff_ID){
			$is_valid = false;
			$error_message .= "Staff ID missing<br>";
		}

		if(!isset($staff_password) || !$staff_password){
			$is_valid = false;
			$error_message .= "Password missing<br>";
		}
		if ($is_valid){
			/*
			Check in the database to see if there's a tenant with the corresponding tenantID and password.
			If so, log the tenant in.
			Otherwise, prompt tenant to enter password again.
			*/

			$staff_ID = $conn->real_escape_string($staff_ID);
			$staff_password = $conn->real_escape_string($staff_password);
			$qs = "SELECT * FROM staff WHERE staff_ID = '$staff_ID' and staff_password = '$staff_password' and job_type ='staff'";
			$query = mysqli_query($conn, $qs) or die(mysqli_error($conn));

			if (mysqli_num_rows($query) == 1){
				$tenant = mysqli_fetch_assoc($query);
				$_SESSION["type"] = "service";
				$_SESSION["staff_ID"] = $tenant["staff_ID"];
				header("Location: dashboard.php");
			} else {
				$error_message = "service ID / password incorrect<br>";
			};
		}
	}
	
	else {
		print ("Error");
	};
}

?>

<div class="py-2 bg-primary">
	<div class="container">
		<div class="row">
			<div class="px-3 col-md-8 text-center mx-auto">
				<div class="text-secondary" style="font-size:60px; font-weight: bold;"> <b>Education Center</b></div>
				<div class="my-1 text-white" style="font-size:30px; font-weight: bold;">Good education for the students</div>
			</div>
		</div>
	</div>
</div>
<div class="py-2">

	<?php print_error_message($error_message); ?>
	<div class="container">

		<div class="row">
			<div class="col-md-12">
				<ul class="nav nav-tabs">
					<li class="nav-item"> <a href="" class="active nav-link" data-toggle="tab" data-target="#tabone">Manager</a> </li>
					<li class="nav-item"> <a class="nav-link" href="" data-toggle="tab" data-target="#tabtwo">Teacher</a> </li>
					<li class="nav-item"> <a class="nav-link" href="" data-toggle="tab" data-target="#tabthree">Service</a> </li>
					<li class="nav-item"> <a class="nav-link" href="" data-toggle="tab" data-target="#tabfour">Student</a> </li>
				</ul>
				<div class="tab-content mt-2">

					<?php
					//Form for Manager
					?>

					<div class="tab-pane fade show active" id="tabone" role="tabpanel">
						<form method="POST" action="">
							<div class="form-group row"> <label for="inputmailh" class="col-2 col-form-label">Manager ID </label>
								<div class="col-8">
									<!-- This will be changed to type Manager -->
									<input type="text" class="form-control" name="staff_ID" placeholder="">
								</div>
							</div>
							<div class="form-group row"> <label for="inputpasswordh" class="col-2 col-form-label">Password</label>
								<div class="col-8">
									<input type="password" class="form-control" name="staff_password">
								</div>
							</div>
							<button type="submit" name="manager_login" class="btn btn-default">Login</button>
						</form>
					</div>
					
					<?php
					//Form for Teacher
					?>

					<div class="tab-pane fade" id="tabtwo" role="tabpanel">
						<form method="POST" action="">
							<div class="form-group row"> <label for="inputmailh" class="col-2 col-form-label">Teacher ID </label>
								<div class="col-8">
									<!-- This will be changed to type Student -->
									<input type="text" class="form-control" name="staff_ID" placeholder="">
								</div>
							</div>
							<div class="form-group row"> <label for="inputpasswordh" class="col-2 col-form-label">Password</label>
								<div class="col-8">
									<input type="password" class="form-control" name="staff_password">
								</div>
							</div>
							<button type="submit" name="teacher_login" class="btn btn-default">Login</button>
						</form>
					</div>




					<?php
					//Form for Service
					?>

					<div class="tab-pane fade" id="tabthree" role="tabpanel">
						<form method="POST" action="">
							<div class="form-group row"> <label for="inputmailh" class="col-2 col-form-label">Service ID </label>
								<div class="col-8">
									<!-- This will be changed to type Service -->
									<input type="text" class="form-control" name="staff_ID" placeholder="">
								</div>
							</div>
							<div class="form-group row"> <label for="inputpasswordh" class="col-2 col-form-label">Password</label>
								<div class="col-8">
									<input type="password" class="form-control" name="staff_password">
								</div>
							</div>
							<button type="submit" name="service_login" class="btn btn-default">Login</button>
						</form>
					</div>

					<?php
					//Form for Student
					?>

					<div class="tab-pane fade" id="tabfour" role="tabpanel">
						<form method="POST" action="">
							<div class="form-group row"> <label for="inputmailh" class="col-2 col-form-label">Student ID</label>
								<div class="col-8">

									<input type="" name="student_ID" class="form-control" id="inputmailh">
								</div>
							</div>
							<div class="form-group row"> <label for="" class="col-2 col-form-label">Password</label>
								<div class="col-8">
									<input type="password" name="student_password" class="form-control" id="inputpasswordh">
								</div>
							</div>
							<button type="submit" name="student_login" class="btn btn-default">Login</button>
						</form>
					</div>

				</div>
			</div>
		</div>
	</div>
</div>

<?php
include 'inc/footer.php';
?>