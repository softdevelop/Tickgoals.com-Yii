<?php

class ForgotController extends AdController
{
	/**
	 * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
	 * using two-column layout. See 'protected/views/layouts/column2.php'.
	 */
	public $layout='//layouts/login';

	/**
	 * @return array action filters
	 */
	// public function filters()
	// {
		// return array(
			// 'accessControl', // perform access control for CRUD operations
		// );
	// }

	public function allowedActions() {
		return '*';
	}
	/**
	 * Specifies the access control rules.
	 * This method is used by the 'accessControl' filter.
	 * @return array access control rules
	 */
	public function accessRules()
	{
		return array();
	}
	public function actionIndex(){
		$model = new ForgotPass;
		
		// if it is ajax validation request
		if (isset($_POST['ajax']) && $_POST['ajax'] === 'forgot-form') {
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
		if(!empty($_POST)){
			$model->attributes = $_POST['ForgotPass'];
			$subject = 'Forgot Password';
			
			if($model->validate()){
				$user = Users::model()->findByAttributes(array(
					'email'=>$model->email
				));
				$p = uniqid();
				if(!empty($user)){
					$user->password = Users::model()->encodePassword($p);
					$user->save();
				}
				$to      = $model->email;
				
				$message = 'Hi
	Your password for TickGoals.com is '.$p."\r\n\r\n Thanks ";
				$headers = "From: " .Yii::app()->params['adminEmail']. "\r\n" .
					'Reply-To:' . Yii::app()->params['adminEmail']."\r\n" .
					'X-Mailer: PHP/' . phpversion();

				mail($to, $subject, $message, $headers);


				// Yii::import('ext.yii-mail.*');
				// $message = new YiiMailMessage;
				// $message->view = 'forgot';
				// $message->setSubject($subject);
				// $message->setBody(array('p'=>$p), 'text/html');
				// $message->addTo($model->email);
				// $message->from = Yii::app()->params['adminEmail'];
				// Yii::app()->mail->send($message);
				
				Yii::app()->user->setFlash('success','Thank you for contacting us. We will respond to you as soon as possible.');
				$this->redirect('/site');
			}
			
		}
		
	}

}
