<?php
	include 'dbcon.php';
	
	$nid = $_GET['id'];
	
	$deletequery = "delete from leaves where leave_id = '$nid'";
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
			location.replace("Manage_Leave.php");
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
			location.replace("Manage_Leave.php");
		</script>
		<?php
	}
	
?>