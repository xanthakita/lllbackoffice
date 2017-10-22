<?php 
/*
 ====================================
 Jonathan Wagner
 xanthakita@gmail.com
 Wild Bunch Productions
 ====================================
 FILE NAME:          display_client.php
  TAB SIZE:          4
 SOFT TABS:          NO
 ====================================
 Copywrite @2017
 */

	error_reporting(E_ALL);
	if (!isset($_COOKIE["userid"])) {
		header('location: login.php');
	} else {
		$username=$_COOKIE["userid"];
		$clientInfo=json_decode($_GET['clientInfo'],1);
		$clientVisit=json_decode($_GET['clientVisit'],1);
		// echo "<pre>";
		// var_dump($clientInfo);
		// var_dump($clientVisit);
		// echo "</pre>";
		// die;
	}
	?>

<!DOCTYPE HTML>

<html>
	<head>
		<title>Lori's Lovely Lashes Backoffice</title>
		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1" />

		<!--[if lte IE 8]><script src="assets/js/ie/html5shiv.js"></script><![endif]-->
		<link rel="stylesheet" href="assets/css/main.css" />
		<!--[if lte IE 9]><link rel="stylesheet" href="assets/css/ie9.css" /><![endif]-->
		<!--[if lte IE 8]><link rel="stylesheet" href="assets/css/ie8.css" /><![endif]-->
		
<?php include('Classes/include.php'); ?> 
	</head>
	<body>
    <div class="container text-center">

	<!-- Header -->
					<header id="header" class="alt">
						<span class="logo"><img src="images/lll-small-logo.png" alt="" /></span>
						<h1>Display Client / Visit</h1>
					</header>
<div>
	<table class="table">
		<trhead>
			<tr>
				<th>Client</th>
				<th>Phone</th>
				<th>Picture</th>
			</tr>
		</trhead>
		<tbody>
			<?php

					$first_name = $clientInfo[0]['first_name'];
					$last_name = $clientInfo[0]['last_name'];
					$phone = $clientInfo[0]['phone'];
					$picture= $clientInfo[0]['picture'];
					echo "<tr><td>$first_name $last_name</td><td>$phone</td><td>
					<img src='images/clients/$picture' width='75'></td></tr>";
			?>
		</tbody>
	</table>
	<?php if ( sizeof($clientVisit[0]) > 0 ) { ?>
	<h3>Last Visit</h3>
 	<table class="table">
		<trhead>
			<tr>
				<th>Last Appointment Date</th>
				<th>Time</th>
				<th>Appt For</th>
				<th>Lash Type</th>
				<th>Curl Type(s)</th>
				<th>Lash Length(s)</th>
				<th>Size(s)</th>
				<th>EyePad Type</th>
				<th>Glue Type</th>
				<th>Style</th>
				<th>Volume Type</th>
				<th>Bottom Size(s)</th>
				<th>Artist</th>
			</tr>
		</trhead>
		<tbody>
			<?php
				echo "<br><tr>";
				foreach($clientVisit[0] as $x){
					echo "<td>".$x."</td>";
				}
				echo "</tr>";
/*					$lastDate = $clientVisit[0]['AppointmentDate'];
					$lastTime = $clientVisit[0]['AppointmentTime'];
					$phone = $clientVisit[0]['phone'];
					$picture= $clientVisit[0]['picture'];
					echo "<tr><td>$first_name $last_name</td><td>$phone</td><td>
					<img src='images/clients/$picture' width='75'></td></tr>";
*/
			?>
		</tbody>
	</table>
	<?php }  else echo "<h3> No Previous Visit on File. </h3>"; ?>
 </div>
 <div class="text-center">
	<a class="btn btn-success" href="addVisit.php?client=">Add Visit</a>
 </div>


</div><!-- /.container -->
   <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="https://code.jquery.com/jquery-3.1.1.slim.min.js" integrity="sha384-A7FZj7v+d/sdmMqp/nOQwliLvUsJfDHW+k9Omg/a/EheAdgtzNs3hpfag6Ed950n" crossorigin="anonymous"></script>
    <script>window.jQuery || document.write('<script src="../../assets/js/vendor/jquery.min.js"><\/script>')</script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/tether/1.4.0/js/tether.min.js" integrity="sha384-DztdAPBWPRXSA/3eYEEUWrWCy7G5KFbe8fFjk5JAIxUYHKkDx6Qin1DkWx51bBrb" crossorigin="anonymous"></script>
    <script src="../../dist/js/bootstrap.min.js"></script>
    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
    <script src="../../assets/js/ie10-viewport-bug-workaround.js"></script>
		<!-- Scripts -->
			<script src="assets/js/jquery.min.js"></script>
			<script src="assets/js/jquery.scrollex.min.js"></script>
			<script src="assets/js/jquery.scrolly.min.js"></script>
			<script src="assets/js/skel.min.js"></script>
			<script src="assets/js/util.js"></script>
			<!--[if lte IE 8]><script src="assets/js/ie/respond.min.js"></script><![endif]-->
			<script src="assets/js/main.js"></script>

	<script>
			function printValue(input, output){

				str invalue= $.getElementById(input).innerHTML;
				$.getElementById(output).innerhtml=invalue;
			}

	</script>


	</body>
</html>

<?php 
//end
 ?>