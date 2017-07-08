<?php
require('Classes/mydbconnect.class.php');
$dbtest = new mydbconnect;
$sql="Show tables;";

var_dump($dbtest->querydb($sql));
?>
