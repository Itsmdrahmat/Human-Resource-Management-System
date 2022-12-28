<?php
	include 'dbcon.php';
	
	$nid = $_GET['id'];
	
	$deletequery = "delete from report where report_id = '$nid'";
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
			location.replace("Manage_Report.php");
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
			location.replace("Manage_Report.php");
		</script>
		<?php
	}
	
?>