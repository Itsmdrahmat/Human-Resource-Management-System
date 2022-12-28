<?php
session_start();
?>

<?php

include 'dbcon.php';
if(isset($_POST['submit']))
{
	$email = mysqli_real_escape_string($con, $_POST['email']);
	$msg = mysqli_real_escape_string($con, $_POST['msg']);
	
	
	$insertquery = "insert into help(email,msg) values('$email','$msg')";
				
	$iquery1 = mysqli_query($con, $insertquery);
	if($iquery1)
	{
		?>
		<script>
			alert("Message Recived Successfully, We wil contact you Shortly.");
		</script>
		<?php
		?>
		<script>
			location.replace("");
		</script>
		<?php
	}
			
	else
	{
		?>
		<script>
			alert("Do not send");
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
	<title>HR Management System : Register</title>
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

</head>
<body>
		<h1 class="glow">HR Management System</h1>

	<form action="<?php echo htmlentities($_SERVER['PHP_SELF']); ?>" Method="POST" style="max-width:400px;margin:auto" class="container">

		<h1 align="center">Help</h1>
		<div class="input-container">
			<i class="fa fa-envelope icon"></i>
			<input class="input-field" type="text" placeholder="Enter Email..." name="email" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,}$" title="Invalid email format" autofocus required>
		</div>
		
		<div class="input-container">
			<i class="fa fa-comment icon"></i>
			<input class="input-field" type="text" placeholder="Enter Message..." name="msg"  required>
		</div>

		<button type="submit" class="btn" name="submit">Send Message</button>
		<p>Back to Login?&nbsp;&nbsp;<a href="Index.php">Log in.</a></p>
	</form>
	<br><br><br>
	</div>
</body>
</html>
