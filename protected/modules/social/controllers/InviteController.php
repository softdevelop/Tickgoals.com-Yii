<?php


class InviteController extends JLController
{
	
	public $layout = '//layouts/homepage';

	public function allowedActions() {
		return '*';
	}
	public function actionActive($key=NULL,$email=NULL,$name=NULL){
		$activeEmail = ActiveMail::model()->findByAttributes(array(
			'keycode'=>$key,
			'sender'=>$email,
		));
		if(!empty($activeEmail)){
			//check receiver email exists
			
			
			$currentUser = JLUser::model()->getUserInfoByEmail($activeEmail->receiver,false);
			$senderEmail = JLUser::model()->getUserInfoByEmail($activeEmail->sender,false);
			
			
			
			if(!empty($currentUser)){
				$currentUser->attachBehavior('UserFriend', 'application.modules.friends.components.behaviors.JLUserFriendBehavior');
				$isFriend = $currentUser->isFriend($senderEmail->id);
				//check is friend
				if(!$isFriend){
					// request friend
					// check currentUser has been sent request to user or not?
					$isPending = $currentUser->isPendingBy($senderEmail->id);
					
					if(!$isPending){
						// check other user pending currentUser or not?
						$user = JLUser::model()->getUserInfo($senderEmail->id);
						$user->attachBehavior('UserFriend', 'application.modules.friends.components.behaviors.JLUserFriendBehavior');
						$isPendingSelf = $user->isPendingBy($currentUser->id);
						$user->detachBehavior('UserFriend'); // Disable behavior for user
						
						if ($isPendingSelf) {
							if ($currentUser->accept($senderEmail->id)) {
								
								Yii::app()->user->setFlash('success', 'You and '.$user->getName().' are now friends');
								ActiveMail::model()->deleteAllByAttributes(array(
									'keycode'=>$key,
									'sender'=>$email,
								));
								$this->redirect('/friends/my');
							} else{
								Yii::app()->user->setFlash('error', 'Can not accept friend with this user.');
								$this->redirect('/friends/my');
							}
						} else {
							$requestFriend = $currentUser->requestFriend($senderEmail->id);
							
							
							if($requestFriend['error']==false){
								Yii::app()->user->setFlash('success', $requestFriend['msg']);
								$senderEmail->attachBehavior('UserFriend', 'application.modules.friends.components.behaviors.JLUserFriendBehavior');
								if ($senderEmail->accept($currentUser->id)) {
									ActiveMail::model()->deleteAllByAttributes(array(
										'keycode'=>$key,
										'sender'=>$email,
									));
									
									if(currentUser()->isGuest){
										Yii::app()->user->setFlash('success', 'You and '.$currentUser->getName().' are now friends. Please login see my friends');
										$this->redirect('/publicPages');
									}else{
										Yii::app()->user->setFlash('success', 'You and '.$currentUser->getName().' are now friends.');	
										$this->redirect('/friends/my');
									}
								} else{
									Yii::app()->user->setFlash('error', 'Can not accept friend with this user.');
									$this->redirect('/friends/my');
								}
							}
							else{
								Yii::app()->user->setFlash('error', $requestFriend['msg']);
								$this->redirect('/friends/my');
							}
							$currentUser->detachBehavior('UserFriend'); // Disable behavior for user
							
							ActiveMail::model()->deleteAllByAttributes(array(
								'keycode'=>$key,
								'sender'=>$email,
							));
						}
					}else{
						// $currentUser->detachBehavior('UserFriend'); // Disable behavior for user
						// Yii::app()->user->setFlash('success', 'The request has been sent to this user.');
						$senderEmail->attachBehavior('UserFriend', 'application.modules.friends.components.behaviors.JLUserFriendBehavior');
						if ($senderEmail->accept($currentUser->id)) {
							ActiveMail::model()->deleteByAttributes(array(
									'keycode'=>$key,
									'sender'=>$email,
							));
							if(currentUser()->isGuest){
								Yii::app()->user->setFlash('success', 'You and '.$currentUser->getName().' are now friends. Please login see my friends');
								$this->redirect('/publicPages');
							}else{
								Yii::app()->user->setFlash('success', 'You and '.$currentUser->getName().' are now friends.');	
								$this->redirect('/friends/my');
							}
							
						} else{
							Yii::app()->user->setFlash('error', 'Can not accept friend with this user.');
							$this->redirect('/friends/my');
						}

						$currentUser->detachBehavior('UserFriend'); // Disable behavior for user
						$this->redirect('/friends/my');
					}
					
					
				}else{
					$currentUser->detachBehavior('UserFriend'); // Disable behavior for user
					if(currentUser()->isGuest){
						Yii::app()->user->setFlash('success', 'You and '.$currentUser->getName().' are now friends. Please login see my friends');
						$this->redirect('/publicPages');
					}else{
						Yii::app()->user->setFlash('success', 'You and '.$currentUser->getName().' are now friends.');	
						$this->redirect('/friends/my');
					}
					
				}
			}else{
				//todo:register user for receiver
				
				$this->redirect(Yii::app()->createUrl("/publicPages?key={$key}&email={$email}&name={$name}"));
			}
			
		}else{
			Yii::app()->user->setFlash('warning', 'Active code not found.');
			$this->redirect('/publicPages');
		}
		
		
	}
	public function actionIndex(){
	
		if(!empty($_POST)){
			//~ $email = "quocthinh9889@gmail.com";
			$name = $_POST['name'];
			$email = $_POST['email'];
			$strRandom = uniqid ();
			Yii::app()->session['active-url'] = $strRandom;
			
			ActiveMail::model()->saveActiveMail(array(
				'sender'=>currentUser()->email,
				'receiver'=>$email,
				'keycode'=>$strRandom,
			));

			
			
			$sendMail = JLMailer::sendMailWithTemplate($email,currentUser()->getName(). ' wants to be friends with you on Lemon & loop. ','invite_friend',array(
				'email'=>$email,
				'name'=>$name,
				'emailCurrent'=>currentUser()->email,
				'nameCurrent'=>currentUser()->getName(),
				'idCurrent'=>currentUser()->hexID,
				'countFriend'=>$this->countFriend,
				'strRandom'=>$strRandom,
			));
			if($sendMail['error']==false){
				$debug = array(
					'error'=>false,
					'message'=>'Invite friend has been sent successfully.'
				);
			}else{					
				$debug = array(
					'error'=>true,
					'message'=>$sendMail['message']
					
				);
			}
			jsonOut($debug);
		}
		
		
		
	}
	
	
}
