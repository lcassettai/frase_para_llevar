<?php
	function assets_url($asset){
	   return base_url().$asset.'/';
	}

	function obtener_version(){
		$fp = fopen(base_url()."version", "r");
		$version = fgets($fp);
		fclose($fp);
		return $version;
	}
?>
