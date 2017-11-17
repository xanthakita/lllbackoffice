<?php 
/*
 ====================================
 Jonathan Wagner
 xanthakita@gmail.com
 Wild Bunch Productions
 ====================================
 FILE NAME:          editClient.php
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
		$clientID=$_GET['client'];
		 echo "<pre>";
		 var_dump($clientInfo);
		 //var_dump($clientVisit);
		 echo "</pre>";
		// die;
	}


	include("client.class.php");
	$thisClient = new Client($clientInfo['clientID']);
	//$clientInfo = $thisClient->getClientInfo($clientID);
	var_dump($clientInfo['clientID']);
	echo "<br>";
	var_dump($thisClient->getClientInfo($clinetInfo[$clientID]));
	//die;

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
	<?php var_dump($clientInfo[0]); ?>
</div>
<form action="/updateClient.php" method="put">
  First name: <input type="text" name="fname" value="<?php echo $clientInfo['first_name']; ?>"><br>
  Last name: <input type="text" name="lname" value="<?php echo $clientInfo['last_name']; ?>"><br>
  Phone: <input type="text" name="phone" value="<?php echo $clientInfo['phone']; ?>"><br>
  Email: <input type="text" name="email" value="<?php echo $clientInfo['email']; ?>"><br>
  City: <input type="text" name="city" value="<?php echo $clientInfo['city']; ?>"><br>
  State: <input type="text" name="state" value="<?php echo $clientInfo['state']; ?>"><br>
  Birth Month: <input type="text" name="birth_month" value="<?php echo $clientInfo['birth_month']; ?>"><br>
  Birth Day: <input type="text" name="birth_day" value="<?php echo $clientInfo['birth_day']; ?>"><br>
  Birth Year: <input type="text" name="birth_year" value="<?php echo $clientInfo['birth_year']; ?>"><br>
  Last name: <input type="text" name="lname" value="<?php echo $clientInfo['notes']; ?>"><br>

echo "<tr><td class='align-left'><strong>Last Appointment Date:</strong></td>
	<td class='align-right'>".$clientVisit[0]['AppointmentDate']."</td></tr>";
echo "<tr><td class='align-left'><strong>Time:</strong></td>
	<td class='align-right'>".$clientVisit[0]['AppointmentTime']."</td></tr>";
echo "<tr><td class='align-left'><strong>Appt For:</strong></td>
	<td class='align-right'>".$clientVisit[0]['VisitType']."</td></tr>";
echo "<tr><td class='align-left'><strong>Lash Type:</strong></td>
	<td class='align-right'>".$clientVisit[0]['lashType']."</td></tr>";
echo "<tr><td class='align-left'><strong>Curl Type(s):</strong></td>
	<td class='align-right'>".$clientVisit[0]['curlType']."</td></tr>";
echo "<tr><td class='align-left'><strong>Lash Length(s):</strong></td>
	<td class='align-right'>".$clientVisit[0]['Length']."</td></tr>";
echo "<tr><td class='align-left'><strong>Size(s):</strong></td>
	<td class='align-right'>".$clientVisit[0]['Size']."</td></tr>";
echo "<tr><td class='align-left'><strong>EyePad Type:</strong></td>
	<td class='align-right'>".$clientVisit[0]['eyePadType']."</td></tr>";
echo "<tr><td class='align-left'><strong>Glue Type:</strong></td>
	<td class='align-right'>".$clientVisit[0]['glueType']."</td></tr>";
echo "<tr><td class='align-left'><strong>Style:</strong></td>
	<td class='align-right'>".$clientVisit[0]['classicStyle']."</td></tr>";
echo "<tr><td class='align-left'><strong>Volume Type:</strong></td>
	<td class='align-right'>".$clientVisit[0]['VolumeType']."</td></tr>";
echo "<tr><td class='align-left'><strong>Bottom Size(s):</strong></td>
	<td class='align-right'>".$clientVisit[0]['BottomType']."</td></tr>";
echo "<tr><td class='align-left'><strong>Artist:</strong></td>
	<td class='align-right'>".$clientVisit[0]['Artist']."</td></tr>";

  <input type="submit" value="Submit">


</form>

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