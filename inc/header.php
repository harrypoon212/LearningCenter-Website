<?php

/*
This header is to be included in the front of all pages.
This page contains the required css / js dependencies to be included, and performs a connection to the database.
*/
//joey harry

//MySQL connection
$db_hostname = "localhost";
$db_database = "education1";
$db_username = "harrypoonmingyau";
$db_password = "abcd1234";
$db_port = 3306;
// $conn = mysqli_connect($hostname, $username, $password, $database);
$conn = new mysqli($db_hostname,$db_username,$db_password,$db_database, $db_port);

if ($conn -> connect_errno) {
	echo "Failed to connect to MySQL: " . $conn -> connect_error;
	// exit();
}

require_once("functions.php");

session_start();

$error_message = ""; //To print the error message at desired page

?>

<!DOCTYPE html>
<html>

<!-- HTML head -->
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Education Center</title>
	<script src="js/fontawesome.js" charset="utf-8"></script>
	<link rel="stylesheet" href="css/style.css">
	<link rel="stylesheet" href="css/custom.css">
	<script src="js/jquery-3.3.1.slim.min.js"></script>
	<script src="js/popper.min.js"></script>
	<script src="js/bootstrap.min.js"></script>
	<script src="https://momentjs.com/downloads/moment.js"></script>

</head>


<!-- Site navigation bar -->
<body>
	<nav class="navbar navbar-expand-md navbar-light">
		<div class="container">
			<a class="navbar-brand" href="index.php">
				<img src="img/logo.png" style="height:40px">
			</a>
			<button class="navbar-toggler navbar-toggler-right border-0" type="button" data-toggle="collapse" data-target="#navbar4" style="">
				<span class="navbar-toggler-icon"></span>
			</button>
			<div class="collapse navbar-collapse" id="navbar4">
				<ul class="navbar-nav ml-auto">
					<!-- Logged in users only -->

					<?php
					//Student
					
					if (isset($_SESSION["type"]) && $_SESSION["type"] == "student"){
						print("
						<li class='nav-item'> <a class='nav-link text-secondary' href='view-course.php'>Course</a> </li>
						<li class='nav-item'> <a class='nav-link text-secondary' href='view-mark.php'>Marks</a> </li>
						<li class='nav-item'> <a class='nav-link text-secondary' href='view-attendance.php'>Attendance</a> </li>
						<li class='nav-item'> <a class='nav-link text-secondary' href='view-center.php'>Center</a> </li>
						<li class='nav-item'> <a class='nav-link text-secondary' href='view-profile.php'>Profile</a> </li>
						");
					}

					//Teacher
					
					if (isset($_SESSION["type"]) && $_SESSION["type"] == "teacher"){
						print("
						<li class='nav-item'> <a class='nav-link text-secondary' href='view-news.php'>News</a> </li>
						<li class='nav-item'> <a class='nav-link text-secondary' href='manage-course.php'>Course</a> </li>
						<li class='nav-item'> <a class='nav-link text-secondary' href='create-mark.php'>Marking</a> </li>
						<li class='nav-item'> <a class='nav-link text-secondary' href='view-center.php'>Center</a> </li>
						<li class='nav-item'> <a class='nav-link text-secondary' href='view-profile-s.php'>Profile</a> </li>
					");
					}
					
					//Staff
					
					if (isset($_SESSION["type"]) && $_SESSION["type"] == "service"){
						print("
						<li class='nav-item'> <a class='nav-link text-secondary' href='staff-attendance.php'>Attendance</a> </li>
						<li class='nav-item'> <a class='nav-link text-secondary' href='view-student.php'>Student</a> </li>
						<li class='nav-item'> <a class='nav-link text-secondary' href='view-center.php'>Center</a> </li>
						<li class='nav-item'> <a class='nav-link text-secondary' href='view-profile-s.php'>Profile</a> </li>
					");
					}

					//Manager
					
					if (isset($_SESSION["type"]) && $_SESSION["type"] == "manager"){
						print("
						<li class='nav-item'> <a class='nav-link text-secondary' href='staff-attendance.php'>Attendance</a> </li>
						<li class='nav-item'> <a class='nav-link text-secondary' href='manager-news.php'>News</a> </li>
						<li class='nav-item'> <a class='nav-link text-secondary' href='view-assign.php'>Assign</a> </li>
						<li class='nav-item'> <a class='nav-link text-secondary' href='view-create-course.php'>Course</a> </li>
						<li class='nav-item'> <a class='nav-link text-secondary' href='staff-record.php'>Record</a>
						<li class='nav-item'> <a class='nav-link text-secondary' href='view-profile-s.php'>Profile</a> </li>
					");
					}
					?>

				</li>
			</ul>
		</div>
	</div>
</nav>
<?php
//Get display name of user. If empty, the user is not logged in

$display_name = "";
if(isset($_SESSION['type'])){
	if ($_SESSION['type'] == 'student'){
		$qs = "SELECT * FROM student WHERE student_ID = '$_SESSION[student_ID]'";
		$query = mysqli_query($conn, $qs) or die(mysqli_error($conn));
		$tenant = mysqli_fetch_assoc($query);
		$display_name = $tenant["student_name"];
	} else if ($_SESSION['type'] == 'manager'){
		$qs = "SELECT * FROM staff WHERE staff_ID = '$_SESSION[staff_ID]'";
		$query = mysqli_query($conn, $qs) or die(mysqli_error($conn));
		$tenant = mysqli_fetch_assoc($query);
		$display_name = $tenant["staff_name"] ;
	}else if ($_SESSION['type'] == 'teacher'){
		$qs = "SELECT * FROM staff WHERE staff_ID = '$_SESSION[staff_ID]'";
		$query = mysqli_query($conn, $qs) or die(mysqli_error($conn));
		$tenant = mysqli_fetch_assoc($query);
		$display_name = $tenant["staff_name"] ;
	}else if ($_SESSION['type'] == 'service'){
		$qs = "SELECT * FROM staff WHERE staff_ID = '$_SESSION[staff_ID]'";
		$query = mysqli_query($conn, $qs) or die(mysqli_error($conn));
		$tenant = mysqli_fetch_assoc($query);
		$display_name = $tenant["staff_name"] ;;
	};
}
?>
<?php
if (isset($display_name) && $display_name != "" ){
	printf("
	<div class='container-fluid py-1 bg-secondary shadow-sm text-right text-white'>
	<i class='fa fa-user' aria-hidden='true'></i> $_SESSION[type] -  $display_name |
	<a class='text-white font-weight-bold' href='logout.php'>Logout</a>
	</div>
	");
} else {
	printf("
	<div class='container-fluid py-1 bg-secondary shadow-sm text-right text-white'>
	Anonymous
	</div>
	");
}


?>


