<?php
class CompleteCommand extends CConsoleCommand {
    public function run($args) {
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
				// $d3 = strtotime (date ("Y-m-d", strtotime ($today)) . " -3 days");
				// $d3 = strftime ("%Y-%m-%d",$d3); 
				$goals = Goals::model()->findAll(
							array(
								'condition' => 'list_id = :list_id and completion =:fday and status=0',
								'params' => array(
									':list_id' => $l->id,
									':fday' => $today,
									
								)
							)
						);
				if(!empty($goals)){
					foreach($goals as $kg=>$g){
						$g->status=1;
						$g->save();
						$subject = "Times up!:  {$g->name}";
						

						

						$message = 'Hi '.$first_name.' 
<br>
	
	Times Up on:
	<br>
	
	'.$g->name.'
	<br>
	
	Hope you completed your goal!
	<br>
	
	Make sure you go to <a href="http://tickgoals.com">TickGoals.com</a> and tick off our goal!
	<br>
	
	'.$cat.'
	<br>
	
	<img src="http://tickgoals.com/images/photo.jpg">
	<br>
	
	Brought to you by <a href="http://tickgoals.com">TickGoals.com</a>
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
