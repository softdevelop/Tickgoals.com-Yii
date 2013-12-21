<?php

class GoalsController extends TickGoalsController
{
	
	public function actionRemoveList($listId=NULL,$ref=NULL){
		$list = Lists::model()->findByPk(outBin($listId));
		if(!empty($list)){
			$list->delete();
			Goal::model()->deleteAllByAttributes(array(
				'list_id'=>outBin($listId)
			));
			if($ref!=NULL){
				Yii::app()->user->setFlash('success', 'Deleted list successfully.');
				$this->redirect(array('/goals'));
			}
		}
	}
	public function actionRemoveGoal($goalId=NULL){
		$list = Goal::model()->findByPk(outBin($goalId));
		if(!empty($list)){
			$list->delete();
		}
	}
	public function actionEditGoals($gId=NULL,$listId=NULL){
		$model = Goal::model()->findByPk(outBin($gId));
		//  jsonOut($_POST);
		if(isset($_POST))
		{
			//  $model->attributes=$_POST['Goal'];
			$model->time = time();			
			$model->name = $_POST['name'];			
			$model->reminder = $_POST['reminder'];			
			$model->completion = $_POST['completion'];	
			$_time = strtotime(date("Y-m-d G:i:s"));
			$date = strtotime($model->completion);
			if($_time>$date){
				$model->status=1;
			}else $model->status=0;
			
			if($model->validate()){

				if($model->save()){
					$date = strtotime($model->completion);
					$model->time = date("d M Y",$date);
					jsonOut(array(
						'error'=>false,
						'data'=>$model->attributes
					));
				}else{
					jsonOut(array(
						'error'=>true,
						
					));
				}
			}else{
				$errors = $model->getErrors();
				list ($field, $_errors) = each ($errors);
				// throw new Exception($_errors[0]);
				jsonOut(array(
						'error'=>true,
						'data'=>$_errors[0]
					));
			}
		}

	}
	public function actionEdit($gId=NULL,$listId=NULL){
		$model = Goal::model()->findByPk(outBin($gId));
		if(isset($_POST['ajax']) && $_POST['ajax']==='goal-form')
        {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }
		if(isset($_POST['Goal']))
		{
			$model->attributes=$_POST['Goal'];
			$model->time = time();			
			if($model->validate()){

				if($model->save()){
					Yii::app()->user->setFlash('success', 'Edit goal successfully.');
					$this->redirect(Yii::app()->createUrl('/goals?uId'.outStr(currentUser()->id)));
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
		$this->render('edit',array(
			
			'model'=>$model,
			
		));
	}
	public function actionList($listId=NULL){
		$list = Lists::model()->findByPk(outBin($listId));
		$model = new Goal;
		
		$dataGoals  = Goal::model()->findAllByAttributes(array(
			'list_id'=>outBin($listId)
		),array('order'=>'time desc'));
		$this->render('list',array(
			'list'=>$list,
			'model'=>$model,
			'dataGoals'=>$dataGoals,
		));
	}
	public function actionAdded($listId=NULL){
		
		if(isset($_POST['Goal']))
		{
			$model = new Goal;
			$model->attributes=$_POST['Goal'];
			$model->time = time();
			$model->list_id = outBin($listId);
			$_time = strtotime(date("Y-m-d G:i:s"));
			$date = strtotime($model->completion);
			if($_time>$date){
				$model->status=1;
			}else $model->status=0;
			if($model->validate()){

				if($model->save()){
					// Yii::app()->user->setFlash('success', 'Add goal successfully.');
					// $this->redirect(Yii::app()->createUrl('/goals/list',array('listId'=>$listId)));
					// $this->redirect(Yii::app()->createUrl('/goals?uId'.outStr(currentUser()->id)));
					$date = strtotime($model->completion);
					$_date = date("Y-m-d",$model->time);
					$date = date("d M Y",$date);
					$model->completion = $date;
					$model->id = outStr($model->id);
					jsonOut(array(
						'error'=>false,
						'message'=>'',
						'listId'=>$listId,
						'completion'=>$_date,
						'data'=>$model->attributes
					));
				}else{
					$errors = $model->getErrors();
					list ($field, $_errors) = each ($errors);
					// throw new Exception($_errors[0]);
					jsonOut(array(
						'error'=>true,
						'message'=>'',
						'data'=>$errors
					));
				}
			}else{
				$errors = $model->getErrors();
				list ($field, $_errors) = each ($errors);
				jsonOut(array(
					'error'=>true,
					'message'=>'',
					'data'=>$errors
				));
				// throw new Exception($_errors[0]);
			}
		}
	}
	public function actionAdd($listId=NULL){
		$list = Lists::model()->findByPk(outBin($listId));
		$model = new Goal;
		if(isset($_POST['ajax']) && $_POST['ajax']==='goal-form')
        {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }
		if(isset($_POST['Goal']))
		{
			$model->attributes=$_POST['Goal'];
			$model->time = time();
			$model->list_id = outBin($listId);
			if($model->validate()){

				if($model->save()){
					Yii::app()->user->setFlash('success', 'Add goal successfully.');
					// $this->redirect(Yii::app()->createUrl('/goals/list',array('listId'=>$listId)));
					$this->redirect(Yii::app()->createUrl('/goals?uId'.outStr(currentUser()->id)));
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
		$dataGoals  = Goal::model()->findAllByAttributes(array(
			'list_id'=>outBin($listId)
		),array('order'=>'time desc'));
		$this->render('add',array(
			'list'=>$list,
			'model'=>$model,
			'dataGoals'=>$dataGoals,
		));
	}
	public function actionCreateList(){
		$model = new Lists;
		if(isset($_POST['ajax']) && $_POST['ajax']==='lists-form')
        {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }
		if(isset($_POST['Lists']))
		{
			$model->attributes=$_POST['Lists'];
			if($model->validate()){
				$model->time = time();
				$model->user_id = currentUser()->id;
				if($model->save()){
					Yii::app()->user->setFlash('success', 'Created new list successfully.');
					$this->redirect(array('/goals?uId='.outStr(currentUser()->id)));
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
	}
	public function actionLoadGoal($uId=NULL){
		$this->layout = "ajax";
		$user = Users::model()->findByPk(outBin($uId));
		if(empty($user)) $this->redirect(array('/site'));

		
		$criteria = new CDbCriteria();
		$criteria->together = true;
		$criteria->condition = "user_id = :user_id";				
		
		$criteria->params = array('user_id'=>outBin($uId));
		$criteria->with = 'goals';
		$criteria->order = 't.time desc,goals.time desc';
		
		$lists = Lists::model()->findAll($criteria);
		$model = new Goal;
		$this->render('my_goals_ajax',array(
			'lists'=>$lists,
			'model'=>$model,
			'uId'=>$uId,
		));
	}
	public function actionIndex($uId=NULL,$listid=NULL)
	{
		// $setting = Settings::model()->findAll();
		// $countSetting = count($setting);
		// $rand = rand(0,$countSetting-1);
		
		
		$model = new Goal;
		$list = Lists::model()->findByPk(outBin($listid));
		if(!empty($list)){
			$user = Users::model()->findByPk(outBin($uId));
			$this->pageTitle = $user->first_name." ".$user->last_name."'s Goals - {$list->name}";
			$this->des = " Check out " .$user->first_name." ".$user->last_name."'s Goal list - {$list->name} and motivate them on to achieve their goal!";
			$this->layout = "publish";
				
			$this->render('my_share',array(
				'lists'=>$list,
				'uId'=>$uId,
				'model'=>$model,
			));
			exit;
		}
		
		// $this->layout = "publish";
		$user = Users::model()->findByPk(outBin($uId));
		if(empty($user)) $this->redirect(array('/site'));
		
		// $lists = Lists::model()->findAllByAttributes(array(
			// 'user_id'=>outBin($uId)
		// ),array('order'=>'time desc'));
		
		$criteria = new CDbCriteria();
		$criteria->together = true;
		$criteria->condition = "user_id = :user_id";				
		
		$criteria->params = array('user_id'=>outBin($uId));
		$criteria->with = 'goals';
		$criteria->order = 't.time desc,goals.time desc';
		
		$lists = Lists::model()->findAll($criteria);
		if(!empty($lists)){
			foreach($lists as $key=>$value){
				$this->pageTitle = currentUser()->first_name." ".currentUser()->last_name."'s Goals - {$value->name}";
				$this->des = " Check out " .currentUser()->first_name." ".currentUser()->last_name."'s Goal list - {$value->name} and motivate them on to achieve their goal!";
			}
		}
		
		$this->render('my_goals',array(
			'lists'=>$lists,
			'model'=>$model,
			'uId'=>$uId,
			'user'=>$user
		));
	}
	
	public function actionRenderPartialList($uId = NULL, $listid=NULL)
	{
		$this->layout = "//layouts/blick";
		$model = new Goal;
		$list = Lists::model()->findByPk(outBin($listid));
		if(!empty($list)){
			//$user = Users::model()->findByPk(outBin($uId));
			//$this->pageTitle = $user->first_name." ".$user->last_name."'s Goals - {$list->name}";
			//$this->des = " Check out " .$user->first_name." ".$user->last_name."'s Goal list - {$list->name} and motivate them on to achieve their goal!";
			//$this->layout = "publish";
	
			$this->render('my_list',array(
				'list'=>$list,
				'key'=>$listid,
				'uId'=>$uId,
				'model'=>$model,
			));
		}
	}
}