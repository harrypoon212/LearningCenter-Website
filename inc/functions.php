<?php
//harry
function print_error_message($error_message){
	/*
	Display an alert message to the user.
	Recommended to be placed below the navbar, or a place where appropriate.
	*/

	if (isset($error_message) && $error_message != ''){
		print("
		<div class='container mt-3'>
		<div class='alert alert-danger'>
		$error_message
		</div>
		</div>
		");
	}
}

function print_post_message(){
	if ($_SERVER['REQUEST_METHOD'] === 'POST') {
		print("
		<hr>
		<div class='container my-3'>
		<div class='row'>
		Debug Information<br>
		");

		foreach ($_POST as $key => $value){
			echo $key." - ".$value."<br>";
		}

		print("
		</div>
		</div>
		");
	}
}

function login_only(){
	if (!isset($_SESSION["type"])){
		header("location: login-only.php");
	}
}

function student_only(){
	login_only();
	if (isset($_SESSION["type"]) && $_SESSION["type"] == "student"){
		header("location: student-only.php");
	}
}

function teacher_only(){
	login_only();
	if (isset($_SESSION["type"]) && $_SESSION["type"] == "teacher"){
		header("location: teacher-only.php");
	}
}

function staff_only(){
	login_only();
	if (isset($_SESSION["type"]) && $_SESSION["type"] == "staff"){
		header("location: staff-only.php");
	}
}

function manager_only(){
	login_only();
	if (isset($_SESSION["type"]) && $_SESSION["type"] == "manager"){
		header("location: manager-only.php");
	}
}
function show_time(){
	$todaystring=date('Y-m-d', time())." ".date('H:i:s',time());
	
	
}

?>
