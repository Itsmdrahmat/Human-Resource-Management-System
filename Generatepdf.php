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
		
		$empid = mysqli_real_escape_string($con, $_POST['empid']);
		$empname = mysqli_real_escape_string($con, $_POST['empname']);
		$fromdate = mysqli_real_escape_string($con, $_POST['fromdate']);
		$todate = mysqli_real_escape_string($con, $_POST['todate']);
		$report_desc = mysqli_real_escape_string($con, $_POST['report_desc']);
		$whichreport = 'Employee';

		if(($fromdate <= $creating_date) && ($todate <= $creating_date))
		{


			$insertquery = "insert into report(report_id,emp_id,emp_name,whichreport,from_date,to_date,report_desc,creating_date) values('$report_id','$empid','$empname','$whichreport','$fromdate','$todate','$report_desc','$creating_date')";
									
			$iquery = mysqli_query($con, $insertquery);

			if($iquery)
			{	
				 $today = date('Y-m-d');
				$selectquery = "select * from employee where emp_id = '$empid'";
				$query = mysqli_query($con,$selectquery);
				$empdata = mysqli_fetch_array($query); 

				$selectquery1 = "SELECT * FROM payroll where emp_id = '$empid' intersect SELECT * FROM payroll where salary_date BETWEEN '$fromdate' AND '$todate'";
				$query1 = mysqli_query($con,$selectquery1);

				$selectquery2 = "SELECT * FROM leaves where emp_id = '$empid' intersect SELECT * FROM leaves where apply_date BETWEEN '$fromdate' AND '$todate'";
				$query2 = mysqli_query($con,$selectquery2);

				$status = 'Completed';
				$selectquery3 = "SELECT * from training where status = '$status' intersect SELECT * FROM training where from_date BETWEEN '$fromdate' AND '$todate'";
				$query3 = mysqli_query($con,$selectquery3);

				$show.='<h3 align="left">'.'<u><i>HR Management System</i></u>'.'</h3>';
				$show.='<p align="right">'.$today.'</p>';
				$show.='<h1 align="center">'.$empdata['name'].'</h1><hr>';
				$show.='<h3 align="left">'.'<i>Personal Information :</i>'.'</h3>';
				$show.='<label align="left">'.'&nbsp;&nbsp;&nbsp;&nbsp;Employee ID :- '.'<b>'.$empdata['emp_id'].'</b>'.'</label><br>';
				$show.='<label align="left">'.'&nbsp;&nbsp;&nbsp;&nbsp;Email :- '.'<b>'.$empdata['email'].'</b>'.'</label><br>';
				$show.='<label align="left">'.'&nbsp;&nbsp;&nbsp;&nbsp;Date of Joining :- '.'<b>'.$empdata['emp_doj'].'</b>'.'</label><br>';
				$show.='<label align="left">'.'&nbsp;&nbsp;&nbsp;&nbsp;Mobile :- '.'<b>'.$empdata['emp_mobile'].'</b>'.'</label><br>';
				$show.='<label align="left">'.'&nbsp;&nbsp;&nbsp;&nbsp;Date of Birth :- '.'<b>'.$empdata['emp_doj'].'</b>'.'</label><hr>';

				$show.='<h3 align="left">'.'<i>Training Information :</i>'.'</h3>';

				$show.='<table style="width:100%" border="1" cellspacing="0" cellpadding="6"><tr>'.'<th> Training Name</th>'.'<th>Type</th>'.'<th>Date</th>'.'<th>Time</th>'.'<th>Status</th>'.'<tr>';
				while($arrdata = mysqli_fetch_array($query3))
				{
					$storedata  = $arrdata['employee'];
					if (strpos($storedata, $empid) !== false)
					{
						$show.='<tr><td>'.$arrdata['training_name'].'</td>';
						$show.='<td>'.$arrdata['training_type'].'</td>';
						$show.='<td>'.$arrdata['from_date'].'<b> To </b>'.$arrdata['to_date'].'</td>';
						$show.='<td>'.$arrdata['from_time'].'<b> To </b>'.$arrdata['to_time'].'</td>';
						$show.='<td>'.$arrdata['status'].'</td></tr>';
					
					}
				}
				$show.='</table>';

				$show.='<hr>';
				$show.='<h3 align="left">'.'<i>Payment Information :</i>'.'</h3>';
				$show.='<table style="width:100%" border="1" cellspacing="0" cellpadding="6"><tr>'.'<th>Name</th>'.'<th>Type</th>'.'<th>Amount</th>'.'<th>Date</th>'.'<th>Descriptions</th>'.'<tr>';
				while($paymentinfo = mysqli_fetch_array($query1))
				{
					$show.='<tr><td>'.$paymentinfo['emp_name'].'</td>';
					$show.='<td>'.$paymentinfo['salary_type'].'</td>';
					$show.='<td>'.$paymentinfo['salary_amount'].'</td>';
					$show.='<td>'.$paymentinfo['salary_date'].'</td>';
					$show.='<td>'.$paymentinfo['salary_desc'].'</td></tr>';
				}
				$show.='</table>';

				$show.='<hr>';
				$show.='<h3 align="left">'.'<i>Leave Information :</i>'.'</h3>';
				$show.='<table style="width:100%" border="1" cellspacing="0" cellpadding="6"><tr>'.'<th>Name</th>'.'<th>Date</th>'.'<th>Type</th>'.'<th>Status</th>'.'<th>Descriptions</th>'.'<tr>';
				while ($leaveinfo = mysqli_fetch_array($query2)) 
				{
					$show.='<tr><td>'.$leaveinfo['emp_name'].'</td>';
					$show.='<td>'.$leaveinfo['leave_type'].'</td>';
					$show.='<td>'.$leaveinfo['from_date'].'<b> To </b>'.$leaveinfo['to_date'].'</td>';
					$show.='<td>'.$leaveinfo['status'].'</td>';
					$show.='<td>'.$leaveinfo['about_leave'].'</td></tr>';
				}
				$show.='</table>';

				$mpdf=new \Mpdf\Mpdf();
				$mpdf->WriteHTML($show);
				$file='report/'.Date('Y-m-d').'.pdf';
				$mpdf->output($file,'I');

			}
			else
			{
				?>
				<script>
					alert ("Do not generate report.");
				</script>
				<?php
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
				location.replace("Employee_Report.php");
			</script>
			<?php
		}
		
	}

?>
