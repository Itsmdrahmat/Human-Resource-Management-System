<?php
session_start();
?>
<?php
	include 'dbcon.php';
	
	$training_id = $_GET['id'];
	$today = date('Y-m-d');
	$status = 'Running';

	$selectquery = "SELECT * from training where training_id = '$training_id'";
	$query = mysqli_query($con,$selectquery);
	$arrdata = mysqli_fetch_array($query);
	$training_date = $arrdata['from_date'];

	if($training_date == $today)
	{
		$updatequery = "update training set status = '$status' where training_id = '$training_id'";
		$query1 = mysqli_query($con,$updatequery);

		if($query1)
		{
			?>
			<script>
				alert ("Training Started Successfully");
			</script>
			<?php

			?>
			<script>
				location.replace("Manage_Training.php");
			</script>
			<?php
		}
			

	}
	else
	{
		?>
		<script>
			alert ("Outoff Date");
		</script>
		<?php
		?>
		<script>
			location.replace("Manage_Training.php");
		</script>
		<?php
	}
?>