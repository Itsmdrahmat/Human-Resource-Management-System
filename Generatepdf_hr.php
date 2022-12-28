<?php
session_start();
?>

<?php
	include 'dbcon.php';
	require('vendor/autoload.php');
	 

	if(isset($_POST['submit']))
	{
		$auto_q = ("SELECT id FROM report");
		$res = mysqli_query($con,$auto_q);
		$last_id = 0;
		while($row = mysqli_fetch_array($res))
		{
			$last_id = $row['id'];
		}
		$next_id = ($last_id+1);
		$prefix = "R";
		
		$report_id = $prefix."-".sprintf('%05d',$next_id);
		
		$creating_date = date('Y-m-d');
		
		$whichreport = mysqli_real_escape_string($con, $_POST['whichreport']);
		$fromdate = mysqli_real_escape_string($con, $_POST['fromdate']);
		$todate = mysqli_real_escape_string($con, $_POST['todate']);
		$report_desc = mysqli_real_escape_string($con, $_POST['report_desc']);

		if(($fromdate <= $creating_date) && ($todate <= $creating_date))
		{

			$insertquery = "insert into report(report_id,whichreport,from_date,to_date,report_desc,creating_date) values('$report_id','$whichreport','$fromdate','$todate','$report_desc','$creating_date')";
									
			$iquery = mysqli_query($con, $insertquery);

			if($whichreport == 'Training')
			{	
				$selectquery1 = "SELECT * FROM training WHERE creating_date BETWEEN '$fromdate' AND '$todate'";
				$query1 = mysqli_query($con,$selectquery1);
				
				$show.='<h3 align="left">'.'<u><i>HR Management System</i></u>'.'</h3>';
				$show.='<p align="right">'.$creating_date.'</p>';
				$show.='<h1 align="center">'.'Training Report'.'</h1><br><br>';

				$show.='<table style="width:100%" border="1" cellspacing="0" cellpadding="6"><tr>'.'<th>ID</th>'.'<th>Name</th>'.'<th>Type</th>'.'<th>Date</th>'.'<th>Time</th>'.'<th>Descriptions</th>'.'<tr>';
				while($trainingreport = mysqli_fetch_array($query1))
				{
					$show.='<tr><td>'.$trainingreport['training_id'].'</td>';
					$show.='<td>'.$trainingreport['training_name'].'</td>';
					$show.='<td>'.$trainingreport['training_type'].'</td>';
					$show.='<td>'.$trainingreport['from_date'].'<b> To </b>'.$trainingreport['to_date'].'</td>';
					$show.='<td>'.$trainingreport['from_time'].'<b> To </b>'.$trainingreport['to_time'].'</td>';
					$show.='<td>'.$trainingreport['training_desc'].'</td>';
				}
				$show.='</table>';

				$mpdf=new \Mpdf\Mpdf();
				$mpdf->WriteHTML($show);
				$file='report/'.Date('Y-m-d').'.pdf';
				$mpdf->output($file,'I');

			}
			else if($whichreport == 'Payroll')
			{
				$selectquery2 = "SELECT * FROM payroll WHERE salary_date BETWEEN '$fromdate' AND '$todate'";
				$query2 = mysqli_query($con,$selectquery2);
				
				$show.='<h3 align="left">'.'<u><i>HR Management System</i></u>'.'</h3>';
				$show.='<p align="right">'.$creating_date.'</p>';
				$show.='<h1 align="center">'.'Payroll Report'.'</h1><br><br>';

				$show.='<table style="width:100%" border="1" cellspacing="0" cellpadding="6"><tr>'.'<th>ID</th>'.'<th>Employee Name</th>'.'<th>Type</th>'.'<th>Date</th>'.'<th>Amount</th>'.'<th>Descriptions</th>'.'<tr>';
				while($payrollreport = mysqli_fetch_array($query2))

				{	
					$show.='<tr><td>'.$payrollreport['salary_id'].'</td>';
					$show.='<td>'.$payrollreport['emp_name'].'</td>';
					$show.='<td>'.$payrollreport['salary_type'].'</td>';
					$show.='<td>'.$payrollreport['salary_date'].'</td>';
					$show.='<td>'.$payrollreport['salary_amount'].'</td>';
					$show.='<td>'.$payrollreport['salary_desc'].'</td>';
				}
				$show.='</table>';

				$mpdf=new \Mpdf\Mpdf();
				$mpdf->WriteHTML($show);
				$file='report/'.Date('Y-m-d').'.pdf';
				$mpdf->output($file,'I');

			}
			else
			{
				$selectquery3 = "SELECT * FROM leaves WHERE apply_date BETWEEN '$fromdate' AND '$todate'";
				$query3 = mysqli_query($con,$selectquery3);

				$show.='<h3 align="left">'.'<u><i>HR Management System</i></u>'.'</h3>';
				$show.='<p align="right">'.$creating_date.'</p>';
				$show.='<h1 align="center">'.'Leave Report'.'</h1><br><br>';

				$show.='<table style="width:100%" border="1" cellspacing="0" cellpadding="6"><tr>'.'<th>ID</th>'.'<th>Employee Name</th>'.'<th>Date</th>'.'<th>Type</th>'.'<th>Descriptions</th>'.'<tr>';
				while($leavesreport = mysqli_fetch_array($query3))
				{
					$show.='<tr><td>'.$leavesreport['leave_id'].'</td>';
					$show.='<td>'.$leavesreport['emp_name'].'</td>';
					$show.='<td>'.$leavesreport['from_date'].'<b> To </b>'.$leavesreport['to_date'].'</td>';
					$show.='<td>'.$leavesreport['leave_type'].'</td>';
					$show.='<td>'.$leavesreport['about_leave'].'</td>';

				}
				$show.='</table>';

				$mpdf=new \Mpdf\Mpdf();
				$mpdf->WriteHTML($show);
				$file='report/'.Date('Y-m-d').'.pdf';
				$mpdf->output($file,'I');

			}
		}
		else
		{
			?>
			<script>
				alert ("Please Enter valid Date.");
			</script>
			<?php
			?>
			<script>
				location.replace("Manage_Report.php");
			</script>
			<?php
		}
	}

?>
