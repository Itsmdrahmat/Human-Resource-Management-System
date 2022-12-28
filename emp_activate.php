<?php
	session_start();
	include 'dbcon.php';
	
	if(isset($_GET['token']))
	{
		$token = $_GET['token'];
		$updatequery = "update employee set status='active' where token='$token'";
		$query = mysqli_query($con, $updatequery);
		
		if($query)
		{
			if(isset($_SESSION['msg']))
			{
				$_SESSION['msg1'] = "Email verified successfully";
				header('location:emp_login.php');
			}else
			{
				$_SESSION['msg2'] = "";
				header('location:emp_login.php');
			}
		}
		else
		{
			$_SESSION['msg1'] = "Accout not updated.";
			header('location:emp_login.php');
		}
	}
?>