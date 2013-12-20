<?php
extract($_REQUEST);

$filename = "{$name}.{$ext}";
//$filepath = realpath(dirname(__FILE__) . "/../.." . str_replace("/fill/{$w}-{$h}", "", $uri));
$filepath = realpath(dirname(__FILE__) . "/.." . str_replace("/fill/{$w}-{$h}", "", $uri));
$dirPath = dirname($filepath) . "/fill/{$w}-{$h}";

if ($filepath !== false) {
	// thumbnail file
	require_once("my_image.php");
	
	$my_image = new my_image($filepath);
	
	$my_image->fill($w, $h);
	$my_image->copyTo("{$dirPath}/{$filename}");
	$my_image->show();
} else {
	
}