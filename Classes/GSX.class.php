<?php
error_reporting(E_ALL ^ E_NOTICE ^ E_WARNING);
require_once('kint/Kint.class.php');
Kint::enabled(false);

Class GSX {
// Get the name of the GSX and check to find the active MNS card
		

	private $dbh;
	private $mysqlserver;
	private $mysqlusername;
	private $mysqlpassword;
	private $dbname;


	function __construct() {
		global $dbh;
	
		//require_once("mydbi.php");

		try {
			$dbh = new PDO("mysql:host=".$mysqlserver.";dbname=".$dbname, $mysqlusername, $mysqlpassword);
			$dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		} catch (PDOException $e) {
			error(false, "PDO ERROR: " . $e->getMessage());
		}
	}

	function get_active_gsxIP($gsx_name) {
		global $dbh;
		$gsx_data = "Select * from sonus_gsx where hostname='$gsx_name'";
	    $gsx_data_result=$dbh->query($gsx_data) or die ("Query to get gsx data from sonus_gsx failed: ".mysql_error());

    	//while ($gsxrow=mysql_fetch_array($gsx_data_result)) {
    	foreach ($gsx_data_result as $gsxrow ) {
    	    $gsx_ip1=$gsxrow['primary_ip'];
        	$gsx_ip2=$gsxrow['secondary_ip'];
			passthru(" /var/www/html/AS/.tool_files/check_mns.sh $gsx_ip1 > /dev/null", $result);
			$retval = $gsx_ip1;
			if ($result){
				passthru("/var/www/html/AS/.tool_files/check_mns.sh $gsx_ip2 > /dev/null", $result);
				$retval = $gsx_ip2;
			}
		}
		return $retval;	
    }

    function checkISUPAlarms($gsx_name){
    	$gsx_ip=$this->get_active_gsxIP("$gsx_name");
    	$retval=passthru(" /var/www/html/AS/.tool_files/check_isup_alarms.sh $gsx_ip", $result);
    	return $retval;
    }

    function buildGSXTable(){
    	global $dbh;
		$gsx_data = "SELECT * FROM sonus_gsx GROUP BY hostname ORDER BY hostname";
	    $gsx_data_result=$dbh->query($gsx_data) or die ("Query to get gsx data from sonus_gsx failed: ".mysql_error());
   		//$gsx_name_result=mysql_query($gsxquery) or die ("Query to get hostname data from gsx_table failed: ".mysql_error());
   		 echo "<center><table border=2 width='80%' class='table table-striped table-bordered table-condensed table-hover'><tr><th>GSX Name</th><th>Primary IP</th><th>Secondary IP</th><th>Primary NFS</th><th>Secondary NFS</th><th>Signaling IP</th></tr>";
    //while ($gsxrow=mysql_fetch_array($gsx_name_result)) {
    foreach($gsx_data_result as $gsxrow) {
        $hostname=strtoupper($gsxrow['hostname']);
        $primary_ip=($gsxrow['primary_ip']);
        $secondary_ip=($gsxrow['secondary_ip']);
        $primary_nfs=($gsxrow['primary_nfs']);
        $secondary_nfs=($gsxrow['secondary_nfs']);
        $signaling_ip=($gsxrow['signaling_ip']);
        $active_ip=$this->get_active_gsxIP($hostname);

        if ($active_ip == $primary_ip) { $modifier="class='success'";} else if ($active_ip == $secondary_ip) { $modifier="class='danger'";}

        echo "<tr>
          <td>
            $hostname
          </td>";
          if ($active_ip == $primary_ip) { $modifier="class='success'"; echo "<td $modifier>"; } else { echo "<td>";}
           echo " $primary_ip
          </td>";
           if ($active_ip == $secondary_ip) { $modifier="class='danger'"; echo "<td $modifier>"; } else { echo "<td>";}
           echo " $secondary_ip
          </td>
          <td>
            $primary_nfs
          </td>
          <td>
            $secondary_nfs
          </td>
          <td>
            $signaling_ip
          </td>
        </tr>";
    }
    echo "</table></center>";
    }

    /* function getCredentials($gsx_name){
    	global $dbh;
		$gsx_data = "Select * from sonus_gsx where hostname='$gsx_name'";
	    $gsx_data_result=$dbh->query($gsx_data) or die ("Query to get gsx data from sonus_gsx failed: ".mysql_error());

    } */



  function GSXconnect($GSXName){
    global $dbh;
    global $Connect;

 require('mydbi.php');

    try {
      $dbh = new PDO("mysql:host=".$mysqlserver.";dbname=".$dbname, $mysqlusername, $mysqlpassword);
      $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    } catch (PDOException $e) {
      error(false, "PDO ERROR: " . $e->getMessage());
    }

    $sql="Select primary_ip, secondary_ip from sonus_gsx where hostname = '$GSXName' limit 1;";
    d($sql);
      $ip_data_result=$dbh->query($sql) or die ("Query to get employee data from employees failed: ".mysql_error());
      d( $ip_data_result);
      foreach ($ip_data_result as $adderesses ) {
      $primaryAddress="$adderesses[primary_ip]";
      $secondaryAddress = "$adderesses[secondary_ip]";
    }
    d($primaryAddress);
    d($secondaryAddress);

    $ConnectAddress = $primaryAddress;
    $Connect = fsockopen($ConnectAddress, 23, $errno, $errstr, 10);
            if(!$Connect){
                //Try connecting to the secondary
                echo "Connection to the primary ".$serverName." failed: ".$errno."\n";
                $ConnectAddress = $secondaryAddress;
                //flush_buffers();
                $Connect = fsockopen($ConnectAddress, 23, $errno, $errstr, 10);
                if(!$Connect){
                    echo "Connection to the standby failed: ".$errno."\n";
                    //flush_buffers();
                }
            }
            if($Connect) {
      $conn1=CONN1;
      fputs($Connect,$conn1);
      sleep(1);

      $conn2=CONN2;
      fputs($Connect,$conn2);
      sleep(1);

      //Send username
      fputs($Connect,GSXUSER."\r");
      sleep(1);

      //Send password
      fputs($Connect,GSXPW."\r");
      $use_usleep=1;
      $loginsleeptime=5;
            sleep($loginsleeptime);
            
          }

    return($Connect);
  }


  function closeConnection(){
    global $Connect;
    fclose($Connect);
  }

  function cicReset($connection, $isupname, $CICstoReset){
    global $Connect;
    $Connect=$connection;
      d($Connect);
        Kint::trace();

        $getcic=$CICstoReset;

      d($isupname);
      d($getcic);

            $icount=0;
      if($Connect){


              foreach ($getcic as $cics){
        fwrite($Connect,"set NO_PAGE 1\r\n");
        sleep(5);
        fwrite($Connect,"set NO_CONFIRM 1\r\n");
        sleep(5);
        $info = fread($Connect,1000);
                d($info, $isupname, $cics[cic]);
                  $command1="CONFIGURE ISUP CIRCUIT SERVICE $isupname  CIC $cics[cic] MODE BLOCK\r\n";
                  $command2="CONFIGURE ISUP CIRCUIT SERVICE $isupname   CIC $cics[cic]  STATE disabled\r\n";
                  $command3="CONFIGURE ISUP CIRCUIT SERVICE $isupname  CIC $cics[cic]  STATE enabled \r\n";
                  $command4="CONFIGURE ISUP CIRCUIT SERVICE $isupname   CIC $cics[cic]   MODE UNBLOCK \r\n";
                  d($command1,$command2,$command3,$command4);
                    $info = fwrite($Connect,$command1); d($info);
                    sleep(5);echo fread($Connect, 4096)."\n";
                    $info = fwrite($Connect,$command2); d($info);
                    sleep(5);echo fread($Connect, 4096)."\n";
                    $info = fwrite($Connect,$command3); d($info);
                    sleep(5);echo fread($Connect, 4096)."\n";

                                fputs($Connect,"CONFIGURE ISUP CIRCUIT SERVICE $cics[isid]  CIC $cics[cic] MODE BLOCK\r");
                               // sleep(1);
                                fputs($Connect,"CONFIGURE ISUP CIRCUIT SERVICE $cics[isid]   CIC $cics[cic]  STATE disabled\r");
                               // sleep(1);
                                fputs($Connect,"CONFIGURE ISUP CIRCUIT SERVICE $cics[isid]  CIC $cics[cic]  STATE enabled \r");
                               // sleep(1);
                                fputs($Connect,"CONFIGURE ISUP CIRCUIT SERVICE $cics[isid]   CIC $cics[cic]   MODE UNBLOCK \r");
                               // sleep(1);
                                fputs($fp,"CONFIGURE ISUP CIRCUIT SERVICE $cics[isid]   CIC $cics[cic]   MODE UNBLOCK \r" );

                    //$info = fwrite($Connect,$command4); d($info);
                   
                    sleep(5);echo fread($Connect, 4096)."\n";
                    echo "$isupname, CIC: $cics[cic], Reset from RELEASE State on GSX.<br>\n";
                    sleep(1);
               }
    }
                
    return(0);
  }
}

// example of class in action
Kint::trace();
$gsx = new GSX;
$gsx->closeConnection();
d( $gsx);
$connection=$gsx->GSXconnect('olvemo01ig001');
d($connection);
//$GSXName = 'olvemo01ig001';
$cicsreset[]=array('cic'=>'1073-1084');
$tgname='WNVLMOXA01TLCL';
//  PMBHFLMA06TSG  1220  MTLDFLBRDS1_LPAETEC
//call_user_func('gsxCommand', &$arguments);
$retval=$gsx->cicReset($connection, $tgname, $cicsreset);
//$retval=$gsx->GSXtestconnect($GSXName, $tgname, $cicsreset);


$retval=$gsx->closeConnection();
?>
