<?php

require_once('phpTelnet.class.php');
require_once('kint/Kint.class.php');
kint::enabled(false);

$telnet= new PHPTelnet();

s($telnet);
echo "\n Connect: \n";
if ($telnet->Connect('66.49.124.204', 23, 'admin', '!4sonus') == 0) {
//$telnet->DoCommand('!4sonus',$Results);
echo "\n Do Command \n";
$telnet->DoCommand('SHOW CHASSIS STATUS',$Results);

echo "\n $Results\n";
//$telnet->GetResponse($Results);
//echo "\n $Results \n";
$telnet->Disconnect();
}

?>

