<!DOCTYPE html>
<html>
	<title>HRMS : Manage Leave</title>
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
			<a class="w3-bar-item w3-button w3-hover-green" href="Manage_Training.php"><i class="fa fa-address-book fa-fw"></i> Manage Training</a>
			<a class="w3-bar-item w3-button w3-hover-green" href="Manage_Payroll.php"><i class="fa fa-bookmark fa-fw"></i> Manage Payroll</a>
			<a class="w3-bar-item w3-green w3-button w3-hover-green" href="Manage_Leave.php"><i class="fa fa-home fa-fw"></i> Manage Leave</a>
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
	<h2 align="center" class="w3-text-indigo"><i class="fa fa-home"></i> Leave Details</h2><br>
	<input type="text" id="search" onkeyup="myFunction()" placeholder="Search by names.." title="Type in a name"><br><br>
	<div align="center">
	<b>Filter :</b>&nbsp;&nbsp;&nbsp;
	<a href="Manage_Leave.php" id="filter" class="w3-theme w3-button w3-hover-green">Show All</a>
	<a href="leave_pending.php" id="filter" class="w3-theme w3-button w3-hover-green">Pending</a>
	<a href="leave_approve.php" id="filter" class="w3-green w3-button w3-hover-green">Approved</a>
	<a href="leave_reject.php" id="filter" class="w3-theme w3-button w3-hover-green">Rejected</a>
	</div><br>

	<div class="table-responsive">
	<table id="table1">
	<thead>
	<tr>
		<th>Leave ID</th>
		<th>Name</th>
		<th>Leave Type</th>
		<th>From</th>
		<th>To</th>
		<th>Status</th>
		<th colspan="2">Operations</th>
	</tr>
	</thead>
	<tbody>
	<?php
		include 'dbcon.php';
		$selectquery = "select *from leaves where status = 'Approved' ORDER BY leave_id DESC";
		$query = mysqli_query($con,$selectquery);
		$nums = mysqli_num_rows($query);
		
		while($res = mysqli_fetch_array($query))
		{
			?>
			<tr>
				<td><?php echo $res['leave_id']; ?></td>
				<td><?php echo $res['emp_name']; ?></td>
				<td><?php echo $res['leave_type']; ?></td>
				<td><?php echo $res['from_date']; ?></td>
				<td><?php echo $res['to_date']; ?></td>
				<td><b><?php echo $res['status']; ?></b></td>
				<td>
					<a href="approve.php?id=<?php echo $res['leave_id']; ?>" class="w3-text-green w3-large" data-toggle="tooltip" data-placement="top" title="APPROVE"><i class="fa fa-check fa-fw"></i></a>
					<a href="reject.php?id=<?php echo $res['leave_id']; ?>" class="w3-text-red w3-large" data-toggle="tooltip" data-placement="top" title="REJECT"><i class="fa fa-times fa-fw"></i></a>
				</td>
				<td>
					<a href="view_leave.php?id=<?php echo $res['leave_id']; ?>" class="w3-text-green w3-large" data-toggle="tooltip" data-placement="top" title="VIEW"><i class="fa fa-eye fa-fw"></i></a>
					<a href="delete_leave.php?id=<?php echo $res['leave_id']; ?>" class="w3-text-red w3-large" data-toggle="tooltip" data-placement="top" title="DELETE" onclick="deleteFunction()"><i class="fa fa-trash fa-fw"></i></a>
				</td>
			</tr>
			<?php
		}
	
	?>
	
	</tbody>
	</table>
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
			input = document.getElementById("search");
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
		  confirm("Are you sure to delete Leave");
		}
	</script>
</body>
</html>
