<?php

class RegisterController extends UController
{
	/**
	 * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
	 * using two-column layout. See 'protected/views/layouts/column2.php'.
	 */
	public $layout='//layouts/column2';
	

	public function allowedActions() {
		return '*';
	}


	public function actionUpdate($id=NULL)
	{
		$this->layout = "//layouts/unicorn";
		$model=Users::model()->getInfo(outBin($id));
		if(isset($_POST['Users']))
		{
			$model->attributes=$_POST['Users'];
			$model->group_id = IDHelper::uuidToBinary($model->group_id);
			$model->salary = $_POST['Users']['salary'];
			if($model->validate()){
				// $model->password = Users::model()->encodePassword($model->password);
				$model->created = date("Y-m-d G:i:s");
				
				$model->birth = date("Y-m-d",strtotime($model->birth));
				$model->email = trim($model->email);
				
				if($model->save()){
					if(!empty($_POST['Departments']['id'])){

						MapDepartments::model()->deleteAllByAttributes(array(
							'user_id'=>$model->id,
						));
						$modelDepartments = new MapDepartments;
						$modelDepartments->user_id = $model->id;
						$modelDepartments->department_id = outBin($_POST['Departments']['id']);
						$modelDepartments->save();
					}
					Yii::app()->user->setFlash('success', "Chỉnh sửa thông tin thành viên <b> [{$model->first_name} {$model->last_name}]</b> thành công");
					$this->redirect(array('/user/admin'));
				}else{
					// $errors = $model->getErrors();
					// list ($field, $_errors) = each ($errors);
					// dump("Save: ".$_errors[0],false);
				}
			}else{
				// $errors = $model->getErrors();
				// list ($field, $_errors) = each ($errors);
				// dump("Validate: ".$_errors[0],false);
			}
		}

		
		$this->render('update',array(
			'model'=>$model,
			'id'=>$id,
		));
	}
	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionIndex()
	{
		$this->layout = "//layouts/unicorn";
		$model=new Users;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);
		if(isset($_POST['Users']))
		{
			$model->attributes=$_POST['Users'];
			$model->group_id = IDHelper::uuidToBinary($model->group_id);
			$model->salary = $_POST['Users']['salary'];
			if($model->validate()){
				$model->password = Users::model()->encodePassword($model->password);
				$model->created = date("Y-m-d G:i:s");
				$model->birth = date("Y-m-d",strtotime($model->birth));
				if($model->save()){
					if(!empty($_POST['Departments']['id'])){
						$modelDepartments = new MapDepartments;
						$modelDepartments->user_id = $model->id;
						$modelDepartments->department_id = outBin($_POST['Departments']['id']);
						$modelDepartments->save();
					}
					Yii::app()->user->setFlash('success', 'Đăng ký thành viên mới thành công');
					$this->redirect(array('/user/admin'));
				}else{
					// $errors = $model->getErrors();
					// list ($field, $_errors) = each ($errors);
					// dump("Save: ".$_errors[0],false);
				}
			}else{
				// $errors = $model->getErrors();
				// list ($field, $_errors) = each ($errors);
				// dump("Validate: ".$_errors[0],false);
			}
		}

		$this->render('index',array(
			'model'=>$model,
		));
	}




}
