<?php
session_start();
?>

<?php
include 'dbcon.php';
if(isset($_POST['submit']))
{
	$auto_q = ("SELECT id FROM payroll");
	$res = mysqli_query($con,$auto_q);
	$last_id = 0;
	while($row = mysqli_fetch_array($res))
	{
		$last_id = $row['id'];
	}
	$next_id = ($last_id+1);
	$prefix = "P";

	$salary_id = $prefix."-".sprintf('%05d',$next_id);
	
	$salary_date = date('Y-m-d');
	
	$emp_id = mysqli_real_escape_string($con, $_POST['emp_id']);
	$emp_name = mysqli_real_escape_string($con, $_POST['emp_name']);
	$salary_type = mysqli_real_escape_string($con, $_POST['salary_type']);
	$salary_amount = mysqli_real_escape_string($con, $_POST['salary_amount']);
	$salary_desc = mysqli_real_escape_string($con, $_POST['salary_desc']);
	

	$insertquery = "insert into payroll(salary_id,emp_id,emp_name,salary_type,salary_amount,salary_date,salary_desc)
					values('$salary_id','$emp_id','$emp_name','$salary_type','$salary_amount','$salary_date','$salary_desc')";
							
	$iquery = mysqli_query($con, $insertquery);

	if($iquery)
	{	
		$subject = "Your Salary Released form HRMS";
		$body = "Dear ($emp_name), I am very excited to be offered the position of [$salary_type] at HR Management System. However, before accepting your offer, I'd like to discuss the base salary for this position. Although HR Management System is my first choice, I've received another job offer with a higher base salary of ($salary_amount).";
					
		$Sender = "From: infoswaxmr@gmail.com";
		$emp_email = "sonurprajapati1112@gmail.com";

		if (mail($emp_email, $subject, $body, $Sender)) 
		{
			?>
			<script>
				echo "Salary Released Successfully";
			</script>
			<?php
			header('location:Manage_Payroll.php');

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
	<div class="w3-container w3-light-gray">
	<h2 align="center" class="w3-text-indigo"><i class="fa fa-bookmark"></i> Payroll Details</h2><br>
	<form action="<?php echo htmlentities($_SERVER['PHP_SELF']); ?>" method="POST">
		<h3>&#10070; <u>Fill out this Field to Create Pay Slip</u> :-</h3>
	
		

		<select id="" name="emp_id" required>
			<option value="">Select Employee ID...</option>
			<?php
				include 'dbcon.php';
				$selectquery = "select *from employee";
				$query = mysqli_query($con,$selectquery);
				$nums = mysqli_num_rows($query);
				
				while($res = mysqli_fetch_array($query))
				{
					?>
						<option value="<?php echo $res['emp_id']; ?>"><?php echo $res['emp_id']; ?></option>
					<?php
				}
			?>

		</select><br><br>

		<select id="" name="emp_name" required>
			<option value="">Select Employee Name...</option>
			<?php
				include 'dbcon.php';
				$selectquery = "select *from employee";
				$query = mysqli_query($con,$selectquery);
				$nums = mysqli_num_rows($query);
				
				while($res = mysqli_fetch_array($query))
				{
					?>
						<option value="<?php echo $res['name']; ?>"><?php echo $res['name']; ?></option>
					<?php
				}
			?>

		</select><br><br>

		<select id="" name="salary_type" required>
			<option value="">Select Type...</option>
			<option value="Basic Salary">Basic Salary</option>
			<option value="Allowances">Allowances</option>
			<option value="Gratuity">Gratuity</option>
			<option value="Employee Provident Fund">Employee Provident Fund</option>
			<option value="Professional Tax">Professional Tax</option>
			<option value="Perquisites">Perquisites</option>
		</select><br><br>

		<input type="text" name="salary_amount" placeholder="Salary Amount..." required>
		<textarea type="text" name="salary_desc" placeholder="About Salary..." required></textarea>

		
		<br><br>

		<button type="submit" class="w3-button w3-theme w3-hover-green" name="submit">Create Pay Slip</button>
	</form><br>
	<hr class="new">	
	
	
	<input type="text" id="search" onkeyup="myFunction()" placeholder="Search by Names.." title="Type in a name">
		
	<br><br>
	<div class="table-responsive">
	<table id="table1">
	<thead>
	<tr>
		<th>Payroll ID</th>
		<th>Name</th>
		<th>Salary Type</th>
		<th>Amount</th>
		<th>Date</th>
		<th>Operations</th>
	</tr>
	</thead>
	<tbody>
	<?php
		include 'dbcon.php';
		$selectquery = "select *from payroll ORDER BY salary_id DESC";
		$query = mysqli_query($con,$selectquery);
		$nums = mysqli_num_rows($query);
		
		while($res = mysqli_fetch_array($query))
		{
			?>
			<tr>
				<td><?php echo $res['salary_id']; ?></td>
				<td><?php echo $res['emp_name']; ?></td>
				<td><?php echo $res['salary_type']; ?></td>
				<td><?php echo $res['salary_amount']; ?></td>
				<td><?php echo $res['salary_date']; ?></td>
				<td><a href="view_slip.php?id=<?php echo $res['salary_id']; ?>" class="w3-text-green w3-large" data-toggle="tooltip" data-placement="top" title="VIEW"><i class="fa fa-eye fa-fw"></i></a>
					<a href="delete_payroll.php?id=<?php echo $res['salary_id']; ?>" class="w3-text-red w3-large" data-toggle="tooltip" data-placement="top" title="DELETE" onclick="deleteFunction()"><i class="fa fa-trash fa-fw"></i></a></td>
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
		  confirm("Are you sure to delete Payroll");
		}
	</script>
</body>
</html>
