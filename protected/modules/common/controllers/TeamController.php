<?php

class TeamController extends UController
{
	/**
	 * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
	 * using two-column layout. See 'protected/views/layouts/column2.php'.
	 */
	public $layout='//layouts/column2';



	/**
	 * Displays a particular model.
	 * @param integer $id the ID of the model to be displayed
	 */
	public function actionView($id)
	{
		$this->render('view',array(
			'model'=>$this->loadModel($id),
		));
	}
	public function actionDeleteAll(){
		Predict::model()->deleteAll();
		$this->redirect(array('result'));
	}
	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionUpdateSchedule()
	{	
		if(!empty($_POST)){
			// dump($_POST);
			$model = Schedule::model()->findByPk(outBin($_POST['id']));
			$model->object_o_id= outBin($_POST['zero']);
			$model->object_n_id= outBin($_POST['number']);
			$model->filter= $_POST['order'];
			$model->save();
		}
		$this->redirect(array('schedule'));
	}
	public function actionResult()
	{	
		$result = array();
		if(!empty($_GET)){
			if($_GET['z']=="" && $_GET['n']==""){
				$result = Predict::model()->findAllByAttributes(array(
					'obj_z_id'=>outBin($_GET['object_0']),
					'obj_n_id'=>outBin($_GET['object_1']),
				));
			}else{
				$result = Predict::model()->findAllByAttributes(array(
					'obj_z_id'=>outBin($_GET['object_0']),
					'obj_n_id'=>outBin($_GET['object_1']),
					'ty_so_z'=>$_GET['z'],
					'ty_so_n'=>$_GET['n'],
				));
			}
		}
		$teams = Team::model()->findAll();
		$this->render('result',array(
			'teams'=>$teams,
			'result'=>$result,
		));
	}
	public function actionSchedule()
	{	
		if(!empty($_POST)){
			$model = new Schedule;
			$model->object_o_id= outBin($_POST['object_0']);
			$model->object_n_id= outBin($_POST['object_1']);
			$model->filter= $_POST['order'];
			$model->save();
		}
		$teams = Team::model()->findAll();
		$modelSchedule = Schedule::model()->findAllByAttributes(array(),array('order'=>'filter asc'));
		$this->render('schedule',array(
			'teams'=>$teams,
			'modelSchedule'=>$modelSchedule
		));
	}
	public function actionCreate()
	{
		$model=new Team;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Team']))
		{
			$model->attributes=$_POST['Team'];
			if($model->save())
				$this->redirect(array('admin'));
		}

		$this->render('create',array(
			'model'=>$model,
		));
	}

	/**
	 * Updates a particular model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 * @param integer $id the ID of the model to be updated
	 */
	public function actionUpdate($id)
	{
		$model=$this->loadModel($id);

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Team']))
		{
			$model->attributes=$_POST['Team'];
			if($model->save())
				$this->redirect(array('admin'));
		}

		$this->render('update',array(
			'model'=>$model,
		));
	}

	/**
	 * Deletes a particular model.
	 * If deletion is successful, the browser will be redirected to the 'admin' page.
	 * @param integer $id the ID of the model to be deleted
	 */
	public function actionDelete($id)
	{
		$this->loadModel($id)->delete();

		// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
		if(!isset($_GET['ajax']))
			$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
	}

	/**
	 * Lists all models.
	 */
	public function actionIndex()
	{
		$dataProvider=new CActiveDataProvider('Team');
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new Team('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Team']))
			$model->attributes=$_GET['Team'];

		$this->render('admin',array(
			'model'=>$model,
		));
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer the ID of the model to be loaded
	 */
	public function loadModel($id)
	{
		$model=Team::model()->findByPk(outBin($id));
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param CModel the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='team-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
