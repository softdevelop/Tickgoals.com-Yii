<?php

class MapPermissionController extends RController
{
	/**
	 * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
	 * using two-column layout. See 'protected/views/layouts/column2.php'.
	 */
	public $layout='//layouts/unicorn';
	public function init() {
		parent::init();
		Yii::app()->theme="unicorn";

		
	}
	/**
	 * @return array action filters
	 */
	public function filters()
	{
		return array(
			'accessControl', // perform access control for CRUD operations
			'postOnly + delete', // we only allow deletion via POST request
		);
	}

	/**
	 * Specifies the access control rules.
	 * This method is used by the 'accessControl' filter.
	 * @return array access control rules
	 */
	public function accessRules()
	{
		return array(
		);
	}

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
	public function actionAssign($m=NULL,$c=NULL,$v=NULL,$g=NULL)
	{
		$roles = new Role;
		$roles->module = $m;
		$roles->controller = $c;
		$roles->view = $v;
		$roles->group_id = outBin($g);
		$roles->save();


	}
	public function actionRassign($m=NULL,$c=NULL,$v=NULL,$g=NULL)
	{
		$roles = Role::model()->deleteAllByAttributes(array(
			'module'=>$m,
			'controller'=>$c,
			'view'=>$v,
			'group_id'=>outBin($g),
		));



	}
	public function actionRemove($m=NULL,$c=NULL,$v=NULL)
	{
		$roles = Role::model()->deleteAllByAttributes(array(
			'module'=>$m,
			'controller'=>$c,
			'view'=>$v,
		));

			
		jsonOut(array(
			'error'=>false,
			'message'=>'Removed has been table role. '
		));

	}
	public function actionAll($m=NULL,$c=NULL,$v=NULL)
	{
		$groups = Groups::model()->findAll();
		if(!empty($groups)){
			foreach($groups as $key=>$group){
				$roles = new Role;
				$roles->module = $m;
				$roles->controller = $c;
				$roles->view = $v;
				$roles->group_id = $group->id;
				$roles->save();
			}
			jsonOut(array(
				'error'=>false,
				'message'=>'The has been table role. '
			));
		}
	}
	protected function getAllAction(){
		// Get the generator and authorizer
		$generator = $this->module->getGenerator();

		// Createh the form model
		$model = new GenerateForm();

		// Form has been submitted
		if( isset($_POST['GenerateForm'])===true )
		{
			// Form is valid
			$model->attributes = $_POST['GenerateForm'];
			if( $model->validate()===true )
			{
				$items = array(
					'tasks'=>array(),
					'operations'=>array(),
				);

				// Get the chosen items
				foreach( $model->items as $itemname=>$value )
				{
					if( (bool)$value===true )
					{
						if( strpos($itemname, '*')!==false )
							$items['tasks'][] = $itemname;
						else
							$items['operations'][] = $itemname;
					}
				}

				// Add the items to the generator as tasks and operations and run the generator.
				$generator->addItems($items['tasks'], CAuthItem::TYPE_TASK);
				$generator->addItems($items['operations'], CAuthItem::TYPE_OPERATION);
				if( ($generatedItems = $generator->run())!==false && $generatedItems!==array() )
				{
					Yii::app()->getUser()->setFlash($this->module->flashSuccessKey,
						Rights::t('core', 'Authorization items created.')
					);
					$this->redirect(array('authItem/permissions'));
				}
			}
		}

		// Get all items that are available to be generated
		
		$items = $generator->getControllerActions();

		// Yii::app()->clientScript->registerScript('rightsGenerateItemTableSelectRows',
			// "jQuery('.generate-item-table').rightsSelectRows();"
		// );
		return $items;
	}
	protected function saveRoles($g_id=NULL,$id=NULL){
		if(!empty($_POST['s'])){
			foreach($_POST['s'] as $key=>$role){
				if(!empty($role)){
					foreach($role as $k=>$r){
						if(!empty($r['check']) && $r['check']=="on"){
							$model = new Role;
							if(!empty($r['controller'])) $model->controller = $r['controller'];
							if(!empty($r['name'])) $model->view = $r['name'];
							if(!empty($r['module'])) $model->module = $r['module'];
							$model->group_id = $g_id;
							$model->map_per = $id;
							$model->save();
						}
					}
				}
			}
		}
	}
	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate($gId=NULL)
	{
		$model=new MapPermission;
		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);
		

		
		if(isset($_POST['MapPermission']))
		{
			$model->attributes=$_POST['MapPermission'];
			$model->group_id=outBin($model->group_id);
			$model->permission_id=outBin($model->permission_id);
			if($model->save()){
				$this->saveRoles($model->group_id,$model->id);
				$this->redirect(array('create','gId'=>$gId));
			}
		}
		$items = $this->getAllAction();
		$this->render('create',array(
			'model'=>$model,
			'items'=>$items,
			'gId'=>$gId,
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

		if(isset($_POST['MapPermission']))
		{
			$model->attributes=$_POST['MapPermission'];
			$model->group_id=outBin($model->group_id);
			$model->permission_id=outBin($model->permission_id);
			if($model->save()){
				$this->saveRoles($model->group_id,$model->id);
				$this->redirect(array('view','id'=>outStr($model->id)));
			}
		}
		$items = $this->getAllAction();
		$this->render('update',array(
			'model'=>$model,
			'items'=>$items,
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
		$this->actionCreate();
		// $dataProvider=new CActiveDataProvider('MapPermission');
		// $this->render('index',array(
			// 'dataProvider'=>$dataProvider,
		// ));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new MapPermission('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['MapPermission']))
			$model->attributes=$_GET['MapPermission'];

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
		$model=MapPermission::model()->findByPk(outBin($id));
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
		if(isset($_POST['ajax']) && $_POST['ajax']==='map-permission-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
