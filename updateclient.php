<?php 
/*
 ====================================
 Jonathan Wagner
 Jonathan.Wagner@Windstream.com
 NOC Tools Response Team
 ====================================
 FILE NAME:          updateclient.php
  TAB SIZE:          4
 SOFT TABS:          NO
 ====================================
 Copywrite @2017
 */ 

include("client.class.php");
include('Classes/include.php'); 

$data=$_POST;
$thisClient = new Client($data['clientID']);
echo $thisClient->Update_Client($data['clientID'], $data['firstName'], $data['lastName'], $data['phone'], $data['email'], $data['city'], $data['state'], $data['birthmonth'], $data['birthday']);
var_dump($thisClient);








 ?>