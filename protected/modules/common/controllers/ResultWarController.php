<?php

class ResultWarController extends UController
{
	/**
	 * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
	 * using two-column layout. See 'protected/views/layouts/column2.php'.
	 */
	public $layout='//layouts/column2';

	public function actionNotify(){
		$strEmail = "";
		$strTime = "";
		$created = date("Y-m-d");
		$date =  strtotime(date ("Y-m-d G:i:s", strtotime ($created)) . " -3 days");
		$expired = strftime ("%Y-%m-%d",$date);
		
		$dudoan = ResultSx::model()->findAll(array(
												'condition' => 'cr>=:days AND  cr<=:created and status=0',
												'params' => array(
													':days' => $expired,
													':created' => $created,
													
												)
											));
		

		if(!empty($dudoan)){
			foreach($dudoan as $key=>$value){
				
				$kq = ResultWar::model()->findByAttributes(array(
					'created' => $value->cr,
					'teama' => $value->teama,
					'teamb' => $value->teamb,
					'rsa' => $value->rsa,
					'rsb' => $value->rsb,
				));
				$d = date("d-m-Y",strtotime($value->cr));
				
				if(!empty($kq)){
					$subject = "[G-League] Kết quả dự đoán cùng G-League {$d}";
					
					
					$users = Users::model()->findByPk($value->user_id);
					
					if(!empty($users)){
						$strEmail .= $users->email."|";
						$strTime .= $value->created."|";
						
						//dump($users->first_name . " ".$users->last_name." - ".$value->created ,false);
					}
					
					//$email = "thinhpq@appdev.vn";
					//$subject='=?UTF-8?B?'.base64_encode($subject).'?=';
					//$headers="From:  <{$email}>\r\n".
						//"Reply-To: {$email}\r\n".
						//"MIME-Version: 1.0\r\n".
						//"Content-type: text/plain; charset=UTF-8";
					//$body = "Hi {$email} <h1 style='text-align:center'>Test</h1>";
					//mail('quocthinh9889@gmail.com',$subject,$body,$headers);
//				dump($kq->attributes,false);
				
				}
			}
			$this->redirect("http://lemonlane.toancauxanh.vn/testMain?email={$strEmail}&time={$strTime}");
		}
		
		//dump($expired,false);
		//dump($created,false);
		//dump($dudoan,false);
		die('a');
	}
	public function actionTestMail(){
	// Please specify your Mail Server - Example: mail.yourdomain.com.
ini_set("SMTP","smtp.gmail.com");

// Please specify an SMTP Number 25 and 8889 are valid SMTP Ports.
ini_set("smtp_port","465");

// Please specify the return address to use
//ini_set('sendmail_from', 'quocthinh9889@gmail.com');
$to = "quocthinh9889@gmail.com";
$subject = "Test mail";
$message = "Hello! This is a simple email message.";
$from = "thinhpq@appdev.vn";
$headers =  $from;
mail($to,$subject,$message,$headers);
echo "Mail Sent.";

	}
	public function actionAssign(){
		if(!empty($_POST)){
			if(!empty($_POST['sl'])){
				for($i=0;$i<3;$i++){
					$model = new ResultSx;
					$model->teama = outBin($_POST['rsa'][$i]);
					$model->teamb = outBin($_POST['rsb'][$i]);
					$model->rsa = $_POST['teama'][$i];
					$model->rsb = $_POST['teamb'][$i];
					$model->user_id = outBin($_POST['sl']);
					$model->cr = date("Y-m-d",strtotime($_POST['date']));
					$model->created = time();
					$model->save();
				}
			}else{
				ResultWar::model()->deleteAllByAttributes(array(
					'created'=>date("Y-m-d",strtotime($_POST['date']))
				));
				for($i=0;$i<3;$i++){
					$model = new ResultWar;
					$model->teama = outBin($_POST['rsa'][$i]);
					$model->teamb = outBin($_POST['rsb'][$i]);
					$model->rsa = $_POST['teama'][$i];
					$model->rsb = $_POST['teamb'][$i];
					$model->created = date("Y-m-d",strtotime($_POST['date']));
					$model->save();
				}
				$this->redirect(array('/common/resultWar/notify'));
			}
			
			
			$this->redirect(array('/'));
		}
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

	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate()
	{
		$model=new ResultWar;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['ResultWar']))
		{
			$model->attributes=$_POST['ResultWar'];
			if($model->save())
				$this->redirect(array('view','id'=>$model->id));
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

		if(isset($_POST['ResultWar']))
		{
			$model->attributes=$_POST['ResultWar'];
			if($model->save())
				$this->redirect(array('view','id'=>$model->id));
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
		$dataProvider=new CActiveDataProvider('ResultWar');
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new ResultWar('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['ResultWar']))
			$model->attributes=$_GET['ResultWar'];

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
		$model=ResultWar::model()->findByPk($id);
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
		if(isset($_POST['ajax']) && $_POST['ajax']==='result-war-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
