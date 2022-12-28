 <?php
	include 'dbcon.php';
	
	$tid = $_GET['id'];
	
	$deletequery = "delete from training where training_id = '$tid'";
	$query = mysqli_query($con,$deletequery);
	if($query)
	{
		?>
		<script>
			alert("Deleted Successfully");
		</script>
		<?php
		
		?>
		<script>
			location.replace("Manage_Training.php");
		</script>
		<?php
	}
	else
	{
		?>
		<script>
			alert("Do not Deleted");
		</script>
		<?php
		
		?>
		<script>
			location.replace("Manage_Training.php");
		</script>
		<?php
	}
	
?>