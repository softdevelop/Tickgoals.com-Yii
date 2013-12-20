<?php
function baseTheme(){
	return Yii::app()->theme->baseUrl;
}
function url($str=NULL){
	return Yii::app()->createUrl($str);
}
function outBin($str=NULL){
	return IDHelper::uuidToBinary($str,true);
}
function outStr($str=NULL){
	return IDHelper::uuidFromBinary($str);
}
function jsonOut($obj, $exit = true) {
	error_reporting(0);
	
	ob_start();
	echo @CJSON::encode($obj);
	$size = ob_get_length();
	//ob_end_flush();
	
	header("Content-Length: {$size}");
	header('Connection: close');
	header("Content-type: application/json");
	
	@ob_end_flush();
	@ob_flush();
	@flush();
	
	if ($exit) {
		if (YII_DEBUG) exit();
		else Yii::app()->end();
	} else {
		$session_id = session_id();
		if (session_id()) session_write_close();
		return $session_id;
	}
}
function dump($obj,$isExit = true) {
	CVarDumper::dump($obj,10,true);
	if ($isExit) exit();	
}
function currentUser() {
	if(!Yii::app()->user->isGuest)
		return Users::model()->getInfo(Yii::app()->user->id);
	else
		return false;
}

