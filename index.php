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

			
			</div>
 <nav class="navbar navbar-toggleable-md navbar-inverse bg-inverse fixed-top">


      <div class="collapse navbar-collapse" id="navbarsExampleDefault">
        <ul class="navbar-nav mr-auto">
                  <li class="nav-item">
			<div class="spotlight pull-right"> <image src="./images/artists/<?php echo $username;?>.jpg" width="85px"  style="transform: rotate(90deg);">
			</image>
			</div>
          </li>
          <li class="nav-item active">
            <h3>Welcome, <?php echo $username;?>:</h3>
          </li>
        </ul>
      </div>
    </nav>

    <div class="container">

	<!-- Header -->
					<header id="header" class="alt">
						<span class="logo"><img src="images/lll_logo.jpg" alt="" /></span>
						<h1>Lori's Lovely Lashes</h1>
						<h3>Backoffice</h3>
						built by <a href="https://twitter.com/xanthakita">@xanthakita</a> for Lori's Lovely Lashes.</p>

					</header>


				
				<!-- Main -->
					<div id="main">
<ul>          
		  <li class="nav-item">
            <a class="nav-link" href="logout.php">Log Off</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#">Add Client</a>
          </li>
          <li class="nav-item">
            <a class="nav-link disabled" href="#">Find Client</a>
          </li>
          <li class="nav-item">
            <a class="nav-link disabled" href="#">Run Reports</a>
          </li>
</ul>




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

	</body>
</html>

<?php 
//end
 ?>
