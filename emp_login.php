<?php
session_start();
ob_start();
?>

<?php
	include 'dbcon.php';
	if(isset($_POST['submit']))
	{
		$Email = $_POST['email'];
		$pwd = $_POST['password'];
		
		$emailquery = "select * from employee where email='$Email' and status='active' ";
		$query = mysqli_query($con,$emailquery);
		
		$emailcount = mysqli_num_rows($query);
		
		if($emailcount)
		{
			$emailpass = mysqli_fetch_array($query);
			$dbpass = $emailpass['password'];
			
			$_SESSION['fetchempid'] = $emailpass['emp_id'];	

			$passdecode = password_verify($pwd, $dbpass);
			
			if($passdecode)
			{
				?>
				<script>
					alert("Login Successful");
				</script>
				<?php
				?>
				<script>
					location.replace("Employee_view.php");
				</script>
				<?php
			}
			else
			{
				?>
				<script>
					alert("Incorrect Password?");
				</script>
				<?php
			}
		}
		else
		{
			?>
			<script>
				alert("Invalid email");
			</script>
			<?php
		}
	}
?>

<!DOCTYPE html>
<html>
<head>
	<?php
		include 'Style/css1.css';
	?>
	<title>HR Management System - Employee Login</title>
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

</head>
<body>
	<h1 class="glow">HR Management System</h1>
	<form action="<?php echo htmlentities($_SERVER['PHP_SELF']); ?>" Method="POST" style="max-width:400px;margin:auto" class="container">
		<h1 align="center">Employee Login</h1>
		
		
		<div class="input-container">
			<i class="fa fa-envelope icon"></i>
			<input class="input-field" type="text" name="email" placeholder="Email" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,}$" title="Invalid email format" required>
		</div>
		
		
		<div class="input-container">
			<i class="fa fa-lock icon"></i>
			<input class="input-field" type="password" placeholder="Enter Password" name="password" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" title="Must contain at least one number and one uppercase and lowercase letter, and at least 8 or more characters" required>
		</div>
		<p align="right"><a href="emp_forgot.php">Forgot Password?</a></p>

		<button type="submit" class="btn" name="submit">Login</button>
		<p>Don't have an account?&nbsp;&nbsp;<a href="Employee_Register.php">Register</a></p>
		<p>HR Login?&nbsp;&nbsp;<a href="Index.php">Log in.</a></p>
		<p>If any queries?&nbsp;&nbsp;<a href="help.php">Help</a></p>
	</form>
	<br>
	</div>
</body>
</html>


