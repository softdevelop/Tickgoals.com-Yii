<?php

class OrderController extends UController
{
	/**
	 * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
	 * using two-column layout. See 'protected/views/layouts/column2.php'.
	 */

	public $layout='//layouts/blank';



	public function actionIndex()
	{
		$users = Users::model()->findAll();
		$this->render('order',
			array(
				'users'=>$users
			)
		);
	}
	public function actionUpload(){
		if(!empty($_FILES['file']['name'])){
			$uploadPath = Yii::getPathOfAlias('webroot') . '/upload/user/';
			if (!is_dir($uploadPath)) {
				@mkdir($uploadPath);
				@chmod($uploadPath, 0777);
			}
			$arr			=	explode(".",$_FILES['file']['name']);
			$name			=	time() . mt_rand(0, 0xfff). '.'.strtolower($arr[count($arr)-1]);
			$file			=	$uploadPath . basename($name); 
			
			$size			=	$_FILES['file']['size'];
			if($size>5097152 ){
				unlink($_FILES['file']['tmp_name']);
				jsonOut(array(
					'error'=>true,
					'msg'=>'Error file size > 5 MB '
				));
				exit;
			}
			if(move_uploaded_file($_FILES['file']['tmp_name'], $file)){
				$model = Users::model()->findByPk(currentUser()->id);
				$model->avatar = $name;
				$model->save();
				$arr = array('error'=>false,'msg'=>'Upload success.','name'=>$name);
				echo @CJSON::encode($arr);
			}else{
				$arr = array('error'=>true,'msg'=>'Upload failed.');
				echo @CJSON::encode($arr);
			}
		}else{
			$arr = array('error'=>true,'msg'=>'No file choosen.');
			echo @CJSON::encode($arr);	
		}
		
		exit;
	}

}
