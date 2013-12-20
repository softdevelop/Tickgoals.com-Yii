<?php

class AdminController extends UController
{
	/**
	 * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
	 * using two-column layout. See 'protected/views/layouts/column2.php'.
	 */
	public $layout='//layouts/column2';

	/**
	 * @return array action filters
	 */
	public function filters()
	{
		return array(
			'accessControl', // perform access control for CRUD operations
		);
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



	
	
	public function actionExport(){
		$filename = "user.xlsx";
		
		$criteria	=	new CDbCriteria;
		
		$result	=	Users::model()->findAll($criteria);
		
		
		Yii::import('application.extensions.phpexcel.JPhpExcel');
		
		$rs = array();
		foreach($result as $key=>$value){
			$value->id = outStr($value->id);
			$rs[] = $value->attributes;
		
		}
		$xls = new JPhpExcel('UTF-8', false, 'Users');
		$xls->addArray($rs);
		$xls->generateXML('users');
		
		
		
		
		
//dump($model);
	}

	/**
	 * Manages all models.
	 */
	public function actionIndex($name=NULL)
	{
	
		$this->layout = "//layouts/unicorn";
		$criteria	=	new CDbCriteria;
		$criteria->addSearchCondition('first_name',$name,true,'OR');
		$criteria->addSearchCondition('last_name',$name,true,'OR');
		$criteria->addSearchCondition('email',$name,true,'OR');
		$result	=	Users::model()->findAll($criteria);
		$count		=	count($result);
		$pages				=	new CPagination($count);
		$pages->pageSize	=	20;
		$criteria->order = "created DESC";

		
		
		$pages->applyLimit($criteria);
		//$model =	Users::model()->findAll($criteria);
		$model =  new CActiveDataProvider('Users', array(
			'criteria' => $criteria,
			'pagination' => $pages,
		));
		
		$this->render('admin',array(
			'model'=>$model,
			'pages'=>$pages,
			'count'=>$count,
			'name'=>$name,
		));
	}
	public function actionDelete($id=NULL){
		$lists = Lists::model()->findAllByAttributes(array(
			'user_id'=>outBin($id)
		));
		if($lists){
			foreach($lists as $k=>$v){
				Goal::model()->findByAttributes(array('list_id'=>$v->id))->delete();
			}
			$lists->delete();
		}
		
		
		$model = Users::model()->findByPk(outBin($id));
		
		
		if($model->delete()){
			$this->redirect(Yii::app()->createUrl('/user/admin'));
			jsonOut(array(
				'msg'=>'Xóa thành viên  thành công ',
				'error'=>false
			));
				
		}else{
			$errors = $model->getErrors();
			list ($field, $_errors) = each ($errors);
			jsonOut(array(
				'msg'=>'Xóa thành viên không thành công '.$_errors[0],
				'error'=>true
			));
		}
	}


	/**
	 * Performs the AJAX validation.
	 * @param CModel the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='users-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
