<?php 
/*
 ====================================
 Jonathan Wagner
 xanthakita@gmail.com
 Wild Bunch Productions
 ====================================
 FILE NAME:          addClient.php
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
		include('user.class.php');
		$artist = new User($username);
		$artistsList=$artist->Get_Artists();
		echo "<pre>";var_dump($artistsList);echo "</pre>";
		die;
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
						<h1>Add Visit</h1>
					</header>
<div class="col-sm-12 col-lg-offset-3">
 <form class="col-sm-6" action="clientcontroller.php" method="post" accept-charset="utf-8" enctype="multipart/form-data">
 		<input type="hidden" name="act" value="addvisit">
 		<h3> Fill out the following fields </h3>
 		<label for="VisitType">Type of Appointment:</label>
		<select name="VisitType">
			<option value="Classic">Classic</option>
			<option value="Volume">Volume</option>
			<option value="Lash Lift">Lash Lift</option>
			<option value="Bottom">Bottom</option>
		</select><br>
 		<label for="lashType">Lashes:</label>
		<select name="lashType">
			<option value="Mink">Mink</option>
			<option value="Ellipse">Ellipse</option>
			<option value="Synthetic Mink">Synthetic Mink</option>
			<option value="Colored">Colored</option>
		</select><br>
 		<label for="curlType">Curl:</label>
		<select name="curlType">
			<option value="J">J</option>
			<option value="B">B</option>
			<option value="C">C</option>
			<option value="D">D</option>
			<option value="L">L</option> 
		</select><br>
 		<label for="Length">Length:</label>
		<select name="Length">
			<option value="07">07</option>
			<option value="08">08</option>
			<option value="09">09</option>
			<option value="10">10</option>
			<option value="11">11</option>
			<option value="12">12</option>
			<option value="13">13</option>
			<option value="14">14</option>
			<option value="15">15</option>
			<option value="16">16</option>
		</select><br>
 		<label for="Size">Size:</label>
		<select name="Size">
			<option value=".07">.07</option>
			<option value=".10">.10</option>
			<option value=".15">.15</option>
			<option value=".18">.18</option>
			<option value=".20">.20</option>
			<option value=".25">.25</option>
		</select><br>
 		<label for="eyePadType">Eye Pads:</label>
		<select name="eyePadType">
			<option value="Type B">TypeB</option>
			<option value="Lint Free - White">Lint Free - White</option>
			<option value="Lint Free - Pink">Lint Free - Pink</option>
			<option value="Mini Pads">Mini Pads</option>
			<option value="Tape">Tape</option>
		</select><br>
 		<label for="glueType">Glue:</label>
		<select name="glueType">
			<option value="Signature">Signature</option>
			<option value="Signature Lite">Signature Lite</option>
			<option value="Amplify">Amplify</option>
			<option value="Marvel">Marvel</option>
			<option value="Maximum Sensitive">Maximum Sensitive</option>
		</select><br>
 		<label for="classicStyle">Classic Style:</label>
		<select name="classicStyle">
			<option value="Cat Eye">Cat Eye</option>
			<option value="Kitten Eye">Kitten Eye</option>
			<option value="Open Eye">Open Eye</option>
			<option value="Wispy">Wispy</option>
		</select><br>		
 		<label for="VolumeType">Volume:</label>
		<select name="VolumeType">
			<option value="Built">Built</option>
			<option value="Purchased">Purchased</option>
		</select><br>			
 		<label for="BottomType">Bottom:</label>
		<select name="BottomType">
			<option value=".15 B 07">.15 B 07</option>
			<option value=".15 B 08">.15 B 08</option>
		</select><br>		
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