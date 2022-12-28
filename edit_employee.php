<?php
session_start();
?>

<?php
include 'dbcon.php';
	$ids = $_GET['id'];
	
	$updatequery = "select * from employee where emp_id = '$ids'";
	$showdata = mysqli_query($con,$updatequery);
	$arrdata = mysqli_fetch_array($showdata);
	
if(isset($_POST['submit']))
{
	$emp_id = mysqli_real_escape_string($con, $_POST['empid']);
	$emp_name = mysqli_real_escape_string($con, $_POST['name']);
	$emp_mobile = mysqli_real_escape_string($con, $_POST['mobile']);
	$emp_address = mysqli_real_escape_string($con, $_POST['address']);
	$emp_city = mysqli_real_escape_string($con, $_POST['city']);
	$emp_zipcode = mysqli_real_escape_string($con, $_POST['zipcode']);
			
	$updatequery1 = "update employee set emp_id = '$emp_id',
					name = '$emp_name',
					emp_mobile = '$emp_mobile',
					address = '$emp_address',
					city = '$emp_city',
					zipcode = '$emp_zipcode' where emp_id = '$emp_id'";
							
	$uquery = mysqli_query($con, $updatequery1);

	if($uquery)
	{	
		?>
		<script>
			alert("Updated Successfully");
			location.replace('Manage_Employee.php');
		</script>
		<?php
	}
	else
	{
		?>
		<script>
			alert("Do not Update");
		</script>
		<?php
	}
}
?>

<!DOCTYPE html>
<html>
	<title>HRMS : Manage Employee</title>
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
			<a class="w3-bar-item w3-button w3-green w3-hover-green" href="Manage_Employee.php"><i class="fa fa-users fa-fw"></i> Manage Employee</a>
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
	<p><a href="Manage_Employee.php">Manage Employee</a> &#8680; <a href="edit_employee.php">Edit Employee</a></p>
	<div class="w3-container w3-light-gray">
	<form action="<?php echo htmlentities($_SERVER['PHP_SELF']); ?>" method="POST">
				<h3>&#10070; <u>Personal Information</u> :-</h3>
				
				<label><b>Employee ID</b></label>
				<input class="input-field" type="text" value ="<?php echo $arrdata['emp_id']; ?>" name="empid" readonly>
				
				<label><b>Name</b></label>
				<input class="input-field" type="text" value ="<?php echo $arrdata['name']; ?>" name="name" placeholder="Enter your Name.." pattern="[A-Za-z, ]{4,}" title="Name must contain minimum four letters " required>
					
				<label><b>Mobile no.</b></label>
				<input class="input-field" type="text" value ="<?php echo $arrdata['emp_mobile']; ?>" name="mobile" placeholder="Mobile number" pattern="[0-9]{10}" title="Please enter valid mobile number." required>
					
				<label><b>Address line</b></label>
				<input class="input-field" type="text" value ="<?php echo $arrdata['address']; ?>" name="address" placeholder="House No./Bldg./Apt./Street :" title="Only letters and white space allowed" required>
				
				<label><b>City</b></label>
				<input class="input-field" type="text" name="city" value ="<?php echo $arrdata['city']; ?>" placeholder="City.. " pattern="[A-Za-z, ]{4,}" title="Only letters and white space allowed" required>
				
				<label><b>Zip Code</b></label>
				<input class="input-field" type="text" name="zipcode" value ="<?php echo $arrdata['zipcode']; ?>" placeholder="Zip Code" pattern="[0-9]{6}" title="Zip Code must contains only six digit." required>
		
					<button type="submit" class="w3-button w3-theme w3-right w3-hover-green" name="submit">Update</button>
			</form>
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
