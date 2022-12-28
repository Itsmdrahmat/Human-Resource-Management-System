<?php
session_start();
?>
<?php
	include 'dbcon.php';
	
	$ids = $_SESSION['fetchempid'];
	
	$checkquery = "select * from employee where emp_id = '$ids'";
	$showdata = mysqli_query($con,$checkquery);
	$arrdata = mysqli_fetch_array($showdata);
	$emailid = $arrdata['email'];

	$nid = $_GET['id'];
	$status = 'Approved';
	$updatequery = "update leaves set status = '$status' where leave_id = '$nid'";
	$query = mysqli_query($con,$updatequery);



	if($query)
	{
		$subject = "Leave Approved";
		$body = "Dear Emplyee, I am very excited to be accepting your Leave, I've received another job offer with a higher base Leave.";
					
		$Sender = "From: infoswaxmr@gmail.com";

		if (mail($emailid, $subject, $body, $Sender)) 
		{
			?>
			<script>
				echo "Leave Approved Successfully";
				
			</script>
			<?php
			header('location:Manage_Leave.php');

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
	else
	{
		?>
		<script>
			alert("Do not Approved");
		</script>
		<?php
		
		?>
		<script>
			location.replace("Manage_Leave.php");
		</script>
		<?php
	}
	
?>