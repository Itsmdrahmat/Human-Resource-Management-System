<?php
session_start();
?>

<?php
include 'dbcon.php';
if(isset($_POST['submit']))
{
	$auto_q = ("SELECT id FROM notice");
	$res = mysqli_query($con,$auto_q);
	$last_id = 0;
	while($row = mysqli_fetch_array($res))
	{
		$last_id = $row['id'];
	}
	$next_id = ($last_id+1);
	$prefix = "N";
	
	$notice_id = $prefix."-".sprintf('%05d',$next_id);
	$creating_date = date('Y-m-d');
	
	$noticename = mysqli_real_escape_string($con, $_POST['noticename']);
	$noticesubject = mysqli_real_escape_string($con, $_POST['noticesubject']);
	$noticedesc = mysqli_real_escape_string($con, $_POST['noticedesc']);
	

	$insertquery = "insert into notice(notice_id,name,subject,description,creating_date) values('$notice_id','$noticename','$noticesubject','$noticedesc','$creating_date')";
							
	$iquery = mysqli_query($con, $insertquery);

	if($iquery)
	{
		?>
		<script>
			alert "Notice Created Successfully";
		</script>
		<?php	
			
	}
	else
	{

		?>
		<script>
			alert "Do Not Created";
		</script>
		<?php
	}


}
?>




<!DOCTYPE html>
<html>
	<title>HRMS : Manage Notice</title>
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
			<a class="w3-bar-item w3-button w3-hover-green" href="Manage_Leave.php"><i class="fa fa-home fa-fw"></i> Manage Leave</a>
			<a class="w3-bar-item w3-button w3-hover-green" href="Manage_Report.php"><i class="fa fa-random fa-fw"></i> Manage Report</a>
			<a class="w3-bar-item w3-button w3-green w3-hover-green" href="Manage_Notice.php"><i class="fa fa-comment fa-fw"></i> Manage Notice</a>
			<a class="w3-bar-item w3-button w3-hide-large w3-hover-green" href="Logout.php"><i class="fa fa-sign-out fa-fw"></i> Logout</a>
		</div>
	</div>

	<!-- Overlay effect when opening sidebar on small screens -->
	<div class="w3-overlay w3-hide-large" onclick="w3_close()" style="cursor:pointer" title="close side menu" id="myOverlay"></div>

	<!-- Main content: shift it to the right by 270 pixels when the sidebar is visible -->
	<div class="w3-main w3-container" style="margin-left:250px;margin-top:60px;">
	<div class="w3-container w3-light-gray">
	<h2 align="center" class="w3-text-indigo"><i class="fa fa-comment"></i> Notice Details</h2><br>
	<form action="<?php echo htmlentities($_SERVER['PHP_SELF']); ?>" method="POST">
		<h3>&#10070; <u>Fill out this field to create Notice</u> :-</h3>
	
		<input type="text" name="noticename" placeholder="Notice Name" required>
		<input type="text" name="noticesubject" placeholder="Notice Subject" required>
		<textarea type="text" name="noticedesc" placeholder="Write Notice" required></textarea>
			<br><br>
		<button type="submit" class="w3-button w3-theme w3-hover-green" name="submit">Create Notice</button>
	</form><br>
		<hr class="new">
	
	
	<input type="text" id="search" onkeyup="myFunction()" placeholder="Search by names.." title="Type in a name">
	
			
	<br><br>
	<div class="table-responsive">
	<table id="table1">
	<thead>
	<tr>
		<th>Notice ID</th>
		<th>Name</th>
		<th>Subject</th>
		<th>Date</th>
		<th>Operations</th>
	</tr>
	</thead>
	<tbody>
	<?php
		include 'dbcon.php';
		$selectquery = "select *from notice ORDER BY notice_id DESC";
		$query = mysqli_query($con,$selectquery);
		$nums = mysqli_num_rows($query);
		
		while($res = mysqli_fetch_array($query))
		{
			?>
			<tr>
				<td><?php echo $res['notice_id']; ?></td>
				<td><?php echo $res['name']; ?></td>
				<td><?php echo $res['subject']; ?></td>
				<td><?php echo $res['creating_date']; ?></td>
				<td><a href="view_notice.php?id=<?php echo $res['notice_id']; ?>" class="w3-text-green w3-large" data-toggle="tooltip" data-placement="top" title="VIEW"><i class="fa fa-eye fa-fw"></i></a>
					<a href="delete_notice.php?id=<?php echo $res['notice_id']; ?>" class="w3-text-red w3-large" data-toggle="tooltip" data-placement="top" title="DELETE" onclick="deleteFunction()"><i class="fa fa-trash fa-fw"></i></a></td>
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
			input = document.getElementById("search");
			filter = input.value.toUpperCase();
			table = document.getElementById("table1");
			tr = table.getElementsByTagName("tr");
			for (i = 0; i < tr.length; i++) 
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
		  confirm("Are you sure to delete Notice");
		}
	</script>
</body>
</html>
