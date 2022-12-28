<?php
session_start();
ob_start();
?>

<?php

include 'dbcon.php';
if(isset($_POST['submit']))
{
	if(isset($_GET['token']))
	{
		$token = $_GET['token'];
	
		$NPassword = mysqli_real_escape_string($con, $_POST['password']);
		$CPassword = mysqli_real_escape_string($con, $_POST['cpassword']);
	
		$npwd = password_hash($NPassword, PASSWORD_BCRYPT);
		$cpwd = password_hash($CPassword, PASSWORD_BCRYPT);
	
		if($NPassword == $CPassword)
		{
			$updatequery = "update employee set password='$npwd' where token='$token'";
				
			$iquery = mysqli_query($con, $updatequery);
			if($iquery)
			{
				
				?>
				<script>
					alert("Your Password has been Updated");
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
					alert("Your Password is not Updated");
				</script>
				<?php

				?>
				<script>
					location.replace("emp_forgot.php");
				</script>
				<?php


			}
		}
		else
		{
			?>
			<script>
					alert("Your Password is not Matching");
			</script>
			<?php

			?>
			<script>
				location.replace("emp_changepwd.php");
			</script>
			<?php
			
		}
	}else
	{
		?>
		<script>
			alert("User Not Found");
		</script>
		<?php
	}
	
	
}
?>



<!DOCTYPE html>
<html>
<head>
	<title>HR Management System : Create New Password</title>
	<?php
		include 'Style/css1.css';
	?>
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

</head>
<body>

	<div class="bg">
		<br>
		<h1 class="glow">HR Management System</h1>
		<br>
	<form action="" Method="POST" style="max-width:400px;margin:auto" class="container">

		<h1 align="center">Create New Password</h1>
		
  
		<div class="input-container">
			<i class="fa fa-lock icon"></i>
			<input class="input-field" type="password" id="pwd" placeholder="Create New Password" name="password" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" title="Must contain at least one number and one uppercase and lowercase letter, and at least 8 or more characters" autofocus required>
			<input type="checkbox" onclick="Showpwd()">
		</div>
  
		<div class="input-container">
			<i class="fa fa-lock icon"></i>
			<input class="input-field" type="password" id="cpwd" placeholder="Confirm Password" name="cpassword" required>
			<input type="checkbox" onclick="Showpwd1()">
		</div>

		<button type="submit" class="btn" name="submit">Update Password</button>
		<p>Already have an account?&nbsp;&nbsp;<a href="Index.php">Login</a></p>
	</form>
	<br><br><br><br><br><br><br><br><br>
	</div>
</body>
	<!--   Show password function---------------- -->
	
	<script>
	function Showpwd() 
		{
			var x = document.getElementById("pwd");
			if (x.type === "password") 
			{
				x.type = "text";
			} 
			else 
			{
				x.type = "password";
			}
		}
	</script>
	
	<script>
	function Showpwd1() 
		{
			var x = document.getElementById("cpwd");
			if (x.type === "password") 
			{
				x.type = "text";
			} 
			else 
			{
				x.type = "password";
			}
		}
	</script>
</html>
