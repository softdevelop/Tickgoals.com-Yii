<?php
class WCommand extends CConsoleCommand {
    public function run($args) {
      // $to      = 'thinhpq@appdev.vn';

		// $message = "1111Hi
		// Your password for TickGoals.com is \r\n\r\n Thanks ";
		// $headers = "From: " .Yii::app()->params['adminEmail']. "\r\n" .
			// 'Reply-To:' . Yii::app()->params['adminEmail']."\r\n" .
			// 'X-Mailer: PHP/' . phpversion();

		// mail($to, 'test', $message, $headers);  
		$setting = Settings::model()->findAll();
		$countSetting = count($setting);
		$rand = rand(0,$countSetting-1);
		$cat = "~".$setting[$rand]['category']."~".$setting[$rand]['value']."~";
$users = Users::model()->findAll();
	 

		
if(!empty($users)){
	foreach($users as $key=>$u){
	
		$lists = Lists::model()->findAllByAttributes(array(
			'user_id'=>$u->id
		));
		$first_name= $u->first_name;
		$to = $u->email;
		if(!empty($lists)){
			foreach($lists as $kl=>$l){
				$goals =  Goals::model()->findAllByAttributes(array(
					'list_id'=>$l->id,
					'reminder'=>'Weekly'
				));
				
				if(!empty($goals)){
					foreach($goals as $kg=>$g){
						$subject = "Reminder: {$g->name}";
						

						

						$message = 'Hi '.$first_name.' 
<br>
	
	Just a reminder your goal:<br>
						<br>
	
	'.$g->name.' is due on the '.$g->completion.'<br>
						<br>
	
	'.$cat.'<br>
	<br>
	
	<img src="http://tickgoals.com/images/photo.jpg"><br>
	<br>
	
	Brought to you by <a href="http://tickgoals.com">TickGoals.com</a><br>
<br>
	
Thanks';
						$headers = "From: " .Yii::app()->params['adminEmail']. "\r\n" .
							'Reply-To:' . Yii::app()->params['adminEmail']."\r\n" .
							'X-Mailer: PHP/' . phpversion();
						$headers  .= 'MIME-Version: 1.0' . "\r\n";
						$headers .= 'Content-type: text/html; charset=utf8' . "\r\n";
						mail($to, $subject, $message, $headers);
					}
				}
			}
		}
	}
}
		
    }
}
?>
