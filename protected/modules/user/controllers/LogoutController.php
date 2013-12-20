<?php

class LogoutController extends UController {

	/**
	 * @return string Trả về các action (cách nhau bằng dấu phẩy) cho phép truy cập mà không cần xác thực quyền
	 */
	public function allowedActions() {
		return '*';
	}
	/**
	 * @return array action filters
	 */
	// public function filters()
	// {
		// return array(
			// 'accessControl', // perform access control for CRUD operations
		// );
	// }

	/**
	 * Action dùng để logout
	 */
	public function actionIndex() {
		
		Yii::app()->user->logout();
		// $cookieName = 'rememberMe';
		// unset(Yii::app()->request->cookies[$cookieName]);
		// unset(Yii::app()->session['loggedUser']);
		
		// $cookie = new CHttpCookie($cookieName, "notvalidcode");
		// $cookie->expire = time() - 10000;
		// $cookie->domain = Yii::app()->session->cookieParams['domain'];
		
		// Yii::app()->request->cookies[$cookieName] = $cookie;
	
		
		$this->redirect(array('/site'));
	}

}