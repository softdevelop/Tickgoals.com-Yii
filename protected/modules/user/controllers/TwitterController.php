<?php

class TwitterController extends Controller
{
	public function allowedActions() {
		return '*';
	}
	public $layout='//layouts/default';

	
	/**
	 * store information for register user by facebook api
	 * thinhpq add code 25/7/2012
	 * */
	public function actionIndex($oauth_verifier=NULL)
	{
		if(!empty($_GET) && Yii::app()->session['oauth_verifier']==$oauth_verifier){
			// dump(Yii::app()->session['twitter'],false);
			$email = Yii::app()->session['twitter']->screen_name."@twitter.com";
			$firstname = Yii::app()->session['twitter']->name;
			$twitter_id = Yii::app()->session['twitter']->id_str;
			$lastname = "Twitter";
			
			$fbMap = TwitterMapped::model()->findByAttributes(array('fbemail' => $email));
				/**
				 * ========================================================================================
				 * 1. Nếu email này đã được đăng ký (activated), thực hiện đăng nhập cho user luôn
				 * ========================================================================================
				 */
				$existedUser = Users::model()->find('email = :email',array(':email' => $email));
				
				if(!empty($existedUser))
				{
					//Nếu đã tồn tại email này trong bảng facebook map thì tiến hành cho đăng nhập
					if (!empty($fbMap)) {
						$msg = 'Your email address already existed in our system. Your Facebook account is now mapped with your Justlook account!';
						$type = 'success';
						
						// Logout current user
						$user = Users::forceLogin($existedUser->id);
						
						// Store new user information
						// $url = $this->createUrl('/');
						// jsonOut(array('msg' => $msg, 'url' => $url,'type' => $type));
						
						$this->redirect(array('/site?status=1'));
					}
					
					//Còn không thì tiến hành tạo mới và cho đăng nhập
					// Mapping and redirect
					$fbModel = new TwitterMapped;
					$fbModel->user_id = $existedUser->id;
					$fbModel->twitter_id = $twitter_id;
					$fbModel->fbemail = $email;
				
					if($fbModel->save())
					{
						$msg = 'Your email address already existed in our system. Your Facebook account is now mapped with your Justlook account!';
						$type = 'success';

						// Logout current user
						$user = Users::forceLogin($existedUser->id);
						
						// Store new user information
						// $url = $this->createUrl('/');
						// jsonOut(array('msg' => $msg, 'url' => $url,'type' => $type));
						// Yii::app()->user->setFlash('error', $message);
						$this->redirect(array('/site?status=1'));
					}
					else
					{
						// throw errors
						$errors = $fbModel->errors;
						list($index, $error) = each($errors);
						if (!empty($error)) {
							$message = $error[0];
						} else {
							// TODO: Log error
							$message = "Error occurs while performing registration. Please try again or contact our Administrator for more support.";
						}
						Yii::app()->user->setFlash('error', $message);
						$this->redirect(array('/site?status=1'));
						
					}
				}else{
					//remove table mapped account facebook
					TwitterMapped::model()->deleteAllByAttributes(array('fbemail' => $email));
					
					$user = new Users;
					$user->email = $email;
					$user->first_name = $firstname;
					$user->last_name = $lastname;
					$user->lastvisit = time();
					$user->created = date("Y-m-d G:i:s");
					$user->password = Users::model()->encodePassword(uniqid());
					
					$groupUser = Groups::model()->notAdmin();
					if(empty($groupUser)){
						$errors = $user->getErrors();
						list ($field, $_errors) = each ($errors);
						throw new Exception($_errors[0]);
					}
					$user->group_id = $groupUser->id;
					
					// Begin transaction
					$transaction = Yii::app()->db->beginTransaction();
					if(!$user->save()) {
						$transaction->rollback();
						$errors = $user->errors;
						list($index, $error) = each($errors);
						if (!empty($error)) {
							$message = $error[0];
						} else {
							// TODO: Log error
							$message = "Error occurs while performing registration. Please try again or contact our Administrator for more support.";
						}
						Yii::app()->user->setFlash('error', $message);
						$this->redirect(array('/site?status=1'));
					}else{
						// save on table facebook mapped
						$fbModel = new TwitterMapped;
						$fbModel->user_id = $user->id;
						$fbModel->twitter_id = $twitter_id;
						$fbModel->fbemail = $email;
						// Save mapping accounts
						if(!$fbModel->save()) {
							$transaction->rollback();
							$errors = $fbModel->errors;
							list($index, $error) = each($errors);
							if (!empty($error)) {
								$message = $error[0];
							} else {
								// TODO: Log error
								$message = "Error occurs while performing registration. Please try again or contact our Administrator for more support.";
							}
							Yii::app()->user->setFlash('error', $message);
							$this->redirect(array('/site?status=1'));
							
						}else{
							$user = Users::forceLogin($user->id);
							
							$this->redirect(array('/site?status=1'));
							
						}
					}
				}
			Yii::app()->session['twitter'] = "";
		}else{
			$this->redirect(array('/site?status=1'));
		}
		
		
	}
	
}
