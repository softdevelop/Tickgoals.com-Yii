<?php

class FacebookController extends Controller
{
	public function allowedActions() {
		return '*';
	}
	public $layout='//layouts/default';

	
	/**
	 * store information for register user by facebook api
	 * thinhpq add code 25/7/2012
	 * */
	public function actionStore()
	{
		if( Yii::app()->request->isAjaxRequest )
		{
			$token = Yii::app()->request->getParam('token');
			$infor = Yii::app()->request->getParam('info');
			Yii::app()->session->add('fbUser',$infor);
			Yii::app()->session->add('fbToken',$token);
			
			/**
			 * Xử lý trường hợp thông báo lỗi Undefine email khi click Sign With Facebook
			 * Nếu gặp lỗi trong quá trình lấy thông tin từ facebook thì thông báo lỗi và kết thúc
			 **/
			if (!empty($infor['error'])) {
				$msg = 'An active access token must be used to query information about the current user';
				$type = 'message';
				jsonOut(array('msg' => $msg, 'type' => $type));
			}
			
			if(count($infor))
			{
				$fbMap = FacebookMapped::model()->findByAttributes(array('fbemail' => $infor['email']));
				/**
				 * ========================================================================================
				 * 1. Nếu email này đã được đăng ký (activated), thực hiện đăng nhập cho user luôn
				 * ========================================================================================
				 */
				$existedUser = Users::model()->find('email = :email',array(':email' => $infor['email']));
				if(!empty($existedUser))
				{
					//Nếu đã tồn tại email này trong bảng facebook map thì tiến hành cho đăng nhập
					if (!empty($fbMap)) {
						$msg = 'Your email address already existed in our system. Your Facebook account is now mapped with your Justlook account!';
						$type = 'success';
						
						// Logout current user
						$user = Users::forceLogin($existedUser->id);
						
						// Store new user information
						$url = $this->createUrl('/goals?uId='.outStr($existedUser->id));
						jsonOut(array('msg' => $msg, 'url' => $url,'type' => $type));
					}
					
					//Còn không thì tiến hành tạo mới và cho đăng nhập
					// Mapping and redirect
					$fbModel = new FacebookMapped;
					$fbModel->user_id = $existedUser->id;
					$fbModel->facebook_id = $infor['id'];
					$fbModel->fbemail = $infor['email'];
				
					if($fbModel->save())
					{
						$msg = 'Your email address already existed in our system. Your Facebook account is now mapped with your Justlook account!';
						$type = 'success';

						// Logout current user
						$user = Users::forceLogin($existedUser->id);
						
						// Store new user information
						$url = $this->createUrl('/goals?uId='.outStr($existedUser->id));
						jsonOut(array('msg' => $msg, 'url' => $url,'type' => $type));
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
							
						jsonOut(array(
							'error'	=> true,
							'type'	=> 'success',
							'url'	=> $this->createUrl('/'),
							'msg'	=> $message
						));
					}
				}else{
					//remove table mapped account facebook
					FacebookMapped::model()->deleteAllByAttributes(array('fbemail' => $infor['email']));
					$user = new Users;
					$user->email = $infor['email'];
					$user->first_name = $infor['first_name'];
					$user->last_name = $infor['last_name'];
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
						
						jsonOut(array(
							'error'	=> true,
							'type'	=> 'success',
							'url'	=> $this->createUrl('/'),
							'msg'	=> $message
						));
					}else{
						// save on table facebook mapped
						$fbModel = new FacebookMapped;
						$fbModel->user_id = $user->id;
						$fbModel->facebook_id = $infor['id'];
						$fbModel->fbemail = $infor['email'];
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
							
							jsonOut(array(
								'error'	=> true,
								'type'	=> 'error',
								'url'	=> $this->createUrl('/'),
								'msg'	=> $message
							));
						}else{
							$user = Users::forceLogin($user->id);
							jsonOut(array(
								'error'	=> false,
								'type'	=> 'success',
								'url'	=> $this->createUrl('/goals?uId='.outStr(currentUser()->id)),
								'msg'	=> 'facebook mapped success'
							));
						}
					}
				}
				
			}
			
			// redirect to congratulation page
			
			// jsonOut(array('msg' => $msg, 'url' => $url, 'type' => $type));
		}
	}
	
}
