<?php 
ini_set("allow_url_include", true);
include_once('/var/www/html/Classes/kint/Kint.class.php');  //debug functions


$users = '';



class Menu 
{

	public function __construct() {
		// basic constructor for user it establishes a connection to the database which is used in each of the methods

		GLOBAL $users;
		require('/var/www/html/Classes/mydbi.php');
		require_once('/var/www/html/Classes/mydbconnect.class.php');
		$dbname = 'NOCTOOLS';
		$link=mysql_connect($mysqlserver, $mysqlusername, $mysqlpassword) or die ("Error connecting to mysql server: ".mysql_error());
		s($link, $mysqlserver, $mysqlusername, $mysqlpassword, $dbname);
		mysql_select_db($dbname, $link) or die ("Error selecting specified database on mysql server: ".mysql_error());
		$users = new mydbconnect;
	}

	public function buildMenu($deptId) {
		GLOBAL $users;
		$sql="SELECT * from NOCTOOLS.tools_menus where ";
		d($deptId);
        switch ($deptId) {
            case '7' :
                $sql.=" visibleTo ";
                break;
            case '6' :
            	$sql.="((visibleTo = '6') or (visibleTo = '7')) ";
                break;
            case '5' :
            	$sql.="(visibleTo = '7') ";
                break;
            case '4' :
            	$sql.="((visibleTo = '6') or (visibleTo = '7') or (visibleTo = '4')) ";
                break;
            case '3' :
            	$sql.="((visibleTo = '6') or (visibleTo = '7') or (visibleTo = '3')) ";
                break;
            case '2' :
            	$sql.="((visibleTo = '6') or (visibleTo = '7') or (visibleTo = '2')) ";
                break;
            case '1' :
            	$sql.="((visibleTo = '6') or (visibleTo = '7') or (visibleTo = '1')) ";
                break;
        }
        $sql.=" order by displayName, icon ;";
        d($sql);
		$getmenu=$users->querydb($sql);
		return($getmenu);
	}
	


}

 ?>