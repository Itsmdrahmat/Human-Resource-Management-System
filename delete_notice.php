<?php
	include 'dbcon.php';
	
	$nid = $_GET['id'];
	
	$deletequery = "delete from notice where notice_id = '$nid'";
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
			location.replace("Manage_Notice.php");
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
			location.replace("Manage_Notice.php");
		</script>
		<?php
	}
	
?>