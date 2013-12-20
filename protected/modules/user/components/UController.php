<?php

class UController extends Controller {

	
	public function init() {
		parent::init();
		Yii::app()->theme="unicorn";
	}

	public function showMessage($title, $content) {
		$this->layout = "ajax";
		$this->render('application.modules.user.views.message', array(
			'title'		=> $title,
			'content'	=> $content,
		));
		exit;
	}
	public function beforeAction(){
		if(Yii::app()->user->isGuest){
			if(!empty(Yii::app()->user->loginUrl)) $this->redirect(Yii::app()->user->loginUrl);
			else $this->redirect(array('/user/login'));
		}else{
			Yii::import('application.modules.rights.models.Role');
			$role = Role::model()->findAllByAttributes(array(
				'group_id'=>currentUser()->group->id
			));
			
			$c = strtolower(Yii::app()->controller->id);
			$a = strtolower(Yii::app()->controller->getAction()->id);
						
			$url = Yii::app()->getUrlManager()->parseUrl(Yii::app()->getRequest());
			$check = false;
			if(currentUser()->superuser==1){
				return true;
			}
			if(!empty($role)){
				foreach($role as $k=>$ro){
					$m = strtolower(Yii::app()->controller->module->id);
					if($ro->module!=NULL){
						
						if(strtolower($ro->module) == strtolower($m) && strtolower($ro->controller) == $c &&  strtolower($ro->view) == $a ){
							$check = true;
						}
					}else{
						if(strtolower($ro->controller) == $c &&  strtolower($ro->view) == $a ){
							$check = true;
						}
					}
				}
			}
			if(!$check){
				throw new CHttpException(400, 'You are not accept permission');
			}else{
				return true;
			}

		}
	}
	// public function filters()
	// {
		

	// }
	// public function allowedActions()
	// {
		// return 'index, suggestedTags';
	// }
	



}
