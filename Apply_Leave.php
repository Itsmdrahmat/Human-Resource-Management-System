<?php
session_start();
?>

<?php
include 'dbcon.php';
	$ids = $_SESSION['fetchempid'];
	
	$updatequery = "select * from employee where emp_id = '$ids'";
	$showdata = mysqli_query($con,$updatequery);
	$arrdata = mysqli_fetch_array($showdata);
	$emailid = $arrdata['email'];

if(isset($_POST['submit']))
{
	$auto_q = ("SELECT id FROM leaves");
	$res = mysqli_query($con,$auto_q);
	$last_id = 0;
	while($row = mysqli_fetch_array($res))
	{
		$last_id = $row['id'];
	}
	$next_id = ($last_id+1);
	$prefix = "L";

	$leave_id = $prefix."-".sprintf('%05d',$next_id);
	$apply_date = date('Y-m-d');
	$emp_id = mysqli_real_escape_string($con, $_POST['empid']);
	$emp_name = mysqli_real_escape_string($con, $_POST['empname']);
	$leavetype = mysqli_real_escape_string($con, $_POST['leavetype']);
	$fromdate = mysqli_real_escape_string($con, $_POST['fromdate']);
	$todate = mysqli_real_escape_string($con, $_POST['todate']);
	$leavedesc = mysqli_real_escape_string($con, $_POST['leavedesc']);

	$insertquery = "insert into leaves(leave_id,emp_id,emp_name,leave_type,from_date,to_date,apply_date,about_leave,status)
					values('$leave_id','$emp_id','$emp_name','$leavetype','$fromdate','$todate','$apply_date','$leavedesc','Pending')";
							
	$iquery = mysqli_query($con, $insertquery);

	if($iquery)
	{	
		$subject = "Your Leave Requested form HRMS";
		$body = "Dear ($emp_name), I am very excited to be offered the position of [$leavetype] at HR Management System. However, before accepting your offer, I'd like to discuss the base salary for this position. Although HR Management System is my first choice, I've received another job offer with a higher base salary of $fromdate to $todate.";
					
		$Sender = "From: infoswaxmr@gmail.com";

		if (mail($emailid, $subject, $body, $Sender)) 
		{
			?>
			<script>
				echo "Leave Requested Successfully";
			</script>
			<?php
			header('location:Apply_Leave.php');

		}
		else 
		{	
			?>
			<script>
				echo "Email sending failed...";
			</script>
			<?php
		}

	}
	
}
?>

<!DOCTYPE html>
<html>
	<title>Employee : Apply Leave</title>
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
			<a class="w3-bar-item w3-button w3-green w3-hover-green" href="Apply_Leave.php"><i class="fa fa-arrow-right fa-fw"></i> Apply Leave</a>
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
	<div class="w3-container w3-light-gray">
	<h2 align="center" class="w3-text-indigo"><i class="fa fa-home"></i> Apply Leave</h2><br>
	<form action="<?php echo htmlentities($_SERVER['PHP_SELF']); ?>" method="POST">
		<h3>&#10070; <u>Fill out this field to create Leave</u> :-</h3>
		
		<input type="text" name="empid" value ="<?php echo $arrdata['emp_id']; ?>" readonly>
		<input type="text" name="empname" value ="<?php echo $arrdata['name']; ?>" readonly>                 		
		<select id="" name="leavetype" required>
			<option value="">Select Leave Type...</option>
			<option value="Privilege Leave or Earned Leave">Privilege Leave or Earned Leave</option>
			<option value="Casual Leave">Casual Leave</option>
			<option value="Sick Leave">Sick Leave</option>
			<option value="Maternity Leave">Maternity Leave</option>
			<option value="Compensatory Off">Compensatory Off</option>
			<option value="Marriage Leave">Marriage Leave</option>
			<option value="Paternity Leave">Paternity Leave</option>
			<option value="Bereavement Leave">Bereavement Leave</option>
			<option value="Loss of Pay or Leave Without Pay">Loss of Pay or Leave Without Pay</option>			
			<option value="Other">Other</option>
		</select><br><br>
		<label>From :</label>
		<input type="date" id="idate" name="fromdate" required>
		<label>To :</label>
		<input type="date" id="idate" name="todate" required>
		<textarea type="text" name="leavedesc" placeholder="About Leave..." required></textarea>
		<br><br>
		<button type="submit" class="w3-button w3-theme w3-hover-green" name="submit">Apply Leave</button>
	</form><br>
	<br><hr class="new">
	<div class="table-responsive">
	<table id="table1">
	<thead>
	<tr>
		<th>Your ID</th>
		<th>Leave_Type</th>
		<th>From</th>
		<th>To</th>
		<th>Status</th>
	</tr>
	</thead>
	<tbody>
	<?php
		include 'dbcon.php';
		$selectquery = "select *from leaves where emp_id = '$ids' ORDER BY leave_id DESC";
		$query = mysqli_query($con,$selectquery);
		$nums = mysqli_num_rows($query);
		
		while($res = mysqli_fetch_array($query))
		{
			?>
			<tr>
				<td><?php echo $res['emp_id']; ?></td>
				<td><?php echo $res['leave_type']; ?></td>
				<td><?php echo $res['from_date']; ?></td>
				<td><?php echo $res['to_date']; ?></td>
				<td><b><?php echo $res['status']; ?></b></td>			
			</tr>
			<?php
		}
	
	?>
	
	</tbody>
	</table>
	<br>
		
	
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
