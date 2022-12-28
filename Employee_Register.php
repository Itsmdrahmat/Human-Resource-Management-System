<?php
session_start();
?>

<?php
include 'dbcon.php';
if(isset($_POST['submit']))
{
	$auto_q = ("SELECT id FROM employee");
	$res = mysqli_query($con,$auto_q);
	$last_id = 0;
	while($row = mysqli_fetch_array($res))
	{
		$last_id = $row['id'];
	}
	$next_id = ($last_id+1);
	$prefix = "E";
	
	$emp_id = $prefix."-".sprintf('%05d',$next_id);
	

	//Date of Joining
	$emp_doj = date('Y-m-d');

	//Check employee are 18 years old or not
	$until = new DateTime();
	$interval = new DateInterval('P216M');
	$date = $until->sub($interval);
	$check = $date->format('Y-m-d');

	
	$emp_name = mysqli_real_escape_string($con, $_POST['name']);
	$emp_fathersname= mysqli_real_escape_string($con, $_POST['fathersname']);
	$emp_mobile = mysqli_real_escape_string($con, $_POST['mobile']);
	$emp_dob = mysqli_real_escape_string($con, $_POST['dob']);
	$emp_gender = mysqli_real_escape_string($con, $_POST['gender']);
	$emp_address = mysqli_real_escape_string($con, $_POST['address']);
	$emp_city = mysqli_real_escape_string($con, $_POST['city']);
	$emp_country = mysqli_real_escape_string($con, $_POST['country']);
	$emp_zipcode = mysqli_real_escape_string($con, $_POST['zipcode']);
	$emp_qualification = mysqli_real_escape_string($con, $_POST['qualification']);
	$emp_email = mysqli_real_escape_string($con, $_POST['email']);
	$emp_password = mysqli_real_escape_string($con, $_POST['password']);
	$emp_cpassword = mysqli_real_escape_string($con, $_POST['cpassword']);
	$position = 'Employee';

	$pwd = password_hash($emp_password, PASSWORD_BCRYPT);
	$cpwd = password_hash($emp_cpassword, PASSWORD_BCRYPT);
	
	$token = bin2hex(random_bytes(20));
	
	$emailquery = "select * from employee where email='$emp_email' ";
	$query = mysqli_query($con,$emailquery);
	
	$emailcount = mysqli_num_rows($query);

	if($emailcount>0)
	{
		?>
		<script>
			alert("Email Already Exits");
		</script>
		<?php
	}
	else
	{
		if($emp_password == $emp_cpassword)
			{ 

				if ($emp_dob < $check) 
				{
					
				
					$insertquery = "insert into employee(emp_id,name,fathers_name,emp_mobile,position,emp_dob,emp_doj,emp_gender,address,city,country,zipcode,qualification,email,password,confirm_password,token,status)
								values('$emp_id','$emp_name','$emp_fathersname','$emp_mobile','$position','$emp_dob','$emp_doj','$emp_gender','$emp_address','$emp_city','$emp_country','$emp_zipcode','$emp_qualification','$emp_email','$pwd','$cpwd','$token','inactive')";
								
					$iquery = mysqli_query($con, $insertquery);

					if($iquery)
					{	
						$subject = "Email Verification";
						$body = "Hi, $emp_fname, Click here too activate your account and your Employee ID is : $emp_id.
						http://localhost/HR/emp_activate.php?token=$token ";
						
						$Sender = "From: infoswaxmr@gmail.com";

						if (mail($emp_email, $subject, $body, $Sender)) 
						{
							
							?>
							<script>
							alert ("Successfully Registered Check your mail to activate your account.");
							</script>
							<?php
							?>
							<script>
								location.replace("emp_login.php");
							</script>
							<?php
						}
						else 
						{	
							?>
							<script>
							alert ("Email sending failed...");
							</script>
							<?php
						}
						?>
						<script>
							location.replace("emp_login.php");
						</script>
						<?php
					}
					else
					{
						?>
						<script>
							alert("Do not Registered");
						</script>
						<?php
					}
				}
				else
				{
					?>
					<script>
						alert("You are not Eligible for Registered");
					</script>
					<?php
				}
			}
			else
			{
				?>
				<script>
					alert("Password are not Matching");
				</script>
				<?php
			}
	}
}
?>

<!DOCTYPE html>
<html>
<head>
	<?php
		include 'Style/css4.css';
		include 'Style/Links.php';
	?>
	<title>HR Management System - Employee Login</title>
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

</head>
<body>
	<h1 class="glow">HR Management System</h1>
	<div style="max-width:600px;margin:auto" class="container">
		<h1 align="center" class="w3-text-blue"><i class="fa fa-user fa-fw"></i>Register Employee</h1>
				
		 <form action="<?php echo htmlentities($_SERVER['PHP_SELF']); ?>" method="POST">
				<h3>&#10070; Personal Information :</h3>
				
				
				<div class="input-container">
					<i class="fa fa-user icon xxlarge"></i>
					<input class="input-field" type="text" name="name" placeholder="Enter your Name.." pattern="[A-Za-z, ]{4,}" title="Name must contain minimum four letters " autofocus required>
				</div>

				<div class="input-container">
					<i class="fa fa-user icon"></i>
					<input class="input-field" type="text" name="fathersname" placeholder="Father's name.." pattern="[A-Za-z, ]{4,}" title="Name must contain minimum four letters " required>
				</div>

				<div class="input-container">
					<i class="fa fa-phone icon"></i>
					<input class="input-field" type="text" name="mobile" placeholder="Mobile number" pattern="[0-9]{10}" title="Please enter valid mobile number." required>
				</div>

				<div class="input-container">
					<i class="fa fa-calendar icon"></i>
					<input class="input-field" type="date" name="dob" title="Select Employee date of birth" required>
				</div>

				<div class="input-container">
					<i class="fa fa-mars icon"></i>
					<select class="input-field" name="gender" required>
						<option>Select Gender...</option>
						<option value="Male">Male</option>
						<option value="Female">Female</option>
					</select>
				</div>
				<hr class="new"><h3>&#10070; Address :</h3>
				<div class="input-container">
					<i class="fa fa-map-marker icon"></i>
					<input class="input-field" type="text" name="address" placeholder="House No./Bldg./Apt./Street :" title="Only letters and white space allowed" required>
				</div>

				<div class="input-container">
					<i class="fa fa-map icon"></i>
					<select class="input-field" name="city" required>
						<option value="">Select City -</option>
						<option value="Amravati">Amravati</option>
						<option value="Amritsar">Amritsar</option>
						<option value="Bangalore">Bangalore</option>
						<option value="Bhopal">Bhopal</option>
						<option value="Chandigarh">Chandigarh</option>
						<option value="Chennai">Chennai</option>
						<option value="Gandhinagar">Gandhinagar</option>
						<option value="Gurgaon">Gurgaon</option>
						<option value="Hyderabad">Hyderabad</option>
						<option value="Indore">Indore</option>
						<option value="Jaipur">Jaipur</option>
						<option value="Jodhpur">Jodhpur</option>
						<option value="Kolkata">Kolkata</option>
						<option value="Lucknow">Lucknow</option>
						<option value="Ludhiana">Ludhiana</option>
						<option value="Mumbai">Mumbai</option>
						<option value="Mumbai suburban">Mumbai suburban</option>
						<option value="New Delhi">New Delhi</option>
						<option value="Patna">Patna</option>
						<option value="Pondicherry">Pondicherry</option>
						<option value="Raipur">Raipur</option>
						<option value="Ranchi">Ranchi</option>
						<option value="Srinagar">Srinagar</option>
						<option value="Visakhapatnam">Visakhapatnam</option>
					</select>
				</div>

				<div class="input-container">
					<i class="fa fa-flag icon"></i>
					<input type="text" class="input-field" name="country" value="India" readonly>
				</div>

				<div class="input-container">
					<i class="fa fa-map-pin icon"></i>
					<input class="input-field" type="text" name="zipcode" placeholder="Zip Code" pattern="[0-9]{6}" title="Zip Code must contains only six digit." required>
				</div>

				<hr class="new"><h3>&#10070; Qualifications :</h3>

				<div class="input-container">
					<i class="fa fa-bank icon"></i>
					<select class="input-field" name="qualification" required>
						<option>Select Qualification...</option>
						<option value="Higher Certificate">Higher Certificate</option>
						<option value="National Diploma">National Diploma</option>
						<option value="Bachelor's Degree">Bachelor's Degree</option>
						<option value="Honours Degree">Honours Degree</option>
						<option value="Master's Degree">Master's Degree</option>
						<option value="Doctoral Degree">Doctoral Degree</option>
					</select>
				</div>

				<hr class="new"><h3>&#10070; Authentication :</h3>

				<div class="input-container">
					<i class="fa fa-envelope icon"></i>
					<input class="input-field" type="text" name="email" placeholder="Email" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,}$" title="Invalid email format" required>
				</div>

				<div class="input-container">
					<i class="fa fa-lock icon"></i>
					<input class="input-field" type="password" name="password" placeholder="Create Password" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" title="Must contain at least one number and one uppercase and lowercase letter, and at least 8 or more characters" required>
				</div>

				<div class="input-container">
					<i class="fa fa-lock icon"></i>
					<input class="input-field" type="password" name="cpassword" placeholder="Confirm Password" required>
				</div>
								
				
				<button type="submit" class="btn" name="submit">Register</button>
				<p><br>Already have an account?&nbsp;&nbsp;<a href="emp_login.php">Login</a></p>
			</form>

	<br>

	</div>
</body>
</html>
