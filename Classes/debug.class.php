<?php 
/*
====================================
Jonathan Wagner
Jonathan.Wagner@Windstream.com
NOC Tools Response Team
====================================
FILE NAME:          debug.class.php
 TAB SIZE:          4
SOFT TABS:          NO
====================================
Copywrite @2015
*/

/**
* debugIt
*/

require_once('kint/Kint.class.php');

class debugIt extends Kint
{
	
	function __construct()
	{
		
		if(isset($_GET['Debug'])) {$this->y(); } else {$this->n();}
	}

	static function y()
	{
		kint::enabled(true);
	}

	static function n()
	{
		kint::enabled(false);
	}

}


?>