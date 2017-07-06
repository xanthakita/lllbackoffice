<?php
reguire('Classes/mydbconnect.class.php');
$dbtest = new mydbconnect;
$sql="Show tables;";

echo $dbtest->querydb($sql).PHP_EOL;
?>
