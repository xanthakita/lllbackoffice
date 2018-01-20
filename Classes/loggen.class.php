<?php

/*
====================================
Jonathan Wagner
Jonathan.Wagner@Windstream.com
NOC Tools Response Team
====================================
FILE NAME:          loggen.class.php
 TAB SIZE:          2
SOFT TABS:          YES
====================================
Copywrite @2018
Clone from depo.dsys.windstream.net by issuing the following:

git clone https://depo.dsys.windstream.net/ntrt/logGen.git

see Test.php for example on how to instantiate the classes in this file

*/

/*
 * Copyright 2015 Leon van Kammen / Coder of Salvation. All rights reserved.
 * 
 * Redistribution and use in source and binary forms, with or without modification, are
 * permitted provided that the following conditions are met:
 * 
 *    1. Redistributions of source code must retain the above copyright notice, this list of
 *       conditions and the following disclaimer.
 * 
 *    2. Redistributions in binary form must reproduce the above copyright notice, this list
 *       of conditions and the following disclaimer in the documentation and/or other materials
 *       provided with the distribution.
 * 
 * THIS SOFTWARE IS PROVIDED BY Leon van Kammen / Coder of Salvation AS IS'' AND ANY EXPRESS OR IMPLIED
 * WARRANTIES, INCLUDING, BUT NOT LIMITED TO, THE IMPLIED WARRANTIES OF MERCHANTABILITY AND
 * FITNESS FOR A PARTICULAR PURPOSE ARE DISCLAIMED. IN NO EVENT SHALL Leon van Kammen / Coder of Salvation OR
 * CONTRIBUTORS BE LIABLE FOR ANY DIRECT, INDIRECT, INCIDENTAL, SPECIAL, EXEMPLARY, OR
 * CONSEQUENTIAL DAMAGES (INCLUDING, BUT NOT LIMITED TO, PROCUREMENT OF SUBSTITUTE GOODS OR
 * SERVICES; LOSS OF USE, DATA, OR PROFITS; OR BUSINESS INTERRUPTION) HOWEVER CAUSED AND ON
 * ANY THEORY OF LIABILITY, WHETHER IN CONTRACT, STRICT LIABILITY, OR TORT (INCLUDING
 * NEGLIGENCE OR OTHERWISE) ARISING IN ANY WAY OUT OF THE USE OF THIS SOFTWARE, EVEN IF
 * ADVISED OF THE POSSIBILITY OF SUCH DAMAGE.
 * 
 * The views and conclusions contained in the software and documentation are those of the
 * authors and should not be interpreted as representing official policies, either expressed
 * or implied, of Leon van Kammen / Coder of Salvation 
 */

//namespace coderofsalvation;

class Syslog{

  public static $hostname   = 'localhost';
  public static $port       = 514;
  public static $program    = "[]";
  public static $embedLevel = true;
  public static $local      = true; 

  public static function level2String($level){
    // taken from syslog + http:// nl3.php.net/syslog for log levels
    switch( $level ){
      case LOG_EMERG:   return "EMERGENCY"; break; // system is unusable
      case LOG_ALERT:   return "ALERT";     break; // action must be taken immediately
      case LOG_CRIT:    return "CRITICAL";  break; // critical conditions
      case LOG_ERR:     return "ERROR";     break; // error conditions
      case LOG_WARNING: return "WARNING";   break; // warning conditions
      case LOG_NOTICE:  return "NOTICE";    break; // normal, but significant, condition
      case LOG_INFO:    return "INFO";      break; // informational message
      case LOG_DEBUG:   return "DEBUG";     break; // debug-level message
    }
  }

  public static function send( $message, $level = LOG_NOTICE, $component = "web" ){
    if( self::$embedLevel ) $message = $message." level=".self::level2String($level);
    //if( self::$local      ) syslog( $level, $message );
  if( self::$hostname == false ) return;
    $sock = socket_create(AF_INET, SOCK_DGRAM, SOL_UDP);
    $facility = 1; // user level
    $pri = ($facility*8)+$level; // multiplying the Facility number by 8 + adding the nume
    $sock = socket_create(AF_INET, SOCK_DGRAM, SOL_UDP);
    foreach(explode("\n", $message) as $line) {
     // $syslog_message = "<{$pri}> ".date('M d H:i:s T') .' '. $component . ' ' .self::$program . $message;
      //$syslog_message = date('M d H:i:s T') .' '. $component . ' ' .self::$program . ' ' . $line;
     $syslog_message = date('M d H:i:s T') .' '. $component . '/' . Syslog::$program . ' ' . $line;
      //echo $syslog_message.PHP_EOL;
      //$syslog_message = $message." level=".$level." component=".$component;
      socket_sendto($sock, $syslog_message, strlen($syslog_message), 0, self::$hostname, self::$port );
    }
    socket_close($sock);    
  }
}

/*
  based off of: https://github.com/the-codepunker/PHP-Errors-Class
  1. Used to output a debug_backtrace when an error occurs
  2. It registers a shutdown function that is meant to output fatal errors nicely
  3. Parse errors are NOT handled. Actually they can't be handled :)
*/
  $version = (float)phpversion();
  // PHP 7.0 and up has an Error class already defined so only define the class if in a lower version
if ($version < 7.0) {

class Error
{
  private $startTime = 0;

  function __construct()
  {
    $this->startTime = microtime(true);
    ob_start();
      ini_set("display_errors", "on");
      error_reporting(E_ALL);
      set_error_handler(array($this, 'scriptError'));
      register_shutdown_function(array($this, 'shutdown'));
  }

  function scriptError($errno, $errstr, $errfile, $errline)
  {
    if(!headers_sent())
      header("HTTP/1.1 500 Internal Server Error");
    if(ob_get_contents() !== false)
      ob_end_clean();

    switch($errno)
    {
      case E_ERROR:               $errseverity = "Error";             break;
      case E_WARNING:             $errseverity = "Warning";           break;
      case E_NOTICE:              $errseverity = "Notice";            break;
      case E_CORE_ERROR:          $errseverity = "Core Error";        break;
      case E_CORE_WARNING:        $errseverity = "Core Warning";      break;
      case E_COMPILE_ERROR:       $errseverity = "Compile Error";     break;
      case E_COMPILE_WARNING:     $errseverity = "Compile Warning";   break;
      case E_USER_ERROR:          $errseverity = "User Error";        break;
      case E_USER_WARNING:        $errseverity = "User Warning";      break;
      case E_USER_NOTICE:         $errseverity = "User Notice";       break;
      case E_STRICT:              $errseverity = "Strict Standards";  break;
      case E_RECOVERABLE_ERROR:   $errseverity = "Recoverable Error"; break;
      case E_DEPRECATED:          $errseverity = "Deprecated";        break;
      case E_USER_DEPRECATED:     $errseverity = "User Deprecated";   break;
      default:                    $errseverity = "Error";             break;
    }

    $v = debug_backtrace();
    date_default_timezone_set("America/New_York");
    $Date = date("Y M d H:i:s");
    $out = '
    <pre style="border-bottom:1px solid #eee;">
      '.$Date.'
      <span style="color:red;">'.$errseverity.':</font> '.$errstr.'
        <span style="color:#3D9700;">Line '.$errline.': '.$errfile.'</span>
      </span>
      <strong>BACKTRACE:</strong>' . PHP_EOL;
    for ($i = 1; $i<count($v); $i++)
    {
      $out .= "\tLine ".(isset($v[$i]["line"]) ? $v[$i]["line"] : "unknown").": ".(isset($v[$i]["file"]) ? $v[$i]["file"] : "unknown"). PHP_EOL;
      $out .= "\t\tMore: " . PHP_EOL;
      $out .= empty($v[$i]["function"]) ? "" : "\t\t\t" . "Function:"  .   $v[$i]["function"];
      $out .= empty($v[$i]["class"])    ? "" : "\t\t\t" . "Class:"     .   $v[$i]["class"];
      $out .= empty($v[$i]["object"])    ? "" : "\t\t\t" . "Object:"    .   json_encode($v[$i]["object"]);
    }
    $out.='</span></pre>';
    echo $out;
  }

  function shutdown()
  {
    $isError = false;
    if ($error = error_get_last())
    {
      switch($error['type'])
      {
        case E_ERROR:
        case E_CORE_ERROR:
        case E_COMPILE_ERROR:
        case E_USER_ERROR:
        case E_RECOVERABLE_ERROR:
        case E_CORE_WARNING:
        case E_COMPILE_WARNING:
          $isError = true;
          $this->scriptError($error['type'], $error['message'], $error['file'], $error['line']);
          break;
      }
    }
  }
}

}

class logGen extends \Error
{
  public $fp;
  public $fn;
  public $script;
  public $ts;  // set cnsistent timestamp with php error timestamps
  public $version;
  public $createlocal = TRUE;
  public $message;
  public static $local      = true; 
  public static $username;
  public static $showDebug = true;
  public $hostname;

  function __construct($username, $filename="/dev/null", $Debug=TRUE)
  {
      self::$showDebug = $Debug;
      logGen::$username=$username;
      $this->fp=fopen("$filename","a+") or die("Could not open file: $filename");
      ini_set('error_log', $filename);
      register_shutdown_function(array($this, 'shutdown'));

    $this->version = (float)phpversion();
    $this->logThis(LOG_DEBUG, "Start LOGGING Session.");
  }

  function shutdown()
  {

      $this->logThis(LOG_DEBUG, "End LOGGING Session.");
      fclose($this->fp);

  }

  protected function convertToString()
  {
      $output="";
      if (is_array($this->message)){
        $output=print_r($this->message,TRUE);
        $this->message=$output;
      } else if (is_object($this->message)){
        $output=print_r($this->message,TRUE);
        $this->message=$output;
      } 
  }

  public function logGlobals()
  {
      $output=print_r($GLOBALS,TRUE);
      $this->logthis($output);
  }

  public function logIncludes()
  {
      $output=print_r($this->fn,TRUE);
      $this->logthis($output);
  }

  public function logThis($logLevel=LOG_INFO, $message='')
  {
    $this->message=$message;
    if (self::$showDebug===FALSE & $logLevel===LOG_DEBUG) { return(0); }
    $varname="static";
    $output="";
    $this->fn=get_included_files();
    // $this->fn=array_pop(explode('/',get_included_files()[0]));
    $output=explode('/',$this->fn[0]);
    $this->script=array_pop($output);
    $this->ts=date("d-M-Y H:i:sa T");
    $type=gettype($this->message);

    foreach($GLOBALS as $key => $value){
        if($message===$value){
          if (strlen($key)>0){
            $varname="$".$key;
          }
        }
    }

      $this->convertToString();
      $message="[".$this->ts."] script=".$this->script." level=".$logLevel." type=".$type." variable=".$varname." ".$this->message;

      SysLog::$program=$this->script;
      //echo SysLog::$program.PHP_EOL;
      if ($this->createlocal==FALSE){
        SysLog::$local = false;
      } 

      fwrite($this->fp,$message.PHP_EOL);
      SysLog::send( $message, $logLevel, logGen::$username );
  }


}

?>
