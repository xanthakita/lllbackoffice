<?php
// mysql connection info  ($mysqlserver, $mysqlusername, $mysqlpassword
// This is for connectivity to the mysql database server on the nocbox01

$mysqlserver='localhost';
$mysqlusername='advsrv';
$mysqlpassword='Adv4nc3d';
$dbname = 'NOCTOOLS';
 
// Constants
if (!isset($myglobals)) {
	$myglobals=true;
	define("CONN1","chr(0xFF).chr(0xFB).chr(0x1F).chr(0xFF).chr(0xFB).chr(0x20).chr(0xFF).chr(0xFB).chr(0x18).chr(0xFF).chr(0xFB).chr(0x27).chr(0xFF).chr(0xFD).chr(0x01).chr(0xFF).chr(0xFB).chr(0x03).chr(0xFF).chr(0xFD).chr(0x03).chr(0xFF).chr(0xFC).chr(0x23).chr(0xFF).chr(0xFC).chr(0x24).chr(0xFF).chr(0xFA).chr(0x1F).chr(0x00).chr(0x50).chr(0x00).chr(0x18).chr(0xFF).chr(0xF0).chr(0xFF).chr(0xFA).chr(0x20).chr(0x00).chr(0x33).chr(0x38).chr(0x34).chr(0x30).chr(0x30).chr(0x2C).chr(0x33).chr(0x38).chr(0x34).chr(0x30).chr(0x30).chr(0xFF).chr(0xF0).chr(0xFF).chr(0xFA).chr(0x27).chr(0x00).chr(0xFF).chr(0xF0).chr(0xFF).chr(0xFA).chr(0x18).chr(0x00).chr(0x58).chr(0x54).chr(0x45).chr(0x52).chr(0x4D).chr(0xFF).chr(0xF0)");
	define("CONN2","chr(0xFF).chr(0xFC).chr(0x01).chr(0xFF).chr(0xFC).chr(0x22).chr(0xFF).chr(0xFE).chr(0x05).chr(0xFF).chr(0xFC).chr(0x21)");
	define("GSXUSER","admin");
	define("GSXPW","!4sonus");
	define("SPACE", "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;");
	define("FILTER_PATTERN", "/[^a-zA-Z0-9 _-]/");
}
?>
