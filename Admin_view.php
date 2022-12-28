<?php
session_start();
?>

<?php
include 'dbcon.php';
		
	$selectquery = "select * from employee";
	$query = mysqli_query($con,$selectquery);
	$noofemp = mysqli_num_rows($query);

	$selectquery1 = "select * from notice";
	$query1 = mysqli_query($con,$selectquery1);
	$noofnotices = mysqli_num_rows($query1);
	
	$selectquery2 = "select * from training";
	$query2 = mysqli_query($con,$selectquery2);
	$nooftraining = mysqli_num_rows($query2);

	$selectquery3 = "select * from leaves";
	$query3 = mysqli_query($con,$selectquery3);
	$noofleave = mysqli_num_rows($query3);
	
	$selectquery4 = "select * from employee ORDER BY emp_id DESC LIMIT 5";
	$query4 = mysqli_query($con,$selectquery4);

?>

<!DOCTYPE html>
<html>
	<title>HR Management System</title>
	<?php
		include 'Style/css2.css';
		include 'Style/Links.php';
	?>
<body>
	<!-- Top Navbar -->
	<div class="w3-top">
		<div class="w3-bar w3-theme w3-large" style="z-index:4;">
			<a class="w3-bar-item w3-button w3-left w3-hide-large w3-hover-green w3-large w3-theme w3-padding-12" href="javascript:void(0)" onclick="w3_open()">☰</a>
			<label class="w3-bar-item glow">HR Management System</label>
			<a class="w3-bar-item w3-button w3-hide-small w3-hide-medium w3-right w3-hover-green" href="Logout.php"><i class="fa fa-sign-out fa-fw"></i>Logout</a>
		</div>
	</div>

	<!-- Sidebar -->
	<div class="w3-sidebar w3-bar-block w3-collapse w3-theme w3-animate-left" style="z-index:3; width:250px" id="mySidebar">
		<div class="w3-bar w3-large">
			<a href="javascript:void(0)" onclick="w3_close()" class="w3-button w3-right w3-xlarge w3-hover-green w3-hide-large" title="Close Menu">×</a>
			<a class="w3-bar-item w3-button w3-green w3-hover-green" href="Admin_view.php"><i class="fa fa-dashboard fa-fw"></i> Dashboard</a>
			<a class="w3-bar-item w3-button w3-hover-green" href="View_Profile.php"><i class="fa fa-user-circle fa-fw"></i> View Profile</a>
			<a class="w3-bar-item w3-button w3-hover-green" href="Manage_Employee.php"><i class="fa fa-users fa-fw"></i> Manage Employee</a>
			<a class="w3-bar-item w3-button w3-hover-green" href="Manage_Training.php"><i class="fa fa-address-book fa-fw"></i> Manage Training</a>
			<a class="w3-bar-item w3-button w3-hover-green" href="Manage_Payroll.php"><i class="fa fa-bookmark fa-fw"></i> Manage Payroll</a>
			<a class="w3-bar-item w3-button w3-hover-green" href="Manage_Leave.php"><i class="fa fa-home fa-fw"></i> Manage Leave</a>
			<a class="w3-bar-item w3-button w3-hover-green" href="Manage_Report.php"><i class="fa fa-random fa-fw"></i> Manage Report</a>
			<a class="w3-bar-item w3-button w3-hover-green" href="Manage_Notice.php"><i class="fa fa-comment fa-fw"></i> Manage Notice</a>
			<a class="w3-bar-item w3-button w3-hide-large w3-hover-green" href="Logout.php"><i class="fa fa-sign-out fa-fw"></i> Logout</a>
		</div>
	</div>

	<!-- Overlay effect when opening sidebar on small screens -->
	<div class="w3-overlay w3-hide-large" onclick="w3_close()" style="cursor:pointer" title="close side menu" id="myOverlay"></div>

	<!-- Main content: shift it to the right by 270 pixels when the sidebar is visible -->
	<div class="w3-main w3-container" style="margin-left:250px;margin-top:60px;">
    <div class="w3-container w3-light-gray">   
		<div class="w3-row-padding w3-margin-bottom w3-margin-top">
			<div class="w3-quarter">
				<div class="w3-container w3-red w3-padding-16">
					<div class="w3-left"><i class="fa fa-users w3-xxxlarge"></i></div>
					<div class="w3-right">
					<h3><?php echo "$noofemp";  ?></h3>
					</div>
					<div class="w3-clear"></div>
					<h4>Total Employees</h4>
				</div>
			</div>
			
			<div class="w3-quarter">
				<div class="w3-container w3-blue w3-padding-16">
					<div class="w3-left"><i class="fa fa-comment w3-xxxlarge"></i></div>
					<div class="w3-right">
					<h3><?php echo "$noofnotices";  ?></h3>
					</div>
					<div class="w3-clear"></div>
					<h4>Notices</h4>
				</div>
			</div>
			
			<div class="w3-quarter">
				<div class="w3-container w3-orange w3-text-white w3-padding-16">
					<div class="w3-left"><i class="fa fa-address-book w3-xxxlarge"></i></div>
					<div class="w3-right">
					<h3><?php echo "$nooftraining";  ?></h3>
					</div>
					<div class="w3-clear"></div>
					<h4>Trainings</h4>
				</div>
			</div>
			
			<div class="w3-quarter">
				<div class="w3-container w3-teal w3-text-white w3-padding-16">
					<div class="w3-left"><i class="fa fa-home w3-xxxlarge"></i></div>
					<div class="w3-right">
					<h3><?php echo "$noofleave";  ?></h3>
					</div>
					<div class="w3-clear"></div>
					<h4>Leaves</h4>
				</div>
			</div>
		</div>
  	</div>
  	<h2 class="w3-xlarge w3-text-teal"><i class="fa fa-users"></i> Recently Joined Employees</h2>
 	<div class="w3-container w3-light-gray"> 
	<?php	
		while ($recentemp = mysqli_fetch_array($query4)) 
		{
			?>	
			<ul class="w3-ul w3-card-4 w3-white w3-margin-bottom w3-margin-top">
				<li class="w3-padding-16">
					<img src="Style/Images/user.png" class="w3-left w3-circle w3-margin-right" style="width:35px">
					<span class="w3-xlarge"><?php echo $recentemp['emp_id']; ?> <b>-</b> <?php echo $recentemp['name']; ?></span><br>
				</li>
			</ul>
			<?php
		}
	?>
	</div>
	<footer class="w3-panel w3-padding-16 w3-card-4 w3-theme w3-center">
		<p>&copy;Copyright 2021. All rights reserved.</p> 
	</footer>
	
	
	</div>

	<script>
		// Script to open and close the sidebar
		function w3_open() 
		{
			document.getElementById("mySidebar").style.display = "block";
			document.getElementById("myOverlay").style.display = "block";
		}
	 
		function w3_close() 
		{
			document.getElementById("mySidebar").style.display = "none";
			document.getElementById("myOverlay").style.display = "none";
		}
	</script>
</body>
</html>
