<?php
// The message
// $message = "From: HaiDuong \r\nThis is mail for test cron job \n http://tickgoals.com/protected/cron2.php";

// In case any of our lines are larger than 70 characters, we should use wordwrap()
// $message = wordwrap($message, 70, "\r\n");

// Send
// mail('quocthinh9889@gmail.com', 'Test cron job', $message);

// $users = Users::model()->findAll();
		
// if(!empty($users)){
	// foreach($users as $key=>$u){
		// $lists = Lists::model()->findAllByAttributes(array(
			// 'user_id'=>$u->id
		// ));
		// $first_name= $u->first_name;
		// $to = "quocthinh9889@gmail.com";
		// if(!empty($lists)){
			// foreach($lists as $kl=>$l){
				// $goals =  Goals::model()->findAllByAttributes(array(
					// 'list_id'=>$l->id,
					// 'reminder'=>'Daily'
				// ));
				
				// if(!empty($goals)){
					// foreach($goals as $kg=>$g){
						// $subject = "Reminder: {$g->name}";
						

						

						// $message = 'Hi '.$first_name.' 

	// Just a reminder your goal:
						
	// '.$g->name.' is due on the '.$g->completion.'
						
						
						
	// Brought to you by TickGoals.com (link to TickGoals.com)

// Thanks';
						// $headers = "From: " .Yii::app()->params['adminEmail']. "\r\n" .
							// 'Reply-To:' . Yii::app()->params['adminEmail']."\r\n" .
							// 'X-Mailer: PHP/' . phpversion();

						// mail($to, $subject, $message, $headers);
					// }
				// }
			// }
		// }
	// }
// }





defined('YII_DEBUG') or define('YII_DEBUG',true);
 
// including Yii
require_once(dirname(__FILE__).'/../library/yii/framework/yii.php');
 
// we'll use a separate config file
$configFile=dirname(__FILE__).'/config/cron.php';

// creating and running console application
Yii::createConsoleApplication($configFile)->run();

?>
