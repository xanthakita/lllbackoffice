<?php
/*
PHPTelnet 1.1.1
by Antone Roundy
adapted from code found on the PHP website
public domain
*/

class PHPTelnet {
	var $show_connect_error=1;

	var $use_usleep=1;	// change to 1 for faster execution
		// don't change to 1 on Windows servers unless you have PHP 5
	var $sleeptime=2000;
	var $loginsleeptime=1000;

	var $fp=NULL;
	var $loginprompt;

	var $conn1;
	var $conn2;
	


	/*
	0 = success
	1 = couldn't open network connection
	2 = unknown host
	3 = login failed
	4 = PHP version too low
	*/
	function Connect($server,$port,$user,$pass) {
		$rv=0;
		$vers=explode('.',PHP_VERSION);
		$needvers=array(4,3,0);
		$j=count($vers);
		$k=count($needvers);
		$loginprompt='Login:';
		if ($k<$j) $j=$k;
		for ($i=0;$i<$j;$i++) {
			if (($vers[$i]+0)>$needvers[$i]) break;
			if (($vers[$i]+0)<$needvers[$i]) {
				$this->ConnectError(4);
				return 4;
			}
		}
		
		//$this->Disconnect();
		
		if (strlen($server)) {
			if (preg_match('/[^0-9.]/',$server)) {
				$ip=gethostbyname($server);
				if ($ip==$server) {
					$ip='';
					$rv=2;
				}
			} else $ip=$server;
		} else $ip='127.0.0.1';
			echo $ip;
		if (strlen($ip)) {
			if ($this->fp=fsockopen($ip,$port)) {

				fputs($this->fp,$this->conn1);
				$this->Sleep();
				
				fputs($this->fp,$this->conn2);
				$this->Sleep();
				$this->GetResponse($r);
				$r=explode("\n",$r);

				$this->loginprompt=$r[count($r)-1];

				fputs($this->fp,"$user\r");
				$this->Sleep();

				fputs($this->fp,"$pass\r");
				if ($this->use_usleep) usleep($this->loginsleeptime);
				else sleep(1);
				$this->GetResponse($r);
				$r=explode("\n",$r);
				if (($r[count($r)-1]=='')||($this->loginprompt==$r[count($r)-1])) {
					$rv=3;
					$this->Disconnect();
				}

			} else $rv=1;
		}
		
		if ($rv) $this->ConnectError($rv);
		return $rv;
	}
	
	function Disconnect($exit=1) {
		if ($this->fp) {
			if ($exit) $this->DoCommand('exit',$junk);
			fclose($this->fp);
			$this->fp=NULL;
		}
	}

	function DoCommand($c,&$r) {
		if ($this->fp) {
			fputs($this->fp,"$c\r");
			$this->Sleep();
			$this->GetResponse($r);
			$r=preg_replace("/^.*?\n(.*)\n[^\n]*$/","$1",$r);
		}
		return $this->fp?1:0;
	}
	
	function GetResponse(&$r) {
		$r='';
		do { 
			$r.=fread($this->fp,1000);
			$s=socket_get_status($this->fp);
		} while ($s['unread_bytes']);
	}
	
	function Sleep() {
		if ($this->use_usleep) usleep($this->sleeptime);
		else sleep(1);
	}
	
	function PHPTelnet() {
			define("CONN1","chr(0xFF).chr(0xFB).chr(0x1F).chr(0xFF).chr(0xFB).chr(0x20).chr(0xFF).chr(0xFB).chr(0x18).chr(0xFF).chr(0xFB).chr(0x27).chr(0xFF).chr(0xFD).chr(0x01).chr(0xFF).chr(0xFB).chr(0x03).chr(0xFF).chr(0xFD).chr(0x03).chr(0xFF).chr(0xFC).chr(0x23).chr(0xFF).chr(0xFC).chr(0x24).chr(0xFF).chr(0xFA).chr(0x1F).chr(0x00).chr(0x50).chr(0x00).chr(0x18).chr(0xFF).chr(0xF0).chr(0xFF).chr(0xFA).chr(0x20).chr(0x00).chr(0x33).chr(0x38).chr(0x34).chr(0x30).chr(0x30).chr(0x2C).chr(0x33).chr(0x38).chr(0x34).chr(0x30).chr(0x30).chr(0xFF).chr(0xF0).chr(0xFF).chr(0xFA).chr(0x27).chr(0x00).chr(0xFF).chr(0xF0).chr(0xFF).chr(0xFA).chr(0x18).chr(0x00).chr(0x58).chr(0x54).chr(0x45).chr(0x52).chr(0x4D).chr(0xFF).chr(0xF0)");
define("CONN2","chr(0xFF).chr(0xFC).chr(0x01).chr(0xFF).chr(0xFC).chr(0x22).chr(0xFF).chr(0xFE).chr(0x05).chr(0xFF).chr(0xFC).chr(0x21)");
define("GSXUSER","admin");
define("GSXPW","!4sonus");

		/*$this->conn1=chr(0xFF).chr(0xFB).chr(0x1F).chr(0xFF).chr(0xFB).
			chr(0x20).chr(0xFF).chr(0xFB).chr(0x18).chr(0xFF).chr(0xFB).
			chr(0x27).chr(0xFF).chr(0xFD).chr(0x01).chr(0xFF).chr(0xFB).
			chr(0x03).chr(0xFF).chr(0xFD).chr(0x03).chr(0xFF).chr(0xFC).
			chr(0x23).chr(0xFF).chr(0xFC).chr(0x24).chr(0xFF).chr(0xFA).
			chr(0x1F).chr(0x00).chr(0x50).chr(0x00).chr(0x18).chr(0xFF).
			chr(0xF0).chr(0xFF).chr(0xFA).chr(0x20).chr(0x00).chr(0x33).
			chr(0x38).chr(0x34).chr(0x30).chr(0x30).chr(0x2C).chr(0x33).
			chr(0x38).chr(0x34).chr(0x30).chr(0x30).chr(0xFF).chr(0xF0).
			chr(0xFF).chr(0xFA).chr(0x27).chr(0x00).chr(0xFF).chr(0xF0).
			chr(0xFF).chr(0xFA).chr(0x18).chr(0x00).chr(0x58).chr(0x54).
			chr(0x45).chr(0x52).chr(0x4D).chr(0xFF).chr(0xF0);  */

			$this->conn1=CONN1;
		/* $this->conn2=chr(0xFF).chr(0xFC).chr(0x01).chr(0xFF).chr(0xFC).
			chr(0x22).chr(0xFF).chr(0xFE).chr(0x05).chr(0xFF).chr(0xFC).chr(0x21);  */

			$this->conn2=CONN2;
	}
	
	function ConnectError($num) {
		if ($this->show_connect_error) switch ($num) {
		case 1: echo 'Connect failed: Unable to open network connection'; break;
		case 2: echo 'Connect failed: Unknown host'; break;
		case 3: echo 'Connect failed: Login failed'; break;
		case 4: echo 'Connect failed: Your server\'s PHP version is too low for PHP Telnet'; break;
		}
	}
}

return;
?>


