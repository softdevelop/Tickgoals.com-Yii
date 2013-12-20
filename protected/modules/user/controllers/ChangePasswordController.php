<?php

class ChangePasswordController extends UController
{
	/**
	 * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
	 * using two-column layout. See 'protected/views/layouts/column2.php'.
	 */
	public $layout='//layouts/main';


	public function actionIndex(){
		
		
		$this->layout = "//layouts/unicorn";

		$model = new JLChangePasswordForm;
		if (isset($_POST['ajax']) && $_POST['ajax'] === 'changepass') {
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
		$model->scenario = "fullchange";
		if(!empty($_POST)){
			$model->attributes = $_POST['JLChangePasswordForm'];
			if($model->validate()){
				$user = currentUser();
				$user->password = Users::model()->encodePassword($model->password);
				
				if($user->save()){
					Yii::app()->user->setFlash('success', "Change password successfully.");
					$this->redirect(array('/user/changePassword'));
				}
			}
		}
		$this->render('index',array(
			'model'=>$model
		));
	}

}
