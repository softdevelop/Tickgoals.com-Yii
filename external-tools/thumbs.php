<?php
extract($_REQUEST);

$filename = "{$name}.{$ext}";
$filepath = realpath(dirname(__FILE__) . "/.." . str_replace("/thumbs/{$w}-{$h}", "", $uri));
$dirPath = dirname($filepath) . "/thumbs/{$w}-{$h}";

if ($filepath !== false) {
	// thumbnail file
	require_once("my_image.php");
	
	$my_image = new my_image($filepath);
	
	$my_image->fit($w, $h);
 	$my_image->copyTo("{$dirPath}/{$filename}");
	$my_image->show();
} else {
	
}