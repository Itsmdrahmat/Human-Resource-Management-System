<?php
session_start();
?>

<?php
include 'dbcon.php';
if(isset($_POST['submit']))
{
	$auto_q = ("SELECT id FROM training");
	$res = mysqli_query($con,$auto_q);
	$last_id = 0;
	while($row = mysqli_fetch_array($res))
	{
		$last_id = $row['id'];
	}
	$next_id = ($last_id+1);
	$prefix = "T";
	
	$training_id = $prefix."-".sprintf('%05d',$next_id);
	
	$creating_date = date('Y-m-d');
	
	$training_name = mysqli_real_escape_string($con, $_POST['training_name']);
	$training_type = mysqli_real_escape_string($con, $_POST['training_type']);
	$select_employee = mysqli_real_escape_string($con, $_POST['select_employee']);
	$fromdate = mysqli_real_escape_string($con, $_POST['fromdate']);
	$todate = mysqli_real_escape_string($con, $_POST['todate']);
	$fromtime = mysqli_real_escape_string($con, $_POST['fromtime']);
	$totime = mysqli_real_escape_string($con, $_POST['totime']);
	$training_desc = mysqli_real_escape_string($con, $_POST['training_desc']);


	$insertquery = "insert into training(training_id,training_name,training_type,employee,from_date,to_date,from_time,to_time,training_desc,creating_date,status) values('$training_id','$training_name','$training_type','$select_employee','$fromdate','$todate','$fromtime','$totime','$training_desc','$creating_date','Upcoming')";
							
	$iquery = mysqli_query($con, $insertquery);

	if($iquery)
	{	
		?>
		<script>
			location.replace("Manage_Training.php");
		</script>
		<?php
	}
	
}
?>

<!DOCTYPE html>
<html>
	<title>HRMS : Manage Training</title>
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
			<a class="w3-bar-item w3-button w3-green w3-hover-green" href="Manage_Training.php"><i class="fa fa-address-book fa-fw"></i> Manage Training</a>
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
	<h2 align="center" class="w3-text-indigo"><i class="fa fa-address-book"></i> Training Details</h2><br>
	<form action="<?php echo htmlentities($_SERVER['PHP_SELF']); ?>" method="POST">
		<h3>&#10070; <u>Fill out this Field to Create Training</u> :-</h3>
	
		<input type="text" name="training_name" placeholder="Training Name" required>

		<select id="Training_type" name="training_type" required>
		<option value="">Select Type -</option>
		<option value="Technical or Technology Training">Technical or Technology Training</option>
		<option value="Quality Training">Quality Training</option>
		<option value="Skills Training">Skills Training</option>
		<option value="Soft Skills Training">Soft Skills Training</option>
		<option value="Professional Training and Legal Training">Professional Training and Legal Training</option>
		<option value="Team Training">Team Training</option>
		<option value="Managerial Training">Managerial Training</option>
		<option value="Safety Training">Safety Training</option>
		</select><br><br>
		<?php
			//All employee
			$selectquery = "select *from employee";
			$query = mysqli_query($con,$selectquery);
			$store = Array();
			while($arrdata = mysqli_fetch_array($query))
			{	
				$store[] = $arrdata['emp_id'];
			}

		?>
		
		<?php
			//Freshers employee
			include 'dbcon.php';
			$until = new DateTime();
			$interval = new DateInterval('P1M');
			$date = $until->sub($interval);
			$Freshers = $date->format('Y-m-d');

			$selectquery1 = "select *from employee WHERE emp_doj > '$Freshers'";
			$query1 = mysqli_query($con,$selectquery1);
			$store1 = Array();
			while($arrdata1 = mysqli_fetch_array($query1))
			{
				$store1[] = $arrdata1['emp_id'];
			}
		?>

		<?php
			//last six months
			include 'dbcon.php';
			$until = new DateTime();
			$interval = new DateInterval('P6M');
			$date = $until->sub($interval);
			$lastsix = $date->format('Y-m-d');
			$store2 = Array();
			$selectquery2 = "select *from employee WHERE emp_doj > '$lastsix'";
			$query2 = mysqli_query($con,$selectquery2);
			
			while($arrdata2 = mysqli_fetch_array($query2))
			{
				$store2[] = $arrdata2['emp_id'];
			}
		?>

		<?php
			//Last one years
			include 'dbcon.php';
			$until = new DateTime();
			$interval = new DateInterval('P12M');
			$date = $until->sub($interval);
			$lastoneyear = $date->format('Y-m-d');
			$store3 = Array();
			$selectquery3 = "select *from employee WHERE emp_doj > '$lastoneyear'";
			$query3 = mysqli_query($con,$selectquery3);
			while($arrdata3 = mysqli_fetch_array($query3))
			{
				$store3[] = $arrdata3['emp_id'];
			}
		?>

		<?php
			//Last five years
			include 'dbcon.php';
			$until = new DateTime();
			$interval = new DateInterval('P60M');
			$date = $until->sub($interval);
			$lastfiveyear = $date->format('Y-m-d');
			$store4 = Array();
			$selectquery4 = "select *from employee WHERE emp_doj > '$lastfiveyear'";
			$query4 = mysqli_query($con,$selectquery4);
			while($arrdata4 = mysqli_fetch_array($query4))
			{
				$store4[] = $arrdata4['emp_id'];
			}
		?>

		<select id="Training_emp" name="select_employee">
			<option value="<?php echo implode(", ",$store); ?>">All Employees</option>
			<option value="<?php echo implode(", ",$store1); ?>">Freshers</option>
			<option value="<?php echo implode(", ",$store2); ?>">Last six Months Employees</option>
			<option value="<?php echo implode(", ",$store3); ?>">Last one years Employees</option>
			<option value="<?php echo implode(", ",$store4); ?>">Last five years Employees</option>		
		</select><br><br>

		<label>Date From :</label>
		<input type="date" id="idate" name="fromdate" required>
		<label>To :</label>
		<input type="date" id="idate" name="todate" required>

		<label>Time From :</label>
		<input type="time" id="idate" name="fromtime" required>
		<label>To :</label>
		<input type="time" id="idate" name="totime" required>


		<textarea type="text" name="training_desc" placeholder="Write about Training" required></textarea>
		<br><br>
		<button type="submit" class="w3-button w3-theme w3-hover-green" name="submit">Create Training</button>
	</form><br><hr class="new">	
	
	
	<input type="text" id="myInput" onkeyup="myFunction()" placeholder="Search by Training Name..." title="Type Training Name">
	<input type="text" id="myInput1" onkeyup="myFunction1()" placeholder="Search by Training Type..." title="Enter Training Type">
	<br><br>
	<div align="center">
	<b>Filter :</b>&nbsp;&nbsp;&nbsp;	
	<a href="Manage_Training.php" id="filter" class="w3-theme w3-button w3-hover-green">Show All</a>
	<a href="Upcoming_training.php" id="filter" class="w3-theme w3-button w3-hover-green">Upcoming</a>
	<a href="Running_training.php" id="filter" class="w3-theme w3-button w3-hover-green">Running</a>
	<a href="Completed_training.php" id="filter" class="w3-green w3-button w3-hover-green">Completed</a>
	</div>

	
	
	<br>
	<div class="table-responsive">
	<table id="table1">
	<thead>
	<tr>
		<th>Training ID</th>
		<th>Name</th>
		<th>Type</th>
		<th>Date</th>
		<th>Time</th>
		<th>Status</th>
		<th colspan="2">Operations</th>
	</tr>
	</thead>
	<tbody>
	<?php
		include 'dbcon.php';
		$selectquery = "SELECT *from training WHERE status = 'Completed' ORDER BY training_id DESC";
		$query = mysqli_query($con,$selectquery);
		$nums = mysqli_num_rows($query);
		
		while($res = mysqli_fetch_array($query))
		{
			?>
			<tr>
				<td><?php echo $res['training_id']; ?></td>
				<td><?php echo $res['training_name']; ?></td>
				<td><?php echo $res['training_type']; ?></td>
				<td><?php echo $res['from_date']; ?> <b>To</b> <?php echo $res['to_date']; ?></td>
				<td><?php echo $res['from_time']; ?> <b>To</b> <?php echo $res['to_time']; ?></td>
				<td><b><?php echo $res['status']; ?></b></td>
				<td><a href="start_training.php?id=<?php echo $res['training_id']; ?>" class="w3-text-Blue w3-large" data-toggle="tooltip" data-placement="top" title="START"><i class="fa fa-sign-in fa-fw"></i></a>
					<a href="finish_training.php?id=<?php echo $res['training_id']; ?>" class="w3-text-green w3-large" data-toggle="tooltip" data-placement="top" title="FINISH"><i class="fa fa-check fa-fw"></i></a>
				</td>
				<td><a href="show_training.php?id=<?php echo $res['training_id']; ?>" class="w3-text-black w3-large" data-toggle="tooltip" data-placement="top" title="VIEW"><i class="fa fa-eye fa-fw"></i></a>
					<a href="delete_training.php?id=<?php echo $res['training_id']; ?>" class="w3-text-red w3-large" data-toggle="tooltip" data-placement="top" title="DELETE" onclick="deleteFunction()"><i class="fa fa-trash fa-fw"></i></a>
				</td>
			</tr>
			<?php
		}
	
	?>	
	</tbody>
	</table>
	</div>
	<br><br>	
	<br>	
	
	</div>

	<footer class="w3-panel w3-padding-16 w3-card-4 w3-theme w3-center">
		<p>&copy;Copyright 2021. All rights reserved.</p> 
	</footer>
	
	
	</div>
	<script>
		function myFunction() 
		{
			var input, filter, table, tr, td, i, txtValue;
			input = document.getElementById("myInput");
			filter = input.value.toUpperCase();
			table = document.getElementById("table1");
			tr = table.getElementsByTagName("tr");
			for (i = 1; i < tr.length; i++) 
			{
				td = tr[i].getElementsByTagName("td")[1];
				if (td) 
				{
					txtValue = td.textContent || td.innerText;
					if (txtValue.toUpperCase().indexOf(filter) > -1) 
					{
						tr[i].style.display = "";
					} 
					else 
					{
						tr[i].style.display = "none";
					}
				}       
			}
		}
	</script>

	<script>
		function myFunction1() 
		{
			var input, filter, table, tr, td, i, txtValue;
			input = document.getElementById("myInput1");
			filter = input.value.toUpperCase();
			table = document.getElementById("table1");
			tr = table.getElementsByTagName("tr");
			for (i = 1; i < tr.length; i++) 
			{
				td = tr[i].getElementsByTagName("td")[2];
				if (td) 
				{
					txtValue = td.textContent || td.innerText;
					if (txtValue.toUpperCase().indexOf(filter) > -1) 
					{
						tr[i].style.display = "";
					} 
					else 
					{
						tr[i].style.display = "none";
					}
				}       
			}
		}
	</script>

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

	<script>
		$(document).ready(function(){
		  $('[data-toggle="tooltip"]').tooltip();
		});
	</script>

	<script>
		function deleteFunction() {
		  confirm("Are you sure to delete Training");
		}
	</script>
</body>
</html>
