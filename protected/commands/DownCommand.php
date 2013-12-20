<?php
class DownCommand extends CConsoleCommand {
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
				
				$today = date ('Y-m-d');
				$d3 = strtotime (date ("Y-m-d", strtotime ($today)) . " -3 days");
				$d3 = strftime ("%Y-%m-%d",$d3); 
				$goals = Goals::model()->findAll(
							array(
								'condition' => 'list_id = :list_id and completion >=:fday AND completion<= :lday and status=0',
								'params' => array(
									':list_id' => $l->id,
									':fday' => $d3,
									':lday' => $today,
								)
							)
						);
				if(!empty($goals)){
					foreach($goals as $kg=>$g){
						$subject = "3 Days left: {$g->name}";
						

						

						$message = 'Hi '.$first_name.' <br>
<br>
	
	You have 3 days left to complete:<br>
						<br>
	
	'.$g->name.' which is due on the '.$g->completion.'<br>
	<br>
	
	'.$cat.'<br>
	<br>
	
	<img src="http://tickgoals.com/images/photo.jpg">		<br>		
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
