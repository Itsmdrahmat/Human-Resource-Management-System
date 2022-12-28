<?php
	$until = new DateTime();
	$interval = new DateInterval('P6M');//6 months
	$lastsix = $until->sub($interval);
	echo $lastsix->format('Y-m-d');
?>