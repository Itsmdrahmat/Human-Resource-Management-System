<?php
session_start();
?>

<?php
include 'dbcon.php';
	$emp_id = $_SESSION['fetchempid'];
	
	$updatequery = "select * from employee where emp_id = '$emp_id'";
	$showdata = mysqli_query($con,$updatequery);
	$arrdata = mysqli_fetch_array($showdata);
?>

<!DOCTYPE html>
<html>
	<title>Employee - Edit Profile</title>
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
			<a class="w3-bar-item w3-button w3-hover-green" href="View_Payroll.php"><i class="fa fa-bookmark fa-fw"></i> View Payroll</a>
			<a class="w3-bar-item w3-button w3-hover-green" href="Employee_Report.php"><i class="fa fa-random fa-fw"></i> Generate Report</a>
			<a class="w3-bar-item w3-button w3-hover-green" href="Notices.php"><i class="fa fa-comment fa-fw"></i> Notices</a>
			<a class="w3-bar-item w3-button w3-green w3-hover-green" href="emp_view_profile.php"><i class="fa fa-user-circle fa-fw"></i> View Profile</a>
			<a class="w3-bar-item w3-button w3-hover-green" href="emp_edit_profile.php"><i class="fa fa-edit fa-fw"></i> Edit Profile</a>			
			<a class="w3-bar-item w3-button w3-hide-large w3-hover-green" href="Logout.php"><i class="fa fa-sign-out fa-fw"></i> Logout</a>
		</div>
	</div>

	<!-- Overlay effect when opening sidebar on small screens -->
	<div class="w3-overlay w3-hide-large" onclick="w3_close()" style="cursor:pointer" title="close side menu" id="myOverlay"></div>

	<!-- Main content: shift it to the right by 270 pixels when the sidebar is visible -->
	<div class="w3-main w3-container" style="margin-left:250px;margin-top:60px;">
	<div class="w3-container w3-light-gray">
	<h2 align="center" class="w3-text-indigo"><i class="fa fa-user-circle"></i> View Profile</h2><br>
	
	<div class="table-responsive">
	<table id="table1">
	<thead>
	<tr>
		<th>Name</th>
		<th>Information</th>
	</tr>
	</thead>
	<tbody>
	<tr>
		<td>ID</td>
		<td><?php echo $arrdata['emp_id']; ?></td>
	</tr>
	<tr>
		<td>Name</td>
		<td><?php echo $arrdata['name']; ?></td>
	</tr>
	<tr>
		<td>Fathers Name</td>
		<td><?php echo $arrdata['fathers_name']; ?></td>
	</tr>
	<tr>
		<td>Email ID</td>
		<td><?php echo $arrdata['email']; ?></td>
	</tr>
	<tr>
		<td>Contact No.</td>
		<td><?php echo $arrdata['emp_mobile']; ?></td>
	</tr>
	<tr>
		<td>Gender</td>
		<td><?php echo $arrdata['emp_gender']; ?></td>
	</tr>
	<tr>
		<td>Date of Birth</td>
		<td><?php echo $arrdata['emp_dob']; ?></td>
	</tr>
	<tr>
		<td>Date of Joining</td>
		<td><?php echo $arrdata['emp_doj']; ?></td>
	</tr>
	<tr>
		<td>Position</td>
		<td><?php echo $arrdata['position']; ?></td>
	</tr>
	<tr>
		<td>Qualification</td>
		<td><?php echo $arrdata['qualification']; ?></td>
	</tr>
	<tr>
		<td>City</td>
		<td><?php echo $arrdata['city']; ?></td>
	</tr>
	<tr>
		<td>Address</td>
		<td><?php echo $arrdata['address']; ?> <?php echo $arrdata['city']; ?> <?php echo $arrdata['country']; ?> <?php echo $arrdata['zipcode']; ?>.</td>
	</tr>
	</tbody>
	</table>
	</div>
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
