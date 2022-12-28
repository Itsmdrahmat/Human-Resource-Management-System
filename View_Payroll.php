<?php
session_start();
?>



<!DOCTYPE html>
<html>
	<title>Employee - Payroll</title>
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
			<a class="w3-bar-item w3-button w3-hover-green" href="Employee_view.php"><i class="fa fa-home fa-fw"></i> Home</a>
			<a class="w3-bar-item w3-button w3-hover-green" href="Apply_Leave.php"><i class="fa fa-arrow-right fa-fw"></i> Apply Leave</a>
			<a class="w3-bar-item w3-button w3-hover-green" href="View_Trainings.php"><i class="fa fa-address-book fa-fw"></i> View Trainings</a>
			<a class="w3-bar-item w3-green w3-button w3-hover-green" href="View_Payroll.php"><i class="fa fa-bookmark fa-fw"></i> View Payroll</a>
			<a class="w3-bar-item w3-button w3-hover-green" href="Employee_Report.php"><i class="fa fa-random fa-fw"></i> Generate Report</a>
			<a class="w3-bar-item w3-button w3-hover-green" href="Notices.php"><i class="fa fa-comment fa-fw"></i> Notices</a>
			<a class="w3-bar-item w3-button w3-hover-green" href="emp_view_profile.php"><i class="fa fa-user-circle fa-fw"></i> View Profile</a>
			<a class="w3-bar-item w3-button w3-hover-green" href="emp_edit_profile.php"><i class="fa fa-edit fa-fw"></i> Edit Profile</a>			
			<a class="w3-bar-item w3-button w3-hide-large w3-hover-green" href="Logout.php"><i class="fa fa-sign-out fa-fw"></i> Logout</a>
		</div>
	</div>

	<!-- Overlay effect when opening sidebar on small screens -->
	<div class="w3-overlay w3-hide-large" onclick="w3_close()" style="cursor:pointer" title="close side menu" id="myOverlay"></div>

	<!-- Main content: shift it to the right by 270 pixels when the sidebar is visible -->
	<div class="w3-main w3-container" style="margin-left:250px;margin-top:60px;">
	<div class="w3-container w3-light-gray">
	<h2 align="center" class="w3-text-indigo"><i class="fa fa-bookmark"></i> Your Payroll Details</h2><br>
	<?php
		include 'dbcon.php';
		$ids = $_SESSION['fetchempid'];
		
		$updatequery = "select * from payroll where emp_id = '$ids' ORDER BY salary_id DESC";
		$showdata = mysqli_query($con,$updatequery);
		while($arrdata = mysqli_fetch_array($showdata))
		{
			?>		
				<div class="w3-panel w3-padding-large w3-card-4 w3-light-grey">
				<h3>Pay Slip </h3>
				<p class="w3-large">
				<p><div class="w3-code w3-large">
					<b>Salary ID :</b> <?php echo $arrdata['salary_id']; ?><br>
					<b>Employee ID :</b> <?php echo $arrdata['emp_id']; ?><br>
					<b>Employee Name :</b> <?php echo $arrdata['emp_name']; ?><br>
					<b>Salary Type :</b> <?php echo $arrdata['salary_type']; ?><br>
					<b>Salary Amount :</b> <?php echo $arrdata['salary_amount']; ?><br>
					<b>Salary Date :</b> <?php echo $arrdata['salary_date']; ?><br>
					<b>Salary Descriptions :</b> <?php echo $arrdata['salary_desc']; ?>
				</div>
				</div>

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
