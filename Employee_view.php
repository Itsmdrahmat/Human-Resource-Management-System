<?php
session_start();
?>

<?php
include 'dbcon.php';
	
	$selectquery = "select * from notice";
	$query = mysqli_query($con,$selectquery);
	$noofnotices = mysqli_num_rows($query);

	$ids = $_SESSION['fetchempid'];	
	$selectquery2 = "select * from payroll where emp_id = '$ids'";
	$query2 = mysqli_query($con,$selectquery2);
	$noofpayslip = mysqli_num_rows($query2);

	$selectquery3 = "select * from leaves where emp_id = '$ids'";
	$query3 = mysqli_query($con,$selectquery3);
	$noofleave = mysqli_num_rows($query3);

	$counttraining = 0;
	$selectquery1 = "select * from training where status='Upcoming'";
	$query1 = mysqli_query($con,$selectquery1);
		while($arrdata = mysqli_fetch_array($query1))
		{
			$storedata  = $arrdata['employee'];
			if (strpos($storedata, $ids) !== false)
			{
				$counttraining = $counttraining + 1;
			}
		}

?>

<!DOCTYPE html>
<html>
	<title>HRMS : Employee</title>
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
			<a class="w3-bar-item w3-button w3-green w3-hover-green" href="Employee_view.php"><i class="fa fa-home fa-fw"></i> Home</a>
			<a class="w3-bar-item w3-button w3-hover-green" href="Apply_Leave.php"><i class="fa fa-arrow-right fa-fw"></i> Apply Leave</a>
			<a class="w3-bar-item w3-button w3-hover-green" href="View_Trainings.php"><i class="fa fa-address-book fa-fw"></i> View Trainings</a>
			<a class="w3-bar-item w3-button w3-hover-green" href="View_Payroll.php"><i class="fa fa-bookmark fa-fw"></i> View Payroll</a>
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
	<h2 class="w3-text-indigo"><i class="fa fa-dashboard"></i> Dashboard</h2>
	<div class="w3-container w3-light-gray">
		<div class="w3-row-padding w3-margin-bottom w3-margin-top">
			<div class="w3-quarter">
				<div class="w3-container w3-red w3-padding-16">
					<div class="w3-left"><i class="fa fa-comment w3-xxxlarge"></i></div>
					<div class="w3-right">
					<h3><?php echo "$noofnotices";  ?></h3>
					</div>
					<div class="w3-clear"></div>
					<h4>Notices</h4>
				</div>
			</div>

			<div class="w3-quarter">
				<div class="w3-container w3-teal w3-text-white w3-padding-16">
					<div class="w3-left"><i class="fa fa-address-book w3-xxxlarge"></i></div>
					<div class="w3-right">
					<h3><?php echo "$counttraining";  ?></h3>
					</div>
					<div class="w3-clear"></div>
					<h4>Upcoming Trainings</h4>
				</div>
			</div>

			<div class="w3-quarter">
				<div class="w3-container w3-orange w3-text-white w3-padding-16">
					<div class="w3-left"><i class="fa fa-dollar w3-xxxlarge"></i></div>
					<div class="w3-right">
					<h3><?php echo "$noofpayslip";  ?></h3>
					</div>
					<div class="w3-clear"></div>
					<h4>Pay Slip</h4>
				</div>
			</div>
						
			<div class="w3-quarter">
				<div class="w3-container w3-indigo w3-text-white w3-padding-16">
					<div class="w3-left"><i class="fa fa-arrow-right w3-xxxlarge"></i></div>
					<div class="w3-right">
					<h3><?php echo "$noofleave";  ?></h3>
					</div>
					<div class="w3-clear"></div>
					<h4>Applied Leaves</h4>
				</div>
			</div>
		</div>
	</div>
	<h2 class="w3-text-indigo"><i class="fa fa-comment"></i> New Notice</h2>	
	<div class="w3-container w3-light-gray">
		<?php
			include 'dbcon.php';
			$selectquery = "select *from notice ORDER BY notice_id DESC LIMIT 2";
			$query = mysqli_query($con,$selectquery);
			$nums = mysqli_num_rows($query);
			
			while($res = mysqli_fetch_array($query))
			{
				?>
					<div class="w3-panel w3-padding-large w3-card-4 w3-light-grey">
					<h2 class="w3-center"><?php echo $res['subject']; ?></h2>
					<div class="w3-large">
						<p class="w3-right"><?php echo $res['creating_date']; ?></p><br><br>
						<h3 class="w3-center"><?php echo $res['name']; ?></h3><br>
						<p><?php echo $res['description']; ?></p>
					</div>
					</div>
					
				
				<?php
			}
		
		?>
	<a href="Notices.php" class="w3-button w3-right w3-hover-green w3-theme">Show All Notices</a>
	<br><br><br>
	</div>
	<h2 class="w3-text-indigo"><i class="fa fa-address-book"></i> Upcoming Trainings</h2>	<br>
	<div class="w3-container w3-light-gray">
	<div class="table-responsive">
	<table id="table1">
	<thead>
	<tr>
		<th>Name</th>
		<th>Type</th>
		<th>Date</th>
		<th>Time</th>
		<th>Status</th>
	</tr>
	</thead>
	<tbody>
	<?php
		include 'dbcon.php';
		$ids = $_SESSION['fetchempid'];

		$selectarray = "SELECT * from training where status = 'Upcoming'";
		$query = mysqli_query($con,$selectarray);
		while($arrdata = mysqli_fetch_array($query))
		{
			$storedata  = $arrdata['employee'];
			if (strpos($storedata, $ids) !== false)
			{
				?>
				<tr>
					<td><?php echo $arrdata['training_name']; ?></td>
					<td><?php echo $arrdata['training_type']; ?></td>
					<td><?php echo $arrdata['from_date']; ?> <b>To</b> <?php echo $arrdata['to_date']; ?></td>
					<td><?php echo $arrdata['from_time']; ?> <b>To</b> <?php echo $arrdata['to_time']; ?></td>
					<td><b><?php echo $arrdata['status']; ?></b></td>
				</tr>
				<?php
			}
		}
		
				
		
	?>

	</tbody>
	</table>
	</div> <br>
	<a href="View_Trainings.php" class="w3-button w3-right w3-hover-green w3-theme">Show All Trainings</a>
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
