<?php

//mydbconnect.class.php
/*
listing scripts that call this class as I find them:
/var/www/html/hardware/sonus/gatewaysignalforkcontrol.php


 */
// require_once ('/var/www/html/Classes/kint/Kint.class.php');
// kint::enabled(false);

class mydbconnect {


	// private function __construct() {
	// 	require ('mydbi.php');
	// }

	private function sqldblink($sql) {
		// d($sql);
		$mysqlserver='162.243.25.103';
		$mysqlusername='xanthakita';
		$mysqlpassword='6619Y^0m3';
		$dbname = 'lllbackoffice';
		$link=mysqli_connect($mysqlserver, $mysqlusername, $mysqlpassword) or die ("Error connecting to mysql server: ".mysqli_error());
		mysqli_select_db($link, $dbname) or die ("Error selecting specified database on mysql server: ".mysql_error($link));
		//require '/var/www/html/AS/inc/mysqlinc.php';
		$result = mysqli_query($link, $sql);
		if (!$result) {
			die('Invalid query:  '.mysqli_error());
		}
		return $result;
	}

	public function getnextid($tablename) {
		$mysql  = "SELECT auto_increment FROM information_schema.tables WHERE table_name='$tablename'";
		$result = $this->sqldblink($mysql);
		$id     = mysqli_fetch_array($result, MYSQLI_ASSOC);

		$this->id = $id['auto_increment'];
		//return $this->id;
		return $this->id;

	}

	public function gettablenames($schemaname) {
		$mysql  = "SELECT TABLE_NAME FROM information_schema.tables WHERE TABLE_SCHEMA = '$schemaname'";
		$result = $this->sqldblink($mysql);
		while ($tables = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
			$thetables[] = $tables['TABLE_NAME'];
		}
		$this->tables = $thetables;
		return $this->tables;
	}

	public function querydb($sql) {
		// d($sql);
		$myoutput       = null;
		$this->myoutput = array();
		$result         = $this->sqldblink($sql);
		// d($result);
		while ($mydata = mysqli_fetch_array($result, MYSQLI_ASSOC)) {

			$this->myoutput[] = $mydata;
		};
		return $this->myoutput;

	}

}

?>