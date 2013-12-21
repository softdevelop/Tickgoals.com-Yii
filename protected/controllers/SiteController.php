<?php

class SiteController extends TickGoalsController
{
	public function actions()
	{
		return array(
			// captcha action renders the CAPTCHA image displayed on the contact page
			'captcha'=>array(
				'class'=>'CCaptchaAction',
				'backColor'=>0xFFFFFF,
			),
			// page action renders "static" pages stored under 'protected/views/site/pages'
			// They can be accessed via: index.php?r=site/page&view=FileName
			'page'=>array(
				'class'=>'CViewAction',
			),
		);
	}
	public function actionCu(){
		$goals = Goal::model()->findAll();
		$cnt = 0;
		foreach($goals as $key=>$value){
			$_time = strtotime(date("Y-m-d G:i:s"));
			$time = strtotime($value->completion. "00:00:00");
			if($_time<$time){
				$cnt++;
				$value->status=1;
				$value->save();
				dump($value->name,false);
			}
			
			
		}
		dump(count($goals),false);
		dump($cnt);
	
		$hour = date("H");
		$minute = date("i");
		dump(date("Y-m-d G:i:s"),false);
		dump($hour,false);
		dump($minute,false);
		$users = Users::model()->findAll();
	 

		
		// if(!empty($users)){
			// foreach($users as $key=>$u){
				// $hour = $u->hour;
				// $minute = $u->minute;
				// if($hour<10) $hour = "0".$hour;
				// if($minute<10) $minute = "0".$minute;
				// $_hour = date("H");
				// $_minute = date("i");
				// dump($hour."-".$_hour,false);
				// dump($minute."-".$_minute,false);
				
			// }
		// }
		
		die('a');
	}
	public function actionAddList(){
		if(!empty($_POST)){
			$model =  new Lists;
			$model->name = $_POST['name'];
			$model->user_id = currentUser()->id;
			$model->time = time();
			$model->save();
			$model->id = outStr($model->id);
			jsonOut(array(
				'error'=>false,
				'model'=>$model->attributes,
			));
		}
	}
	public function actionUpdateList(){
		if(!empty($_POST)){
			$model =  Lists::model()->findByPk(outBin($_POST['listid']));
			$model->name = $_POST['name'];
			$model->save();
			jsonOut(array(
				'error'=>false
			));
		}
	}
	public function actionTest(){
		require dirname(__FILE__).'/../modules/social/components/Yahoo.inc';
		define('OAUTH_CONSUMER_KEY', 'dj0yJmk9ZWVyYUk1T01TV3pBJmQ9WVdrOVNHMXVlblpSTjJNbWNHbzlNVFUzTnpFNU56VTJNZy0tJnM9Y29uc3VtZXJzZWNyZXQmeD04Yw--');
		define('OAUTH_CONSUMER_SECRET', 'b9980dfb9e52be569543f9becf6a37eb1ebe195e');
		define('OAUTH_DOMAIN', 'tickgoals.com');
		define('OAUTH_APP_ID', 'HmnzvQ7c');
		$OAUTH_CONSUMER_KEY = OAUTH_CONSUMER_KEY;
		$OAUTH_CONSUMER_SECRET = OAUTH_CONSUMER_SECRET;
		$OAUTH_DOMAIN = OAUTH_DOMAIN;
		$OAUTH_APP_ID = OAUTH_APP_ID;
		
		$hasSession = YahooSession::hasSession(OAUTH_CONSUMER_KEY, OAUTH_CONSUMER_SECRET, OAUTH_APP_ID);
		$profile = array();
		$contacts = array();
		$auth_url = null;
		if($hasSession == FALSE) {
			// create the callback url,
			$callback = YahooUtil::current_url()."?in_popup";
			$sessionStore = new NativeSessionStore();
			// pass the credentials to get an auth url.
			// this URL will be used for the pop-up.
			$auth_url = YahooSession::createAuthorizationUrl(OAUTH_CONSUMER_KEY, OAUTH_CONSUMER_SECRET, $callback, $sessionStore);
		}else{
			// pass the credentials to initiate a session
			$session = YahooSession::requireSession(OAUTH_CONSUMER_KEY, OAUTH_CONSUMER_SECRET, OAUTH_APP_ID);

			
			// if a session is initialized, fetch the user's profile information
			if($session) {
				// Get the currently sessioned user.
				$user = $session->getSessionedUser();
				// Load the profile for the current user.
				$profile = $user->getProfile();
				$contacts=array();
				$profile_contacts = $user->getContactSync();
				foreach($profile_contacts->contactsync->contacts as $key=>$profileContact){
					foreach($profileContact->fields as $contact){
						$contacts[$key][$contact->type]=$contact->value;
					}
				}
				Yii::app()->session['contactYahoo'] = $contacts;
				YahooSession::clearSession();
				echo '<script>
				
					window.opener.location.replace("'.Yii::app()->createUrl('/inviteFriend#').Yii::app()->session['oauth_token_secret'].'")
					window.close();
				</script>';
				
			}
		}
		
		$this->render('test',array(
			'hasSession'=>$hasSession,
			'auth_url'=>$auth_url,
			'profile'=>$profile,
			'contacts'=>$contacts,
		));
	}

	public function actionSetting()
	{
		if(Yii::app()->user->isGuest){
			$this->redirect('/site');
			
		}
		$model = new JLChangePasswordForm('fullchange');
		
		$model->attributes = currentUser()->attributes;
		
		
		if(!empty($_POST)){
			$model->attributes = $_POST['JLChangePasswordForm'];
			if($model->validate()){
				$user = Users::model()->findByPk(currentUser()->id);
				$user->attributes = $model->attributes;
				$user->hour = $model->hour;
				$user->minute = $model->minute;
				if($user->save()){
					Yii::app()->user->setFlash('success','Update user profile successfully.');
					$this->redirect('/site/setting');
				}
			}
		}
		
		$this->render('setting',array(
			'model'=>$model
		));
	}
	public function actionAbout()
	{
		$this->render('about',array());
	}
	public function actionTerms()
	{
		$this->render('terms',array());
	}
	public function actionPravicy()
	{
		$this->render('pravicy',array());
	}
	
	public function actionMyGoals()
	{
		
		$this->render('my_goals',array());
	}
	/**
	 * This is the default 'index' action that is invoked
	 * when an action is not explicitly requested by users.
	 */
	public function actionIndex()
	{
		if(!Yii::app()->user->isGuest){
			$this->redirect(array('/goals?uId='.outStr(currentUser()->id)));
		}
		$this->layout = "main";
		
		
		
		
		// renders the view file 'protected/views/site/index.php'
		// using the default layout 'protected/views/layouts/main.php'
		$this->render('index',array());
	}

	public function actionLt(){
		$this->render('test',array());
	}
	/**
	 * This is the action to handle external exceptions.
	 */
	public function actionError()
	{
		$this->layout = "main";
		if($error=Yii::app()->errorHandler->error)
		{
			if(Yii::app()->request->isAjaxRequest)
				echo $error['message'];
			else
				$this->render('error', $error);
		}
	}

	
	/**
	 * Displays the contact page
	 */
	public function actionContact()
	{
		$model=new ContactForm;
		// if(isset($_POST['ContactForm']))
		// {
			// $model->attributes=$_POST['ContactForm'];
			// if($model->validate())
			// {
				// $name='=?UTF-8?B?'.base64_encode($model->name).'?=';
				// $subject='=?UTF-8?B?'.base64_encode($model->subject).'?=';
				// $headers="From: $name <{$model->email}>\r\n".
					// "Reply-To: {$model->email}\r\n".
					// "MIME-Version: 1.0\r\n".
					// "Content-type: text/plain; charset=UTF-8";

				// mail(Yii::app()->params['adminEmail'],$subject,$model->body,$headers);
				// Yii::app()->user->setFlash('contact','Thank you for contacting us. We will respond to you as soon as possible.');
				// $this->refresh();
			// }
		// }
		$this->render('contactus',array('model'=>$model));
	}

	/**
	 * Displays the login page
	 */
	public function actionRegisterUser()
	{
		$model=new Users;

		// if it is ajax validation request
		if(isset($_POST['ajax']) && $_POST['ajax']==='register-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}

		// collect user input data
		if(isset($_POST['Users']))
		{
			$model->attributes=$_POST['Users'];
			$groupUser = Groups::model()->notAdmin();
			if(empty($groupUser)){
				$errors = $model->getErrors();
				list ($field, $_errors) = each ($errors);
				throw new Exception($_errors[0]);
			}
			$model->group_id = $groupUser->id;
			if($model->validate()){
				$t = $model->password;
				$model->password = Users::model()->encodePassword($model->password);
				$model->created = date("Y-m-d G:i:s");
				$model->birth = $model->created;
				if($model->save()){
					// Yii::app()->user->setFlash('success', 'Account created successfully.');
					$u = new FormLogin;
					$u->email = $model->email;
					$u->password = $t;
					if($u->validate() && $u->login()){
						$this->redirect(array('/goals?uId='.outStr(currentUser()->id)));
						
						
					}
					
					$this->redirect(array('/site'));
				}else{
					$errors = $model->getErrors();
					list ($field, $_errors) = each ($errors);
					throw new Exception($_errors[0]);
				}
			}else{
				$errors = $model->getErrors();
				list ($field, $_errors) = each ($errors);
				throw new Exception($_errors[0]);
			}
		}
		// display the login form
		
	}
	public function actionForgot(){
		$this->render('forgot');
	}
	public function actionShareMail($url=NULL,$listid=NULL,$title=NULL){
		$model = new ShareEmail;
		
		if(!empty($_POST)){
			$model->attributes = $_POST['ShareEmail'];
			if($model->validate()){
		// Yii::import('ext.yii-mail.*');
		// $message = new YiiMailMessage;
		$first_name = currentUser()->first_name;		
		$subject = "{$first_name} has shared their goal list with you!";
		$to      = $model->email;
				
	
	
$message = 'Hi

Check out '.$first_name.' goal list '.$title.' here:

<a href="'.$url.'&listid='.$listid.'">'.$title.'</a>


<br><br>
<img src="http://tickgoals.com/images/photo.jpg">

<br><br>
Brought to you by <a href="http://tickgoals.com">TickGoals.com</a>
<br><br>

Thanks';
				$headers = "From: " .Yii::app()->params['adminEmail']. "\r\n" .
					'Reply-To:' . Yii::app()->params['adminEmail']."\r\n" .
					'X-Mailer: PHP/' . phpversion();
$headers  .= 'MIME-Version: 1.0' . "\r\n";
						$headers .= 'Content-type: text/html; charset=utf8' . "\r\n";
				mail($to, $subject, $message, $headers);
		// $message->view = 'sharemail';
		//userModel is passed to the view
		// $message->setSubject($subject);
		// $message->setBody(array(
			// 'first_name'=>$first_name,
			// 'url'=>$url,
			// 'title'=>$title,
		// ), 'text/html');
		// $message->addTo(currentUser()->email);
		// $message->from = Yii::app()->params['adminEmail'];
		// Yii::app()->mail->send($message);
		Yii::app()->user->setFlash('success','You just shared your goal list '.$title.'  successfully.');
		$this->redirect('/goals?uId='.outStr(currentUser()->id));
	
		}
		}
		
		$this->render('share',array(
			'title'=>$title,
			'url'=>$url,
			'model'=>$model,
			'listid'=>$listid,
		));
		
		
	}
	public function actionCron(){
		
		/*$to      = 'thinhpq@appdev.vn';

		$message = "Hi
		Your password for TickGoals.com is \r\n\r\n Thanks ";
		$headers = "From: " .Yii::app()->params['adminEmail']. "\r\n" .
			'Reply-To:' . Yii::app()->params['adminEmail']."\r\n" .
			'X-Mailer: PHP/' . phpversion();

		mail($to, 'test', $message, $headers);	*/
		$users = Users::model()->findAll();
		
if(!empty($users)){
	foreach($users as $key=>$u){
		$lists = Lists::model()->findAllByAttributes(array(
			'user_id'=>$u->id
		));
		$first_name= $u->first_name;
		$to = "quocthinh9889@gmail.com";
		if(!empty($lists)){
			foreach($lists as $kl=>$l){
				$goals =  Goals::model()->findAllByAttributes(array(
					'list_id'=>$l->id,
					'reminder'=>'Daily'
				));
				
				if(!empty($goals)){
					foreach($goals as $kg=>$g){
						$subject = "Reminder: {$g->name}";
						

						

						$message = 'Hi '.$first_name.' 

	Just a reminder your goal:
						
	'.$g->name.' is due on the '.$g->completion.'
						
	<img src="http://tickgoals.com/images/photo.jpg">
	
	Brought to you by <a href="http://tickgoals.com">TickGoals.com</a>
						
	

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
		dump($_SERVER['DOCUMENT_ROOT']);
	}
	
}
