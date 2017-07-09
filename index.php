<?php 
/*
====================================
Jonathan Wagner
Jonathan.Wagner@Windstream.com
WBP
====================================
FILE NAME:          index.php
 TAB SIZE:          4
SOFT TABS:          NO
====================================
Copywrite @2015
*/
	error_reporting(E_ALL);
	if (!isset($_COOKIE["userid"])) {
		header('location: login.php');
	} else {
		$username=$_COOKIE["userid"];
	}
	?>

<!DOCTYPE HTML>
<!--
	Stellar by HTML5 UP
	html5up.net | @ajlkn
	Free for personal and commercial use under the CCA 3.0 license (html5up.net/license)
-->
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

		<!-- Wrapper -->
			<div id="container">

				<!-- Header -->
					<header id="header" class="alt">
						<span class="logo"><img src="images/lll_logo.jpg" alt="" /></span>
						<h1>Lori's Lovely Lashes</h1>
						<h3>Backoffice</h3>
						built by <a href="https://twitter.com/xanthakita">@xanthakita</a> for Lori's Lovely Lashes.</p>

					</header>


				
				<!-- Main -->
					<div id="main">
						<div>
						<!-- Introduction -->
						<div class="col-3-sm"></div>
						<div class="col-6-sm">
							Welcome, <?php echo $username;?>:<br>
							<div class="spotlight"> <image src="./images/artists/<?php echo $username;?>.jpg" width="85px"  style="transform: rotate(90deg);">
							</image>
							</div>
						</div>
						<div class="well center-text">
							<h3>Please choose an action below</h3>
						</div>
						<div id="action" class="well">
							<a class="btn btn-sm btn-primary" href="logout.php">Logout</a>
							<a class="btn btn-sm btn-primary" href="logout.php">Find Client</a>
							<a class="btn btn-sm btn-primary" href="logout.php">Add Client</a>
							<a class="btn btn-sm btn-primary" href="logout.php">Reports</a>
						</div>

				<!-- Footer -->
					<footer id="footer">
						<section>
							<h2>Aliquam sed mauris</h2>
							<p>Sed lorem ipsum dolor sit amet et nullam consequat feugiat consequat magna adipiscing tempus etiam dolore veroeros. eget dapibus mauris. Cras aliquet, nisl ut viverra sollicitudin, ligula erat egestas velit, vitae tincidunt odio.</p>
							<ul class="actions">
								<li><a href="generic.html" class="button">Learn More</a></li>
							</ul>
						</section>
						<section>
							<h2>Etiam feugiat</h2>
							<dl class="alt">
								<dt>Address</dt>
								<dd>1234 Somewhere Road &bull; Nashville, TN 00000 &bull; USA</dd>
								<dt>Phone</dt>
								<dd>(000) 000-0000 x 0000</dd>
								<dt>Email</dt>
								<dd><a href="#">information@untitled.tld</a></dd>
							</dl>
							<ul class="icons">
								<li><a href="#" class="icon fa-twitter alt"><span class="label">Twitter</span></a></li>
								<li><a href="#" class="icon fa-facebook alt"><span class="label">Facebook</span></a></li>
								<li><a href="#" class="icon fa-instagram alt"><span class="label">Instagram</span></a></li>
								<li><a href="#" class="icon fa-github alt"><span class="label">GitHub</span></a></li>
								<li><a href="#" class="icon fa-dribbble alt"><span class="label">Dribbble</span></a></li>
							</ul>
						</section>
						<p class="copyright">&copy; Untitled. Design: <a href="https://html5up.net">HTML5 UP</a>.</p>
					</footer>

			</div>

		<!-- Scripts -->
			<script src="assets/js/jquery.min.js"></script>
			<script src="assets/js/jquery.scrollex.min.js"></script>
			<script src="assets/js/jquery.scrolly.min.js"></script>
			<script src="assets/js/skel.min.js"></script>
			<script src="assets/js/util.js"></script>
			<!--[if lte IE 8]><script src="assets/js/ie/respond.min.js"></script><![endif]-->
			<script src="assets/js/main.js"></script>

	</body>
</html>

<?php 
//end
 ?>
