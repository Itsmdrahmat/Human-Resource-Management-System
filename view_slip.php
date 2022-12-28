<?php
session_start();
?>

<?php
include 'dbcon.php';
	$ids = $_GET['id'];
	
	$updatequery = "select * from payroll where salary_id = '$ids'";
	$showdata = mysqli_query($con,$updatequery);
	$arrdata = mysqli_fetch_array($showdata);
?>


<!DOCTYPE html>
<html>
	<title>HRMS : Manage Payroll</title>
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
			<a class="w3-bar-item w3-button w3-hover-green" href="Admin_view.php"><i class="fa fa-dashboard fa-fw"></i> Dashboard</a>
			<a class="w3-bar-item w3-button w3-hover-green" href="View_Profile.php"><i class="fa fa-user-circle fa-fw"></i> View Profile</a>
			<a class="w3-bar-item w3-button w3-hover-green" href="Manage_Employee.php"><i class="fa fa-users fa-fw"></i> Manage Employee</a>
			<a class="w3-bar-item w3-button  w3-hover-green" href="Manage_Training.php"><i class="fa fa-address-book fa-fw"></i> Manage Training</a>
			<a class="w3-bar-item w3-button w3-green w3-hover-green" href="Manage_Payroll.php"><i class="fa fa-bookmark fa-fw"></i> Manage Payroll</a>
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

		<p><a href="Manage_Payroll.php">Manage Payroll</a> &#8680; <a href="vie_slip.php">View Payroll</a></p>
	<div class="w3-container w3-light-gray">
	<h2 align="center" class="w3-text-indigo"><i class="fa fa-bookmark"></i> View Payroll Details</h2><br>
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
		<td>Salary ID</td>
		<td><?php echo $arrdata['salary_id']; ?></td>
	</tr>
	<tr>
		<td>Employee ID</td>
		<td><?php echo $arrdata['emp_id']; ?></td>
	</tr>
	<tr>
		<td>Employee Name</td>
		<td><?php echo $arrdata['emp_name']; ?></td>
	</tr>
	<tr>
		<td>Salary Type</td>
		<td><?php echo $arrdata['salary_type']; ?></td>
	</tr>
	<tr>
		<td>Salary Amount</td>
		<td><?php echo $arrdata['salary_amount']; ?></td>
	</tr>
	<tr>
		<td>Salary Date</td>
		<td><?php echo $arrdata['salary_date']; ?></td>
	</tr>
	<tr>
		<td>Salary Descriptions</td>
		<td><?php echo $arrdata['salary_desc']; ?></td>
	</tr>
	</tbody>
	</table>
	</div>
	</div>
	<br><br><br><br><br><br><br><br>
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
