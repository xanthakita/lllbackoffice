<?php

class MyString {

	public function RandomString()
	{
    	$characters = ’0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ’;
    	$randstring = '';
    	for ($i = 0; $i < 10; $i++) {
    	    $randstring.= $characters[rand(1, strlen($characters))];
    	}
    	return $randstring;
	}

}