<?php
include 'inc/header.php';

login_only();
//joey
?>
<?php print_error_message($error_message); ?>
<div class="container">
	<div class="row" style="height:300px">
		<div class="text-center m-auto">
			<div class="text-secondary" style="font-size:30px">
				<b>Welcome,<?php echo $display_name; ?>.</b> 
			</div>
			<?php
				if (isset($_SESSION["type"]) && $_SESSION["type"] == "student"){
					print("
					<div class='mt-1'>
						<a href='view-profile.php' class='btn btn-default'>View profile</a>
					</div>
					");
				}else{
					print("
					<div class='mt-1'>
						<a href='view-profile-s.php' class='btn btn-default'>View profile</a>
					</div>
					");	
				}
			
			?>
		</div>
	</div>
</div>

<?php
include 'inc/footer.php';
?>