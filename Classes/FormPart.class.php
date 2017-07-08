<?php
		require_once 'kint/Kint.class.php';
class FormPart {

	private $dbh;
	public $retval;
	public $ImplementorNameOut;

	function __construct() {
		global $dbh;
		global $retval;
		global $implementorList;
		global $platformList;
		global $implementorResp;

		require("mydbi.php");

		try {
			$dbh = new PDO("mysql:host=".$mysqlserver.";dbname=".$dbname, $mysqlusername, $mysqlpassword);
			$dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		} catch (PDOException $e) {
			error(false, "PDO ERROR: " . $e->getMessage());
		}

//Implementors
		//$implementor_data = "SELECT * FROM NOCTOOLS.employees where doesMops = 1;";
		$implementor_data = "SELECT a.firstname, a.lastname, a.emailAddress, a.smsaddress, b.platform from NOCTOOLS.employees a join NOCTOOLS.MopPlatforms b on substr(a.platformResp,1,1) = b.id where doesMops = '1';";
	    $implementor_data_result=$dbh->query($implementor_data) or die ("Query to get employee data from employees failed: ".mysql_error());

    	$implementorList.='<select id="mop_Implementer" name="mop_Implementer" style="width:60%;">';

    	foreach ($implementor_data_result as $implementor ) {
			$implementorList.="<option> $implementor[firstname] $implementor[lastname] </option>";
			$implementorResp[] = ("$implementor[id] => $implementor[platform]");
		}
		$implementorList.="</select>"; 

// platforms
		$platform_data = "SELECT * FROM NOCTOOLS.MopPlatforms;";
	    $platform_data_result=$dbh->query($platform_data) or die ("Query to get gsx data from sonus_gsx failed: ".mysql_error());

    	$platformList.='<select multiple id="mop_Platform[]" name="mop_Platform[]" style="width:60%;">';

    	foreach ($platform_data_result as $platform ) {
			$platformList.="<option> $platform[platform] </option>";
		}
		$platformList.="</select>"; 

	}


	public function getImplementorList(){
		global $implementorList;
		return $implementorList;
	}

	public function getPlatformList(){
		global $platformList;
		return $platformList;
	}

	public function getPlatformResp(){
		global $implementorResp;
		return $implementorResp;
	}

}

kint::enabled(false);
//kint::enabled(true);
//$test = new FormPart;

//s($test->getImplementorList());
//s($test->getPlatformList());

?>
