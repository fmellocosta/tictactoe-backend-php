<?php

if(!function_exists('asset_url')) {
	function asset_url(){
		return base_url().'assets/';
	}
}

if(!function_exists('generateRandomId')) {
	function generateRandomId()	{
		return md5(uniqid(rand(), true));
	}
}

?>