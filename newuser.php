<!DOCTYPE html>
<html>
<head>
	<title>New User Signup</title>
</head>
<body>

<?php 
 	ini_set("allow_url_include", true);
 	//include_once("include.php");
 	    // require_once('/var/www/html/Classes/kint/Kint.class.php');
 	     //kint::enabled(false);
 	if (isset($_SESSION['username'])) {$username=$_SESSION['username'];}

 	if ( isset($_SESSION['errorstring']) ) {
 		echo $_SESSION['errorstring']."<br>"; 
 		$_SESSION['errorstring']="";
 	}
 ?>
<center>
<table>
	<caption>Signup Form</caption>
	<tbody>
		<tr>
			<td width="80">&nbsp;</td>
			<td>
 <form action="usercontroller.php" method="post" accept-charset="utf-8">
 		<input type="hidden" name="act" value="adduser">
 		<h3> Please enter the following to signup for access to the NOC Document Management System </h3>
 		Username (CSO): <input type="text" name="username" value="<?php echo $username; ?>"><br>
 	<?php /*	Password: <input type="password" name="pwd1" value="" ><br>
 		Verify Password: <input type="password" name="pwd2" value="" ><br> */
 	?>
 		Firstname: <input type="text" name="firstname" value="" >
 		Lastname: <input type="text" name="lastname" value=""><br>
 		Email: <input type="email" name="email" value=""><br>
 		Department: <br>
 		CNOC:<input type="radio" name="dept" value="'CNOC'">
 		DNOC:<input type="radio" name="dept" value="'DNOC'">
 		ENOC:<input type="radio" name="dept" value="'ENOC'">
 		TNOC:<input type="radio" name="dept" value="'TNOC'">
 		VNOC:<input type="radio" name="dept" value="'VNOC'"><br><br>
 		<input type="submit" name="submit" value="Submit"><br>
 </form>
 </td>
		</tr>
	</tbody>
</table>
</center>

</body>
</html>