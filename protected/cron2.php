<?php
// The message
$message = "From: HaiDuong \r\nThis is mail for test cron job \n http://tickgoals.com/protected/cron2.php";

// In case any of our lines are larger than 70 characters, we should use wordwrap()
$message = wordwrap($message, 70, "\r\n");

// Send
mail('quocthinh9889@gmail.com', 'Test cron job', $message);
/*
defined('YII_DEBUG') or define('YII_DEBUG',true);
 
// including Yii
require_once(dirname(__FILE__).'/../library/yii/framework/yii.php');
 
// we'll use a separate config file
$configFile=dirname(__FILE__).'/config/cron.php';

// creating and running console application
Yii::createConsoleApplication($configFile)->run();
*/
?>
