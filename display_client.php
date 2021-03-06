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
	<table class="table table-responsive">
		<trhead>
			<tr>
				<th class='align-left'>Client</th>
				<th class='align-left'>Phone</th>
				<th class='align-left'>Picture</th>
				<th class='align-right'></th>
			</tr>
		</trhead>
		<tbody>
			<?php

					$first_name = $clientInfo[0]['first_name'];
					$last_name = $clientInfo[0]['last_name'];
					$phone = $clientInfo[0]['phone'];
					$picture= $clientInfo[0]['picture'];
					echo "<tr><td class='align-left'><strong>$first_name $last_name</strong></td><td class='align-left'><strong>$phone</strong></td><td class='align-left'>
					<img src='images/clients/$picture' width='75'></td>";
					echo "<td class='align-right'><a class='btn btn-success' href='editClient.php?clientInfo=".json_encode($clientInfo[0],-1)."'>Edit</a></td></tr>";
			?>
		</tbody>
	</table>
	<?php if ( sizeof($clientVisit[0]) > 0 ) { ?>
	<h3>Info on Last Visit</h3>
 	<table class="table table-responsive">
<?php //		<trhead>
//			<tr>
//
//			</tr>
//		</trhead>  ?>
		<tbody>
			<?php
					echo "<tr><td class='align-left'><strong>Last Appointment Date:</strong></td><td class='align-right'>".$clientVisit[0]['AppointmentDate']."</td></tr>";
					echo "<tr><td class='align-left'><strong>Time:</strong></td><td class='align-right'>".$clientVisit[0]['AppointmentTime']."</td></tr>";
					echo "<tr><td class='align-left'><strong>Appt For:</strong></td><td class='align-right'>".$clientVisit[0]['VisitType']."</td></tr>";
					echo "<tr><td class='align-left'><strong>Lash Type:</strong></td><td class='align-right'>".$clientVisit[0]['lashType']."</td></tr>";
					echo "<tr><td class='align-left'><strong>Curl Type(s):</strong></td><td class='align-right'>".$clientVisit[0]['curlType']."</td></tr>";
					echo "<tr><td class='align-left'><strong>Lash Length(s):</strong></td><td class='align-right'>".$clientVisit[0]['Length']."</td></tr>";
					echo "<tr><td class='align-left'><strong>Size(s):</strong></td><td class='align-right'>".$clientVisit[0]['Size']."</td></tr>";
					echo "<tr><td class='align-left'><strong>EyePad Type:</strong></td><td class='align-right'>".$clientVisit[0]['eyePadType']."</td></tr>";
					echo "<tr><td class='align-left'><strong>Glue Type:</strong></td><td class='align-right'>".$clientVisit[0]['glueType']."</td></tr>";
					echo "<tr><td class='align-left'><strong>Style:</strong></td><td class='align-right'>".$clientVisit[0]['classicStyle']."</td></tr>";
					echo "<tr><td class='align-left'><strong>Volume Type:</strong></td><td class='align-right'>".$clientVisit[0]['VolumeType']."</td></tr>";
					echo "<tr><td class='align-left'><strong>Bottom Size(s):</strong></td><td class='align-right'>".$clientVisit[0]['BottomType']."</td></tr>";
					echo "<tr><td class='align-left'><strong>Artist:</strong></td><td class='align-right'>".$clientVisit[0]['Artist']."</td></tr>";
				//echo "<br><tr>";
				//foreach($clientVisit[0] as $x){
				//	echo "<td>".$x."</td>";
				//}
				//echo "</tr>";
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
	<a class="btn btn-success" href="addVisit.php?client=<?php echo $_GET['client']; ?>">Add New Visit</a><br>
	<a class="btn btn-default" href="findClient.php">Find a Different Client</a><br>
	<a class="btn btn-default" href="addClient.php">Add a New Client</a>
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