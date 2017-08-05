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
		$clientInfo=json_decode($_GET['clientInfo']);
		$clientVisit=json_decode($_GET['clientVisit']);
		// echo "<pre>";
		// var_dump($clientInfo);
		// var_dump($clientVisit);
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
			echo "<pre>"; 
			var_dump($clientInfo);
			echo "</pre>";
			die;
				foreach($clientInfo as $x){
					echo "<tr><td>".$x[0]['first_name']." ".$x[0]['last_name']."</td><td>".$x[0]['phone']."</td><td><img src='".$x[0]['picture']."' width='75'></td></tr>";
				}
			?>
		</tbody>
	</table>
 <form class="col-sm-6" action="clientcontroller.php" method="post" accept-charset="utf-8" enctype="multipart/form-data">
 		<input type="hidden" name="act" value="addclient">
 		<h3> Fill out the following fields </h3>
 		<label for="firstName">First Name:</label>
 		<input type="text" name="firstName" id="firstName"/><br>
 		<label for="lastName">Last Name:</label>
 		<input type="text" name="lastName" id="lastName"/><br>
 		<label for="firstVisit">First Visit:&nbsp;</label><input type="date" name="firstVisit" id="firstVisit"><br>
 		<label for="phone">Phone Number:&nbsp;</label><input type='tel'  name='phone' title='Phone Number'> <br>
 		<label for="email">Email:&nbsp;</label><input type="email" name="email" autocomplete="off"><br>
 		<div class="text-center">
		 		<label for="city">City:&nbsp;</label>
		 		<input type="text" name="city"><br>
		 		<label for="state">State (IN):&nbsp;</label>
		 		<input type="text" name="state" value="IN">
	 		<br>
	 		<label for="birthmonth">Birthday Month:&nbsp;</label>
	 		<input id='birthmonth' name="birthmonth" type='month'/><br>
	 		<label for="birthday">Birthday Day:&nbsp;</label><input type="number" name="birthday" min="1" max="31"><br>
 		</div>
		<br>
		<label for"heardAbout">How did they hear about us:</label>
		<select name="heardAbout">
			<option value="Friend">Friend</option>
			<option value="Facebook">Facebook</option>
			<option value="Google">Google</option>
			<option value="Other">Other</option>
		</select>
		<label for="referal">(if Friend's name or Other)</label>
		<input type="text" name="referal"><br>
 		<label for="clientimage">Client Image:</label>
 		<input type="file" name="clientimage" id="clientimage" /><br>
 		<div class="text-center"><input type="submit" name="submit" value="Submit"></div>
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